<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PendudukImport implements ToArray, WithHeadingRow
{
    protected array $data = [];

    public function array(array $array): void
    {
        $this->data = $array;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
