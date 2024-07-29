<?php

namespace App\Exports;

use App\Models\ak_penilaian;
use App\Models\exportNilaiModel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportNilai implements FromQuery, WithHeadings
{

    use Exportable;

    public function __construct(int $kdjenisnilai)
    {
        $this->kdjenisnilai = $kdjenisnilai;
    }

    public function query()
    {
        // return ak_penilaian::query()->where('kdjenisnilai', $this->kdjenisnilai);
        return exportNilaiModel::query()->where('kdjenisnilai', $this->kdjenisnilai)->orderBy('nim');
    }

    public function headings(): array
    {
        return [
            'ID',
            'KDJENISNILAI',
            'KDKRSNILAI',
            'NIM',
            'NAMALENGKAP',
            'NILAI'
        ];
    }
}
