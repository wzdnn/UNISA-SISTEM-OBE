@extends('layouts.app')

@section('body')
    <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0 text-gray-700">Sub Bahan Kajian</h1>
        <a href="{{ route('subbk.create') }}">
            <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1">Tambah Sub Bahan
                Kajian</button>
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
                        Kode Sub BK
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Sub Bahan Kajian
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Referensi
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Kode BK
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
                @if ($akKurikulumSubBk->count() > 0)
                    @foreach ($akKurikulumSubBk as $akKurikulumSubBks)
                        <tr class="bg-white border-b text-left">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumSubBks->kode_subbk }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumSubBks->sub_bk }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumSubBks->referensi }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumSubBks->ak_kdbk }}
                                {{ $akKurikulumSubBks->ak_bk }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumSubBks->kurikulum }} {{ $akKurikulumSubBks->tahun }}
                            </td>
                            <td class="px-6 py-4 flex flex-row space-x-1">
                                <a href="{{ route('edit.subbk', ['id' => $akKurikulumSubBks->id]) }}">
                                    <button
                                        class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1"><i
                                            class="fa-regular fa-pen-to-square"></i></button>
                                </a>
                                <a href="{{ route('delete.subbk', ['id' => $akKurikulumSubBks->id]) }}">
                                    <button
                                        class="bg-red-600 hover:bg-red-800 text-white rounded px-2 text-md font-semibold p-1"><i
                                            class="fa-solid fa-trash"></i></button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="justify-center text-center" colspan="7">Bahan Kajian belum ada</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <hr />
    </div>
@endsection
