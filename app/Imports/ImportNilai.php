<?php

namespace App\Imports;

use App\Models\ak_penilaian;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportNilai implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    // public function model(array $row)
    // {
    //     return new ak_penilaian([
    //         'nilai' => $row['nilai']
    //     ]);
    // }

    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {

            $nilai = ak_penilaian::where('id', $row['id'])->first();

            if ($nilai != null) {
                $nilai->update(['nilai' => $row['nilai']]);
            }
        }
    }
}
