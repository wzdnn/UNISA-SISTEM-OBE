@extends('layouts.app')

@push('style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

<br>
@section('body')
    <div class="w-full border border-gray-100  p-4">
        {{-- <form action="" method="GET">
            <label for="nim">NIM Mahasiswa</label>
            <input type="text" name="nim" id="nim">
            <button type="submit">Cari</button>
        </form> --}}


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



        {{-- <form class="flex justify-center max-w-md mx-auto" action="" method="GET">
            <label for="nim" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <input type="search" name="nim" id="nim"
                    class="block w-full p-4 px-6 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Ketik Nim" />
                <button type="submit"
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form> --}}

    </div>



    <div class="flex justify-between px-3 py-4">
        <h1 class="text-lg font-medium">Rekap Ketercapaian CPL Mahasiswa</h1>
    </div>

    <div class="px-3 py-5">
        <table name="mytable" id="mytable" class="overflow-x-scroll w-auto text-sm text-center text-gray-500">
            <thead class="w-full text-xs text-gray-700 uppercase bg-white">
                <tr class="w-full  text-center">
                    <th>Nim</th>
                    <th>Nama</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white text-left">
                    <td class="">
                        {{ $rekap[0]['nim'] }}
                    </td>
                    <td class="px-6 py-3">
                        {{ $rekap[0]['namalengkap'] }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="max-w-md items-center" id="chart">
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
