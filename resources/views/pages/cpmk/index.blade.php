@extends('layouts.app')

@section('body')
    <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0">CPMK</h1>
        <div class="flex items-center justify-end py-5 mx-5 space-x-2">
            <a href="{{ route('cpmk.create') }}">
                <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1">Tambah
                    CPMK
                </button>
            </a>
            <a href="">
                <button class="bg-green-600 hover:bg-green-800 text-white rounded px-2 text-md font-semibold p-1">Petakan
                    CPMK
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

                </tr>
            </thead>
            <tbody>
                @if ($akKurikulumCpmk->count() > 0)
                    @foreach ($akKurikulumCpmk as $akKurikulumCpmks)
                        <tr class="bg-white border-b">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $loop->iteration }}
                            </td>
                            <td class=" px-6 py-4 ">
                                {{ $akKurikulumCpmks->kode_cpl }} {{ $akKurikulumCpmks->cpl }}
                            </td>
                            <td class="px-6 py-4 ">
                                @foreach ($akKurikulumCpmks->CpltoCplr as $cplcplr)
                                    {{ $cplcplr->kode_cplr }}<br />
                                @endforeach
                            </td>
                            <td class=" px-6 py-4 text-left">
                                @foreach ($akKurikulumCpmks->CpltoCpmk as $cplcpmk)
                                    {{ $cplcpmk->kode_cpmk }} {{ $cplcpmk->cpmk }} <br />
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="justify-center text-center" colspan="8">CPL belum ada</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <hr />
    </div>
@endsection
