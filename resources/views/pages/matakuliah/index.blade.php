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
                        Skill Field
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Field Set
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Praktik
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        CPMK
                    </th>
                    {{-- <th scope="col" class="px-6 py-3 ">
                        Kode Matakuliah
                    </th> --}}
                    <th scope="col" class="px-6 py-3 ">
                        Matakuliah
                    </th>
                    {{-- <th scope="col" class="px-6 py-3 ">
                        MK Singkat
                    </th> --}}
                    <th scope="col" class="px-6 py-3 ">
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
                            <td class="px-6 py-4 text-left">
                                @foreach ($value->MKtoSBKread as $mksbk)
                                    {{ $mksbk->kode_subbk }} {{ $mksbk->sub_bk }} <br />
                                    <hr />
                                @endforeach
                                {{-- <table>
                                    
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                        <th scope="col" class="w-screen">
                                        </th>
                                        <th scope="col" class="w-screen">
                                            PB
                                        </th>
                                        <th scope="col" class="w-screen">
                                            K
                                        </th>
                                        <th scope="col" class="w-screen">
                                            T
                                        </th>
                                        <th scope="col" class="w-screen">
                                            S
                                        </th>
                                        <th scope="col" class="w-screen">
                                            Pm
                                        </th>
                                        <th scope="col" class="w-screen">
                                            SL
                                        </th>
                                        <th scope="col" class="w-screen">
                                            FL
                                        </th>
                                        <th scope="col" class="w-screen">
                                            P
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($value->MKtoSBKread as $mksbk)
                                            <tr>

                                                <td>{{ $mksbk->kode_subbk }} {{ $mksbk->sub_bk }} </td>
                                                <td>{{ $mksbk->pivot->pokok_bahasan }}</td>
                                                <td>{{ $mksbk->pivot->kuliah }}</td>
                                                <td>{{ $mksbk->pivot->tutorial }}</td>
                                                <td>{{ $mksbk->pivot->seminar }}</td>
                                                <td>{{ $mksbk->pivot->praktikum }}</td>
                                                <td>{{ $mksbk->pivot->skill_lab }}</td>
                                                <td>{{ $mksbk->pivot->field_lab }}</td>
                                                <td>{{ $mksbk->pivot->praktik }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <td class="px-6 py-4">
                                {{ $value->kodematakuliah }} --}}
                            </td>
                            <td class="px-6 py-4 ">
                                @foreach ($value->MKtoSBKread as $mksbk)
                                    {{ $mksbk->pivot->pokok_bahasan }} <br />
                                    <hr />
                                @endforeach
                            </td>
                            <td class="px-6 py-4 ">
                                @foreach ($value->MKtoSBKread as $mksbk)
                                    {{ $mksbk->pivot->kuliah }} <br />
                                    <hr />
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                @foreach ($value->MKtoSBKread as $mksbk)
                                    {{ $mksbk->pivot->tutorial }} <br />
                                    <hr />
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                @foreach ($value->MKtoSBKread as $mksbk)
                                    {{ $mksbk->pivot->seminar }} <br />
                                    <hr />
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                @foreach ($value->MKtoSBKread as $mksbk)
                                    {{ $mksbk->pivot->praktikum }} <br />
                                    <hr />
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                @foreach ($value->MKtoSBKread as $mksbk)
                                    {{ $mksbk->pivot->skill_lab }} <br />
                                    <hr />
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                @foreach ($value->MKtoSBKread as $mksbk)
                                    {{ $mksbk->pivot->field_lab }} <br />
                                    <hr />
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                @foreach ($value->MKtoSBKread as $mksbk)
                                    {{ $mksbk->pivot->praktik }} <br />
                                    <hr />
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                {{-- CPMK --}}
                                @foreach ($value->GetAllidSubBK as $mksbk)
                                    @foreach ($mksbk->cpmks as $item)
                                        {{ $item->kode_cpmk }} - {{ $item->cpmk }}
                                    @endforeach
                                    <hr />
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                {{ $value->kodematakuliah }} | {{ $value->matakuliah }}
                            </td>
                            {{-- <td class="px-6 py-4">
                                {{ $value->mk_singkat }}
                            </td> --}}
                            <td class=" px-6 py-4 ">
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
