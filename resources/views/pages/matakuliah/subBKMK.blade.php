@extends('layouts.app')

@section('body')
<div class="flex items-center justify-between py-5 px-5 mx-10">
    <h1 class="font-bold text-2xl mb-0">Sub Bahan Kajian </h1>
    
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
                    Pokok Bahasan
                </th>
                <th scope="col" class="px-6 py-3">
                    Kuliah
                </th>
                <th scope="col" class="px-6 py-3">
                    Tutorial
                </th>
                <th scope="col" class="px-6 py-3">
                    Seminar
                </th>
                <th scope="col" class="px-6 py-3">
                    Praktikum
                </th>
                <th scope="col" class="px-6 py-3">
                    Skill Lab
                </th>
                <th scope="col" class="px-6 py-3">
                    Field Lab
                </th>
                <th scope="col" class="px-6 py-3">
                    Praktik
                </th>
                <th scope="col" class="px-6 py-3">
                    CPMK
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($mkSubBK as $mkSubBKs => $value)
            <tr class="bg-white border-b text-left">
                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $loop->iteration }}
                </td>
                <td class="px-6 py-4">
                    {{-- @forelse ($value->sub_bk as $item)
                        @foreach ($sub_bk as $subbk)
                            @if ($subbk->kdsubbk == $item)
                                <p>{{ $subbk->kode_subbk }} {{ $subbk->sub_bk }}</p>
                            @endif
                        @endforeach
                    @empty
                        <p>-</p>
                    @endforelse --}}
                    
                    @foreach ($sub_bk as $subbk)
                        @if ($subbk->id == $value)
                        <p>{{ $subbk->kode_subbk }} {{ $subbk->sub_bk }}</p>
                        @endif
                    @endforeach

                    {{-- {{ $value }} --}}
                </td>
                <td class="px-6 py-4">
                    
                </td>
                <td class="px-6 py-4">
                    
                </td>
                <td class="px-6 py-4">
                    
                </td>
                <td class="px-6 py-4">
                    
                </td>
                <td class="px-6 py-4">
                    
                </td>
                <td class="px-6 py-4">
                    
                </td>
                <td class="px-6 py-4">
                    
                </td>
                <td class="px-6 py-4">
                    
                </td>
                <td class="px-6 py-4">
                    
                </td>
                <td class="px-6 py-4">
                    
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
    <hr />
</div>
@endsection