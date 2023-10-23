@extends('layouts.app')

@section('body')
    <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0 text-blue-800">Profile Lulusan</h1>
        <a href="{{ route('pl.create') }}">
            <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1">Tambah Profile
                Lulusan</button>
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
                        Kode PL
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Profile Lulusan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Deskripsi Profil
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Unit
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Edit
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($akKurikulumPl->count() > 0)
                    @foreach ($akKurikulumPl as $akKurikulumPls)
                        <tr class="bg-white border-b text-left">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumPls->kode_pl }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumPls->profile_lulusan }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumPls->deskripsi_profile }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumPls->kurikulum }} - {{ $akKurikulumPls->tahun }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('edit.pl', ['id' => $akKurikulumPls->id]) }}">
                                    <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1"><i
                                            class="fa-regular fa-pen-to-square"></i></button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="justify-center text-center" colspan="5">Profile Lulusan belum ada</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <hr />
    </div>
@endsection
