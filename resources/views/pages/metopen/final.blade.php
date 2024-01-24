@extends('layouts.app')

<br />
@section('body')
    <div class=" bg-white">
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
        <thead class="text-xs text-gray-700 uppercase bg-gray-500">
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
                <tr class="bg-white border-b text-left shadow">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $value[1] }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $value[2] }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $value[3] }}
                    </td>
                    @foreach ($value[4] as $nilai)
                        <td>
                            {{ $nilai }}
                        </td>
                    @endforeach
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
