<?php

namespace App\Exports;

use App\Models\exportNilaiModelMBKM;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class exportNilaiMbkm implements FromQuery, WithHeadings
{

    use Exportable;

    public function __construct(int $kdjenisnilai)
    {
        $this->kdjenisnilai = $kdjenisnilai;
    }

    public function query()
    {
        // return ak_penilaian::query()->where('kdjenisnilai', $this->kdjenisnilai);
        return exportNilaiModelMBKM::query()->where('kdjenisnilai', $this->kdjenisnilai)->orderBy('nim');
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
