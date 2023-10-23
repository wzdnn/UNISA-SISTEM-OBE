@extends('layouts.app')

@section('body')
<div class="flex items-center justify-between py-5 px-5 mx-10">
    <h1 class="font-bold text-2xl mb-0 text-blue-800">Matakuliah</h1>
    <a href="">
        <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1">List BK
        </button>
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
                    Bahan Kajian
                </th>
                <th scope="col" class="px-6 py-3 ">
                    Sub Bahan Kajian
                </th>
            </tr>
        </thead>
        <tbody>
            @if ($akKurikulumBk->count() > 0)
            @foreach ( $akKurikulumBk as $bk => $value )
            <tr class="bg-white border-b text-left">
                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $loop->iteration }}
                </td>
                <td class="px-6 py-4 text-left">
                    {{ $value->kode_bk }} {{ $value->bahan_kajian }}
                </td>
                <td class="px-6 py-4">
                    {{-- @foreach ( $value as $sbk )
                        {{ $sbk->kode_subbk }} {{ $sbk->sub_bk }}
                    @endforeach --}}
                    {{ $value->kode_subbk }} {{ $value->sub_bk }}
                </td>       
            </tr>
            @endforeach
            @else
            <tr>
                <td class="justify-center text-center" colspan="7">Data belum ada</td>
            </tr>
            @endif
        </tbody>
    </table>
    <hr />
</div>
@endsection