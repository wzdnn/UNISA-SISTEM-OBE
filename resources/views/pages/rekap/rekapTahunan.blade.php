@extends('layouts.app')

<br />
@section('body')
    <div class="flex flex-col">
        <form method="GET" class="rounded">
            {{-- @csrf --}}
            <select name="filter" id="" class="rounded">
                <option value="null">Kurikulum</option>
                @foreach ($kdkurikulum as $item)
                    <option value="{{ $item->kdkurikulum }}" @selected(request()->filter == $item->kdkurikulum)>{{ $item->kurikulum }}</option>
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
        <table name="mytable" id="mytable" class="overflow-x-scroll w-full text-sm text-center  text-gray-500">
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
                    </td>
                    <td class="px-6 py-4">
                        {{ $value[4] }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $value[5] }}
                    </td>
                    @foreach ($value[6] as $nilai)
                        <td class="px-6 py-4">
                            {{ $nilai }}
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
            Grafik Statistik Ketercapaian CPL
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
            }
        },
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories: @json($statistik['label'] ?? null),
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>
@endpush
