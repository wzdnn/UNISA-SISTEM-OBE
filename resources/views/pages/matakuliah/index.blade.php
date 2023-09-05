@extends('layouts.app')

@section('body')
    <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0">MATAKULIAH</h1>
        <a href="">
            <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1">Petakan
                Matakuliah
            </button>
        </a>
    </div>
    <hr />

    <div class="relative py-3">
        <table class="w-full text-sm text-center  text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 w-[50px]">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Kode Sub Bk
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Kode MK
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Matakuliah
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        MK Singkat
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Unit
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($ak_matakuliah->count() > 0)
                    @foreach ($ak_matakuliah as $ak_matakuliahs)
                        <tr class="bg-white border-b">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 text-">
                                {{-- @foreach ($ak_matakuliahs->CpltoPl as $cplpl)
                                    {{ $cplpl->kode_pl }}
                                    <br />
                                @endforeach --}}
                            </td>
                            <td class="px-6 py-4">
                                {{ $ak_matakuliahs->kodematakuliah }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $ak_matakuliahs->matakuliah }}
                            </td>
                            <td class="px-6 py-4">
                                {{-- {{ $ak_matakuliahs->deskripsi_cpl }} --}}
                            </td>
                            <td class=" px-6 py-4 text-">
                                {{-- {{ $ak_matakuliahs->aspek }} --}}
                            </td>
                            <td class="px-6 py-4 text-">
                                {{-- @foreach ($ak_matakuliahs->CpltoCplr as $cplcplr)
                                    {{ $cplcplr->kode_cplr }}<br />
                                @endforeach --}}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="justify-center text-center" colspan="8">Data belum ada</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <hr />
    </div>
@endsection
