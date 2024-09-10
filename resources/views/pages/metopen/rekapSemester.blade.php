@extends('layouts.app')

<br />
@section('body')
    <nav class="flex px-5 py-3 bg-white border shadow-md rounded-lg mb-3 mr-3" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('rekap.index') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                    <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Rekap
                </a>
            </li>
        </ol>
    </nav>

    <div class="flex flex-col">
        <form method="GET" class="rounded">
            {{-- @csrf --}}
            <select name="filter" id="" class="rounded">
                <option value="null">Kurikulum</option>
                @foreach ($kdkurikulum as $item)
                    <option value="{{ $item->kdkurikulum }}" @selected(request()->filter == $item->kdkurikulum)>{{ $item->kurikulum }}
                        {{ $item->tahun }}</option>
                @endforeach
            </select>
            {{-- <input type="text" name="search" class=" rounded"> --}}
            <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1"
                type="submit">Filter</button>
        </form>

        @if (request()->search != null && request()->key != null)
            <div class="my-3">
                <h2 class="fs-5">Key : {{ request()->key }}, Search : {{ request()->search }}</h2>
            </div>
        @endif
    </div>

    <div class="w-full">
        <table class="overflow-x-scroll w-full text-sm text-center  text-gray-500">
            <thead class="w-full text-xs text-gray-700 uppercase bg-white">
                <tr class="w-full text-left over">
                    <th scope="col" class="px-6 py-3 w-[50px]">
                    </th>
                    <th scope="col" class="px-6 py-3">
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                    </th>
                    <th scope="col" class="px-6 py-3 ">

                    </th>
                    @foreach ($tabel as $tbl)
                        <th scope="col" class=" w-full px-6 py-3 ">
                            {{ $tbl->matakuliah }}
                        </th>
                    @endforeach
                </tr>
                <tr class="w-full text-left over">
                    <th scope="col" class="px-6 py-3 w-[50px]">
                    </th>
                    <th scope="col" class="px-6 py-3">
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                    </th>
                    <th scope="col" class="px-6 py-3 ">

                    </th>
                    @foreach ($tabel as $tbl)
                        <th scope="col" class=" w-full px-6 py-3 ">
                            {{ $tbl->kode_cpl }}
                        </th>
                    @endforeach
                </tr>
                <tr class="text-left">
                    <th scope="col" class=" px-6 py-3 w-[50px]">
                    </th>
                    <th scope="col" class="px-6 py-3">
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                    </th>
                    <th scope="col" class="px-6 py-3 ">

                    </th>
                    @foreach ($tabel as $tbl)
                        <th scope="col" class="w-full px-6 py-3 ">
                            {{ $tbl->kode_cpmk }}
                        </th>
                    @endforeach
                </tr>
                <tr class="text-left">
                    <th scope="col" class="px-6 py-3 w-[50px]">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nim
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Nama Mahasiswa
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Nilai Akhir
                    </th>
                    @foreach ($tabel as $tbl)
                        <th scope="col" class="w-full px-6 py-3 ">
                            {{ $tbl->metode_penilaian }}
                        </th>
                    @endforeach
                </tr>
                <tr class="">
                    <th scope="col" class="px-6 py-3">

                    </th>
                    <th scope="col" class="px-6 py-3">

                    </th>
                    <th scope="col" class="px-6 py-3">

                    </th>
                    <th scope="col" class="px-6 py-3">

                    </th>
                    @foreach ($tabel as $tbl)
                        <th scope="col" class="w-full px-6 py-3 text-left items-center">
                            {{ $tbl->bobot }}%
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswa as $key => $value)
                    @if ($value[0] == null)
                        <tr>
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $loop->iteration }}
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
                    @break;
                @endif
                <tr class=" border-b text-left shadow">
                    <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $value[2] }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $value[3] }}
                        {{-- </td>
                        <td class="px-6 py-4">
                            {{ $value[4] }}
                        </td> --}}
                    <td class="px-6 py-4">
                        {{ number_format($value[5], 2) }}
                    </td>
                    @foreach ($value[6] as $nilai)
                        <td class="px-6 py-4">
                            {{ number_format($nilai, 2) }}
                        </td>
                    @endforeach
                </tr>
            @endforeach

        </tbody>
    </table>
</div>

<div class="flex items-center justify-between py-5 px-5">
    <div class="flex items-center">
        <h1 class="font-bold text-2xl mb-0 text-gray-700 text-center">
            Grafik Statistik Ketercapaian CPMK
        </h1>
    </div>
</div>

<div class="max-w-md items-center py-2  " id="chart">
</div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var options = {
        series: [{
            data: @json($statistik['score'] ?? null)
        }],
        chart: {
            type: 'bar',
            height: 550
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                borderRadiusApplication: 'end',
                colors: {
                    ranges: [{
                        from: 0,
                        to: 60,
                        color: '#FF0000'
                    }, {
                        from: 61,
                        to: 100,
                        color: '#00E396'
                    }]
                }
            }
        },
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories: @json($statistik['label'] ?? null),
        },
        yaxis: {
            min: 0,
            max: 100
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>
@endpush
