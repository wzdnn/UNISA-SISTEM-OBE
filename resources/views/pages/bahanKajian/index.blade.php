@extends('layouts.app')

@section('body')
    <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0 text-blue-800">Bahan Kajian</h1>
        <a href="{{ route('bk.create') }}">
            <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1">Tambah Bahan
                Kajian</button>
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
                        Kode BK
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Bahan Kajian
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Basis Ilmu
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Bidang Ilmu
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
                @if ($akKurikulumBk->count() > 0)
                    @foreach ($akKurikulumBk as $akKurikulumBks)
                        <tr class="bg-white border-b">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumBks->kode_bk }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumBks->bahan_kajian }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumBks->ak_basil }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumBks->ak_bidil }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumBks->kurikulum }} {{ $akKurikulumBks->tahun }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('delete.bk', ['id' => $akKurikulumBks->id]) }}">
                                    <button
                                        class="bg-red-600 hover:bg-red-800 text-white rounded px-2 text-md font-semibold p-1"><i
                                            class="fa-solid fa-trash"></i></button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="justify-center text-center" colspan="6">Bahan Kajian belum ada</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <hr />
    </div>
@endsection
