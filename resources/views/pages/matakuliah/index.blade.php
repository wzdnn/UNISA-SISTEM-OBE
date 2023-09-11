@extends('layouts.app')

@section('body')
    <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0">MATAKULIAH</h1>
        {{-- <a href="">
            <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1">Petakan
                Matakuliah
            </button>
        </a> --}}
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
                    @foreach ($ak_matakuliah as $ak_matakuliahs => $value)
                        <tr class="bg-white border-b text-left">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $ak_matakuliahs + 1 }}
                            </td>
                            <td class="px-6 py-4 text-left">
                                @forelse ($value->sub_bk as $item)
                                    @foreach ($sub_bk as $subbk)
                                        @if ($subbk->id == $item)
                                            <p>{{ $subbk->kode_subbk }} {{ $subbk->sub_bk }}</p>
                                        @endif
                                    @endforeach
                                @empty
                                    <p>-</p>
                                @endforelse
                            </td>
                            <td class="px-6 py-4">
                                {{ $value->kodematakuliah }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $value->matakuliah }}
                            </td>
                            <td class="px-6 py-4">

                            </td>
                            <td class=" px-6 py-4">
                                {{ $value->kurikulum }}
                            </td>
                            <td class=" px-6 py-4 flex flex-col">
                                <a href="{{ route('show.mkSBK', ['id' => $value->kdmatakuliah]) }}">
                                    <button type="button"
                                        class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 "><i
                                            class="fa-solid fa-code-branch"></i></button>
                                </a>
                                <a href="">
                                    <button type="button"
                                        class="text-white bg-sky-500 hover:bg-sky-800 focus:outline-none focus:ring-4 focus:ring-sky-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 "><i
                                            class="fa-solid fa-clipboard"></i></button>
                                </a>
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
