@extends('layouts.app')

@section('body')
    <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0">CPL</h1>
        <a href="{{ route('cpl.create') }}">
            <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1">Tambah CPL
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
                        Profile Lulusan
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Kode CPL
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        CPL
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Deskripsi CPL
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Aspek
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        CPLR
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Unit
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($akKurikulumCpl->count() > 0)
                    @foreach ($akKurikulumCpl as $akKurikulumCpls)
                        <tr class="bg-white border-b text-left">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 text-left flex">
                                @foreach ($akKurikulumCpls->CpltoPl as $cplpl)
                                    {{ $cplpl->kode_pl }} {{ $cplpl->profile_lulusan }}
                                    <br />
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumCpls->kode_cpl }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumCpls->cpl }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumCpls->deskripsi_cpl }}
                            </td>
                            <td class=" px-6 py-4 text-">
                                {{ $akKurikulumCpls->aspek }}
                            </td>
                            <td class="px-6 py-4 text-">
                                @foreach ($akKurikulumCpls->CpltoCplr as $cplcplr)
                                    {{ $cplcplr->kode_cplr }} {{ $cplcplr->cplr }}<br />
                                @endforeach
                            </td>
                            <td class=" px-6 py-4 text-left">
                                {{ $akKurikulumCpls->kurikulum }}
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
