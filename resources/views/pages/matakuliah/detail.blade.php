@extends('layouts.app')

@section('body')
<div class="flex items-center justify-between py-5 px-5 mx-10">
    <h1 class="font-bold text-2xl mb-0">Detail Matakuliah</h1>
</div>

<div class="relative py-3">
    <table class="w-full text-sm text-center  text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr class="text-left">
                <th scope="col" class="px-6 py-3 w-[50px]">
                    No.
                </th>
                <th scope="col" class="px-6 py-3 ">
                    SUB BK
                </th>
                <th scope="col" class="px-6 py-3 ">
                    Pokok Bahasan
                </th>
                <th scope="col" class="px-6 py-3 ">
                    Kuliah
                </th>
                <th scope="col" class="px-6 py-3 ">
                    Tutorial
                </th>
                <th scope="col" class="px-6 py-3 ">
                    Seminar
                </th>
                <th scope="col" class="px-6 py-3 ">
                    Praktikum
                </th>
                <th scope="col" class="px-6 py-3 ">
                    Skill Lab
                </th>
                <th scope="col" class="px-6 py-3 ">
                    Field Lab
                </th>
                <th scope="col" class="px-6 py-3 ">
                    Praktik
                </th>
                <th scope="col" class="px-6 py-3 ">
                    CPMK
                </th>
                <th scope="col" class="px-6 py-3 ">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $mkSubBK as $mk => $value )
            <tr class="bg-white border-b text-left">
                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $loop->iteration }}
                </td>
                <td class="px-6 py-4 text-left">
                    @foreach ($subBK as $sub_bk)
                        @if ($sub_bk->id == $value->ak_kurikulum_sub_bk_id)
                            {{ $sub_bk->kode_subbk }} {{ $sub_bk->sub_bk }}
                        @endif                    
                    @endforeach
                </td>
                <td class="px-6 py-4">
                    {{ $value->pokok_bahasan }}
                </td>
                <td class="px-6 py-4">
                    {{ $value->kuliah }}
                </td>
                <td class="px-6 py-4">
                    {{ $value->tutorial }}
                </td>
                <td class=" px-6 py-4 ">
                    {{ $value->seminar }}
                </td>
                <td class=" px-6 py-4 ">
                    {{ $value->praktikum }}
                </td>
                <td class=" px-6 py-4 ">
                    {{ $value->skill_lab }}
                </td>
                <td class=" px-6 py-4 ">
                    {{ $value->field_lab }}
                </td>
                <td class=" px-6 py-4 ">
                    {{ $value->praktik }}
                </td>
                <td class=" px-6 py-4 ">
                    @forelse ($value->ak_kurikulum_cpmk as $item)
                        @foreach ($cpmk as $cpmks)
                            @if ($cpmks->id == $item)
                                {{ $cpmks->kode_cpmk }} {{ $cpmks->cpmk }} <hr /><br />
                            @endif
                        @endforeach
                    @empty
                        <p>-</p>
                    @endforelse
                    <a href="{{ route('CPMKshow.mk',['id' => $value->ak_kurikulum_sub_bk_id]) }}">
                        <button type="button"
                            class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 "><i
                                class="fa-solid fa-code-branch"></i></button>
                    </a>
                </td>
                <td class=" px-6 py-4">
                    <a href="{{ route('edit.mk',['id' => $value->ak_kurikulum_sub_bk_id]) }}">
                        <button type="button"
                            class="text-white bg-yellow-500 hover:bg-yellow-700 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 "><i
                                class="fa-solid fa-file-circle-exclamation"></i></button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <hr />
</div>
@endsection