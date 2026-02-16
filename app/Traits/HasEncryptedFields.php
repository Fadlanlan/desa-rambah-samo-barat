<?php

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;

trait HasEncryptedFields
{
    /**
     * Get the list of fields that should be encrypted.
     * Override this method in your model.
     *
     * @return array<string>
     */
    public function getEncryptedFields(): array
    {
        return $this->encryptedFields ?? [];
    }

    /**
     * Boot the trait: auto encrypt on saving, auto decrypt on retrieving.
     */
    public static function bootHasEncryptedFields(): void
    {
        static::saving(function ($model) {
            foreach ($model->getEncryptedFields() as $field) {
                if (!empty($model->{ $field})) {
                    // Check if value is already encrypted
                    $isEncrypted = $model->isEncrypted($model->{ $field});

                    // Decrypt to get raw value if it's already encrypted (for hash generation)
                    $rawValue = $isEncrypted ?Crypt::decryptString($model->{ $field}) : $model->{ $field};

                    // Generate Blind Index (Hash)
                    $hashField = $field . '_hash';
                    if (array_key_exists($hashField, $model->getAttributes()) || $model->isFillable($hashField) || property_exists($model, $hashField)) {
                        $model->{ $hashField} = hash_hmac('sha256', $rawValue, config('app.key'));
                    }

                    // Encrypt if not already encrypted
                    if (!$isEncrypted) {
                        $model->{ $field} = Crypt::encryptString($rawValue);
                    }
                }
            }
        });

        static::retrieved(function ($model) {
            foreach ($model->getEncryptedFields() as $field) {
                if (!empty($model->{ $field})) {
                    try {
                        $model->{ $field} = Crypt::decryptString($model->{ $field});
                    }
                    catch (\Exception $e) {
                    // Value might not be encrypted (legacy data)
                    }
                }
            }
        });
    }

    /**
     * Check if a value appears to be already encrypted.
     */
    protected function isEncrypted(string $value): bool
    {
        // Laravel encrypted strings are base64 encoded JSON
        $decoded = json_decode(base64_decode($value, true), true);

        return is_array($decoded) && isset($decoded['iv'], $decoded['value'], $decoded['mac']);
    }
}
