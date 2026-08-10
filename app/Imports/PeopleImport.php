<?php

namespace App\Imports;

use App\Models\Person;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PeopleImport implements ToModel, WithStartRow
{
    protected bool $isElected;

    public function __construct(bool $isElected)
    {
        $this->isElected = $isElected;
    }

    /**
     * Ignore the first row because it contains headers.
     */
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        if (empty($row[0]) || empty($row[1])) {
            return null;
        }

        return new Person([
            'name' => trim($row[0]),

            'national_id' => trim((string) $row[1]),

            'phone' => !empty($row[2])
                ? trim((string) $row[2])
                : null,

            'is_elected' => $this->isElected,

            'note' => null,
        ]);
    }
}
