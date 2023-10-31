@extends('layouts.app')

@section('body')
    <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0 text-gray-700">Referensi CPL</h1>
        <a href="{{ route('cplr.create') }}">
            <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1">Tambah Referensi
                CPL</button>
        </a>
    </div>
    <hr />

    <div class="relative py-3">
        <table class="w-full text-sm text-center  text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr class="text-left">
                    <th scope="col" class="px-6 py-3 w-[50px]">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Kode CPLR
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        CPLR
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Deskripsi
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Aspek
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Sumber
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
                @if ($akKurikulumCplr->count() > 0)
                    @foreach ($akKurikulumCplr as $akKurikulumCplrs)
                        <tr class="bg-white border-b text-left">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumCplrs->kode_cplr }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumCplrs->cplr }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumCplrs->deskripsi_cplr }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumCplrs->ak_aspek }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumCplrs->ak_sumber }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumCplrs->kurikulum }} - {{ $akKurikulumCplrs->tahun }}
                            </td>
                            <td class="px-6 py-4 flex flex-row">
                                <a href="{{ route('edit.cplr', ['id' => $akKurikulumCplrs->id]) }}">
                                    <button
                                        class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1"><i
                                            class="fa-regular fa-pen-to-square"></i></button>
                                </a>
                                <a href="{{ route('delete.cplr', ['id' => $akKurikulumCplrs->id]) }}">
                                    <button
                                        class="bg-red-600 hover:bg-red-800 text-white rounded px-2 text-md font-semibold p-1"><i
                                            class="fa-solid fa-trash"></i></button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="justify-center text-center" colspan="8">Sumber Referensi CPL belum ada</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{ $akKurikulumCplr->links() }}
        <hr />
    </div>
@endsection
