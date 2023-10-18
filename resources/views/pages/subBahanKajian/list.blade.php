@extends('layouts.app')

@section('body')
<div class="flex items-center justify-between py-5 px-5 mx-10">
    <h1 class="font-bold text-2xl mb-0">CPMK</h1>
    <div class="flex flex-row space-x-3">
        <a href="{{ route('list.cpmk') }}">
            <button
                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">List CPMK
            </button>
        </a>
    </div>
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
                    Sub Bahan Kajian
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
            @if ($SubBk->count() > 0)
            @foreach ($SubBk as $key => $value)
            <tr class="bg-white border-b">
                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $loop->iteration }}
                </td>
                <td class="px-6 py-4 text-left">
                    {{ $value->kode_subbk }} {{ $value->sub_bk }}
                </td>
                <td class="px-6 py-4 text-left">
                    @forelse ($value->ak_kurikulum_cpmk as $item)
                        @foreach ($cpmk as $cpmks)
                            @if ($cpmks->id == $item)
                                {{ $cpmks->kode_cpmk }} {{ $cpmks->cpmk }}
                            @endif
                        @endforeach
                    @empty
                    <p>-</p>
                    @endforelse
                </td>
                <td class="px-6 py-4 text-left">
                    <a href="{{ route('MapCPMKShow', ['id' => $value->id]) }}">
                        <button type="button"
                            class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 "><i
                                class="fa-solid fa-code-branch"></i></button>
                    </a>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td class="justify-center text-center" colspan="4">Data belum ada</td>
            </tr>
            @endif
        </tbody>
    </table>
    <hr />
</div>
@endsection