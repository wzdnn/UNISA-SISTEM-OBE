@extends('layouts.app')

<br />
@section('body')
    <div class=" bg-white rounded-sm">
        <div class="flex flex-col py-5 px-4">

            <h1 class="font-bold text-2xl mb-0 text-gray-700">
                {{ $matakuliah->matakuliah }}
            </h1>

            <h3 class="font-semibold text-xl mb-0 text-gray-700">{{ $matakuliah->namalengkap }},
                {{ $matakuliah->gelarbelakang }} </h3>

            <h3 class="font-medium text-xl mb-0 text-gray-700">Batas Nilai : {{ $matakuliah->batasNilai }} </h3>

            <h3 class="font-medium text-l mb-0 text-gray-700">Kode CPL :
                @foreach ($cpl as $c)
                    {{ $c->kode_cpl }},
                @endforeach
            </h3>

        </div>
    </div>



    <table class="w-full text-sm text-center  text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-white">
            <tr class="text-left">
                <th scope="col" class="px-6 py-3 w-[50px]">
                </th>
                <th scope="col" class="px-6 py-3">
                </th>
                <th scope="col" class="px-6 py-3 ">
                </th>
                <th scope="col" class="px-6 py-3 ">

                </th>
                @foreach ($tabel as $tbl)
                    <th scope="col" class="px-6 py-3 ">
                        {{ $tbl->kode_cpl }}
                    </th>
                @endforeach
            </tr>
            <tr class="text-left">
                <th scope="col" class="px-6 py-3 w-[50px]">
                </th>
                <th scope="col" class="px-6 py-3">
                </th>
                <th scope="col" class="px-6 py-3 ">
                </th>
                <th scope="col" class="px-6 py-3 ">

                </th>
                @foreach ($tabel as $tbl)
                    <th scope="col" class="px-6 py-3 ">
                        {{ $tbl->kode_cpmk }}
                    </th>
                @endforeach
            </tr>
            <tr class="text-left">
                <th scope="col" class="px-6 py-3 w-[50px]">
                    No.
                </th>
                <th scope="col" class="px-6 py-3">
                    Nim
                </th>
                <th scope="col" class="px-6 py-3 ">
                    Nama Mahasiswa
                </th>
                <th scope="col" class="px-6 py-3 ">
                    Nilai Akhir
                </th>
                @foreach ($tabel as $tbl)
                    <th scope="col" class="px-6 py-3 ">
                        {{ $tbl->metode_penilaian }}
                    </th>
                @endforeach
            </tr>
            <tr class="">
                <th scope="col" class="px-6 py-3">

                </th>
                <th scope="col" class="px-6 py-3">

                </th>
                <th scope="col" class="px-6 py-3">

                </th>
                <th scope="col" class="px-6 py-3">

                </th>
                @foreach ($tabel as $tbl)
                    <th scope="col" class="px-6 py-3 text-left items-center">
                        {{ $tbl->bobot }}%
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $key => $value)
                <tr class=" border-b text-left shadow {{ $value[5] ? 'bg-yellow-300 text-white' : 'bg-white' }}">
                    <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $value[1] }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $value[2] }}
                    </td>
                    <td class="px-6 py-4">
                        {{ number_format($value[3]) }}
                    </td>
                    @foreach ($value[4] as $nilai)
                        <td class="px-6 py-4">
                            {{ $nilai }}
                        </td>
                    @endforeach
                </tr>
            @endforeach

        </tbody>
    </table>

    <div class=" bg-white rounded-sm">
        <div class="flex flex-col py-5 px-4">

            {{-- <h3 class="font-medium text-xl mb-0 text-gray-700">Total Mahasiswa Lulus : {{ $nilaiAkhir[4] }}% </h3>

            <h3 class="font-medium text-xl mb-0 text-gray-700">Total Mahasiswa Tidak Lulus : {{ $nilaiAkhir[5] }}%</h3>

        </div> --}}
            <div class="flex flex-col py-5 px-4">
                @foreach ($persenplo as $pplo)
                    <h3 class="font-medium text-xl mb-0 text-gray-700">Total Mahasiswa Lulus CPL {{ $pplo['kode_cpl'] }} =
                        {{ $pplo['LULUS'] }} Orang | {{ $pplo['PersenLulus'] }}% </h3>
                    <h3 class="font-medium text-xl mb-0 text-gray-700">Total Mahasiswa Tidak Lulus CPL
                        {{ $pplo['kode_cpl'] }}
                        =
                        {{ $pplo['TIDAK_LULUS'] }} Orang | {{ $pplo['PersenTidakLulus'] }}% </h3>
                    <br />
                    <br />
                @endforeach
            </div>
        </div>
    @endsection
