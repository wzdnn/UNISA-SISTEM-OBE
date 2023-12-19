@extends('layouts.app')


@section('body')
    <div class="flex flex-col py-5">
        <h1 class="font-bold text-2xl mb-0 text-blue-700">Tugas/metode penilaian lainnya | (urutan)</h1>

        <h3 class="font-medium text-xl mb-0 text-blue-700">CPMK (no cpmk) </h3>
    </div>

    <table class="w-full text-sm text-center  text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr class="text-left">
                <th scope="col" class="px-6 py-3 w-[50px]">
                    No.
                </th>
                <th scope="col" class="px-6 py-3 ">
                    Nama Mahasiswa
                </th>
                <th scope="col" class="px-6 py-3 ">
                    Nilai
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b text-left shadow">
                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">

                </td>
                <td class="px-6 py-4">

                </td>
                <td class="px-6 py-4">

                </td>
            </tr>
        </tbody>
    </table>
@endsection
