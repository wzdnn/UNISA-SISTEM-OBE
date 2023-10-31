@extends('layouts.app')

@section('body')
    <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0 text-blue-800">Matakuliah</h1>
        <a href="{{ route('create.mk') }}">
            <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1">Tambah Matakuliah
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
                        SUB BK
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        CPMK
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Pokok Bahasan
                    </th>
                    <th scope="col" class="w-5 ">
                        K
                    </th>
                    <th scope="col" class="w-5 ">
                        T
                    </th>
                    <th scope="col" class="w-5 ">
                        S
                    </th>
                    <th scope="col" class="w-5 ">
                        Pm
                    </th>
                    <th scope="col" class="w-5 ">
                        SL
                    </th>
                    <th scope="col" class="w-5 ">
                        FL
                    </th>
                    <th scope="col" class="w-5 ">
                        P
                    </th>
                    {{-- <th scope="col" class="px-6 py-3 ">
                        Kode Matakuliah
                    </th> --}}
                    <th scope="col" class="px-3 py-1 ">
                        Matakuliah
                    </th>
                    {{-- <th scope="col" class="px-6 py-3 ">
                        MK Singkat
                    </th> --}}
                    <th scope="col" class="w-10 ">
                        Unit
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($matakuliah->count() > 0)
                    @foreach ($matakuliah as $key => $value)
                        <tr class="bg-white border-b text-left">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ ($matakuliah->currentPage() - 1) * $matakuliah->perPage() + $key + 1 }}
                            </td>
                            <td class="px-6 py-4">
                                @foreach ($value->MKtoSBKread as $mksbk)
                                    {{ $mksbk->kode_subbk }} {{ $mksbk->sub_bk }} <br />
                                    <hr />
                                @endforeach
                            </td>
                            <td class="px-6 py-4">

                                {{-- <button data-tooltip-target="tooltip-default" type="button"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Default
                                    tooltip</button>
                                <div id="tooltip-default" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    Tooltip content
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div> --}}
                                {{-- <pre><?php $x = $value->GetAllidSubBK->firstWhere('id', 1);
                                // print_r($x);
                                //
                                ?></pre> --}}

                                @foreach ($value->GetAllidSubBK as $mksbk)
                                    @foreach ($mksbk->cpmks as $item)
                                        &#x2022; {{ $item->kode_cpmk }}
                                    @endforeach
                                    <hr />
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                @foreach ($value->MKtoSBKread as $mksbk)
                                    {{ $mksbk->pivot->pokok_bahasan }} <br />
                                    <hr />
                                @endforeach
                            </td>
                            <td class="w-5 ">
                                @foreach ($value->MKtoSBKread as $mksbk)
                                    {{ $mksbk->pivot->kuliah }} <br />
                                @endforeach
                            </td>
                            <td class="w-5">
                                @foreach ($value->MKtoSBKread as $mksbk)
                                    {{ $mksbk->pivot->tutorial }} <br />
                                @endforeach
                            </td>
                            <td class="w-5">
                                @foreach ($value->MKtoSBKread as $mksbk)
                                    {{ $mksbk->pivot->seminar }} <br />
                                @endforeach
                            </td>
                            <td class="w-5">
                                @foreach ($value->MKtoSBKread as $mksbk)
                                    {{ $mksbk->pivot->praktikum }} <br />
                                @endforeach
                            </td>
                            <td class="w-5">
                                @foreach ($value->MKtoSBKread as $mksbk)
                                    {{ $mksbk->pivot->skill_lab }} <br />
                                @endforeach
                            </td>
                            <td class="w-5">
                                @foreach ($value->MKtoSBKread as $mksbk)
                                    {{ $mksbk->pivot->field_lab }} <br />
                                @endforeach
                            </td>
                            <td class="w-5">
                                @foreach ($value->MKtoSBKread as $mksbk)
                                    {{ $mksbk->pivot->praktik }} <br />
                                @endforeach
                            </td>
                            <td class="px-3 py-1">
                                {{ $value->kodematakuliah }} | {{ $value->matakuliah }}
                            </td>
                            {{-- <td class="px-6 py-4">
                                {{ $value->mk_singkat }}
                            </td> --}}
                            <td class=" w-10">
                                {{ $value->kurikulum }} {{ $value->tahun }}
                            </td>
                            <td class=" px-6 py-4">
                                <a href="{{ route('detail.mk', ['id' => $value->kdmatakuliah]) }}">
                                    <button type="button"
                                        class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 "><i
                                            class="fa-solid fa-circle-info"></i></button>
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
        {{ $matakuliah->links() }}
        <hr />
    </div>
@endsection
