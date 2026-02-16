<?php

namespace App\Utils;

use App\Models\JenisSurat;
use Carbon\Carbon;

class LetterNumberingUtility
{
    /**
     * Generate an official letter number.
     * Format: [KODE-SURAT]/[SEQUENCE]/[KODE-DESA]/[MONTH-ROMAN]/[YEAR]
     * Example: 470/015/DS-RSB/II/2026
     */
    public static function generateNumber(int $sequence, string $kodeSurat, Carbon $date = null): string
    {
        $date = $date ?? Carbon::now();
        $kodeDesa = config('desa.kode_desa', 'DS-RSB');
        $romanMonth = self::getRomanMonth($date->month);
        $paddedSequence = str_pad($sequence, 3, '0', STR_PAD_LEFT);

        return "{$kodeSurat}/{$paddedSequence}/{$kodeDesa}/{$romanMonth}/{$date->year}";
    }

    /**
     * Generate hash verifikasi for document integrity.
     */
    public static function generateHash(string $nomorSurat, int $pendudukId, string $timestamp): string
    {
        return hash('sha256', "{$nomorSurat}|{$pendudukId}|{$timestamp}");
    }

    /**
     * Convert month to Roman numeral.
     */
    private static function getRomanMonth(int $month): string
    {
        $map = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
            7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
        ];

        return $map[$month] ?? 'I';
    }
}
