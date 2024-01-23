@extends('layouts.app')

<br />
@section('body')
    <div class=" bg-white">
        <div class="flex flex-col py-5 px-4">

            <h1 class="font-bold text-2xl mb-0 text-gray-700">
            </h1>
            <h3 class="font-medium text-xl mb-0 text-gray-700"> </h3>
            <h3 class="font-semibold text-l mb-0 text-gray-700"> |
            </h3>
            <h3 class="font-semibold text-l mb-0 text-gray-700">Bobot CPMK : % </h3>
        </div>
    </div>

    <table class="w-full text-sm text-center  text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
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
                @foreach ($matakuliah as $mk)
                    <th scope="col" class="px-6 py-3 ">
                        {{ $mk->metode_penilaian }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($finalNilai as $key => $value)
                <tr class="bg-white border-b text-left shadow">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    </td>

                    <td class="px-6 py-4">

                    </td>
                    <td class="px-6 py-4">

                    </td>
                    <td class="px-6 py-4">

                    </td>
                    <td class="px-6 py-4">

                    </td>
                    <td class="px-6 py-4 flex flex-row">
                        {{ $fn->nilai }}
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
