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
                <tr>
                    <th scope="col" class="px-6 py-3 w-[50px]">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        CPL
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        CPLR
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
                @if ($CPMK->count() > 0)
                    {{-- @foreach ($CPMK as $CPMKs)
                        <tr class="bg-white border-b">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $CPMKs->kode_cpl }} {{ $CPMKs->cpl }}
                            </td>
                            <td class="px-6 py-4 ">
                                @foreach ($CPMKs->CpltoCplr as $cplcplr)
                                    {{ $cplcplr->kode_cplr }} {{ $cplcplr->cplr }}<br />
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                            </td>
                            <td class="px-6 py-4 justify-center items-center">
                                <a href="{{ route('show.cpmk', ['id' => $CPMKs->id]) }}">
                                    <button type="button"
                                        class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 ">Petakan
                                        Cpmk</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach --}}
                    @foreach ($CPMK as $key => $value)
                        <tr class="bg-white border-b">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $key + 1 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $value->kode_cpl }} {{ $value->cpl }}
                            </td>
                            <td class="px-6 py-4 ">
                                @foreach ($value->CpltoCplr as $cplcplr)
                                    {{ $cplcplr->kode_cplr }} {{ $cplcplr->cplr }}<br />
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                @forelse ($value->ak_kurikulum_cpmk as $item)
                                    @foreach ($cpm as $cpmk)
                                        @if ($cpmk->id == $item)
                                            <p>{{ $cpmk->kode_cpmk }} {{ $cpmk->cpmk }}</p>
                                        @endif
                                    @endforeach
                                @empty
                                    <p>-</p>
                                @endforelse
                            </td>
                            <td class="px-6 py-4 justify-center items-center">
                                <a href="{{ route('show.cpmk', ['id' => $value->id]) }}">
                                    <button type="button"
                                        class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 ">Petakan
                                        Cpmk</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="justify-center text-center" colspan="5">Data belum ada</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <hr />
    </div>
@endsection
