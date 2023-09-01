@extends('layouts.app')

@section('body')
    <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0">CPMK</h1>
        <a href="{{ route('list.cpmk') }}">
            <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1">List CPMK
            </button>
        </a>
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
                @if ($CPMK->count() > 0)
                    @foreach ($CPMK as $CPMKs)
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
