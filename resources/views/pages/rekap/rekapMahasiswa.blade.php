@extends('layouts.app')

@push('style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

<br>
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

    <div class="px-5 py-3 bg-white border border-gray-200 rounded-lg shadow-lg justify-between mb-3 mr-3">

        <div class="w-full   p-4">
            <form class="flex justify-start max-w-md" action="" method="GET">
                <label for="nim" class="sr-only">Search</label>
                <div class="relative w-full">
                    <input type="text" name="nim" id="nim"
                        class="bg-gray-50 border border-gray-300 px-6 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Ketik NIM" />
                </div>
                <button type="submit"
                    class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </form>
        </div>

        <div class="flex justify-between px-3 py-4">
            <h1 class="text-lg font-medium">Rekap Ketercapaian CPL Mahasiswa</h1>
        </div>

        <div class="px-3 py-5">
            <table name="mytable" id="mytable"
                class="overflow-x-scroll border rounded-lg w-auto text-sm text-center text-gray-500">
                <thead class="w-full text-xs text-gray-700 uppercase bg-white">
                    <tr class="w-full border rounded text-center">
                        <th>Nim</th>
                        <th>Nama</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border rounded text-left">
                        <td class="px-6 py-3 border">
                            {{ $rekap[0]['nim'] }}
                        </td>
                        <td class="px-6 py-3 border rounded">
                            {{ $rekap[0]['namalengkap'] }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <br />

            <div class="w-full">
                @foreach ($fix as $grubCpl => $grubCpmk)
                    <table class="w-full overflow-x-scroll border rounded-lg text-sm text-center ">
                        <th class="px-6 py-3 border whitespace-nowrap text-left"
                            style="background-color: rgb(57, 146, 223)">
                            {{ $grubCpl }}</th>
                        <th class="px-6 py-3 border text-left">{{ $grubCpmk['cpl_desk'] }}</th>
                    </table>

                    @foreach ($grubCpmk['cpmk'] as $cpmk => $items)
                        <table class="w-full overflow-x-scroll border rounded-lg text-sm text-center">
                            <th class="px-6 py-3 border" style="background-color: rgb(108, 244, 139)">
                                {{ $cpmk }}
                            </th>
                            <th class="px-6 py-3 border text-left">{{ $items['cpmk_desk'] }}</th>
                        </table>

                        <table class="w-full overflow-x-scroll border rounded-lg text-sm text-center"
                            style="margin-bottom: 1rem">
                            <thead class="w-full text-xs text-gray-700 uppercase bg-white">
                                <tr class="bg-white border rounded text-center">
                                    <th class="px-6 py-3 border">No</th>
                                    <th class="px-6 py-3 border">Kode Mata Kuliah</th>
                                    <th class="px-6 py-3 border">Nama Mata kuliah</th>
                                    <th class="px-6 py-3 border">Nilai Cpmk</th>
                                    <th class="px-6 py-3 border">Bobot</th>
                                    <th class="px-6 py-3 border">Skor (Nilai * Bobot)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items['data'] as $key => $value)
                                    <tr class="text-center">
                                        <td class="px-6 py-3 border">{{ $key + 1 }}</td>
                                        <td class="px-6 py-3 border">{{ $value['kodematakuliah'] }}</td>
                                        <td class="px-6 py-3 border">{{ $value['matakuliah'] }}</td>
                                        <td class="px-6 py-3 border">{{ $value['nilai'] }}</td>
                                        <td class="px-6 py-3 border">{{ $value['total_bobot'] }}</td>
                                        <td class="px-6 py-3 border">{{ round($value['skor_nilaixbobot']) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="text-white" colspan="5" style="background-color: rgb(57, 146, 223)">Total
                                        {{ $cpmk }}</td>
                                    <td>{{ $items['total_cpmk'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    @endforeach
                    {{-- @foreach ($totalCpmkFix as $cplTotal => $cpmkTotal)
                        @foreach ($cpmkTotal as $key => $item)
                            @foreach ($item['data'] as $cpmks)
                                <table class="w-full overflow-x-scroll border rounded-lg text-sm text-center">
                                    <th class="px-6 py-3 border" style="background-color: rgb(57, 146, 223)">
                                        {{ $cpmks['kode_cpmk'] }}</th>
                                    <th class="px-6 py-3 border">{{ $cpmks['total_cpmk'] }}</th>
                                </table>
                            @endforeach
                        @endforeach
                    @endforeach --}}

                    <table class="w-full overflow-x-scroll border rounded-lg text-sm text-center ">
                        <th class="px-6 py-3 border whitespace-nowrap" style="background-color: rgb(247, 222, 59)">
                            Total Skor {{ $grubCpl }}</th>
                        <th class="px-6 py-3 border">{{ $grubCpmk['total_score_cpl'] }}</th>
                    </table>
                    <div class="mb-10" style="margin-bottom: 5rem"></div>
                @endforeach
            </div>

        </div>
        <div class="max-w-md items-center" id="chart">
        </div>
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
