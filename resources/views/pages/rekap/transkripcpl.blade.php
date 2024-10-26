<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <link rel="icon" type="image/x-icon"
        href="https://ppb.unisayogya.ac.id/wp-content/uploads/2017/08/cropped-logo-unisa-crop.png" />

    @stack('style')

    <title>Cetak Transkrip Nilai {{ $rekap[0]['nim'] }} - {{ $rekap[0]['namalengkap'] }}</title>
</head>


<body>
    <div class="flex justify-center px-3 py-4">
        <h1 class="text-lg font-medium">Transkrip CPL Mahasiswa </h1>
    </div>
    <div class="flex justify-center px-3 py-4">
        <h1 class="text-lg font-medium">{{ $rekap[0]['nim'] }} - {{ $rekap[0]['namalengkap'] }} </h1>
    </div>

    <div>
        <div class="px-3 py-5 ">

            <div class="w-full">
                @foreach ($fix as $grubCpl => $grubCpmk)
                    <table class="w-full overflow-x-scroll border rounded-lg text-sm text-center "
                        style="background-color: rgb(248, 93, 51)">
                        <th class="px-6 py-3 border whitespace-nowrap text-left w-5">
                            {{ $grubCpl }}</th>
                        <th class="px-6 py-3 border text-left">{{ $grubCpmk['cpl_desk'] }}</th>
                    </table>

                    @foreach ($grubCpmk['cpmk'] as $cpmk => $items)
                        <table class="w-full overflow-x-scroll border rounded-lg text-sm text-center"
                            style="background-color: rgb(108, 244, 139)">
                            <th class="px-6 py-3 border whitespace-nowrap w-5">
                                {{ $cpmk }}
                            </th>
                            <th class="px-6 py-3 border text-left">{{ $items['cpmk_desk'] }}</th>
                        </table>

                        <table class="w-full overflow-x-scroll border rounded-lg text-sm text-center"
                            style="margin-bottom: 1rem">
                            <thead class="w-full text-xs text-gray-700 uppercase bg-white">
                                <tr class="border rounded text-center">
                                    <th class="px-6 py-3 border">No</th>
                                    <th class="px-6 py-3 border">Kode Mata Kuliah</th>
                                    <th class="px-6 py-3 border">Nama Mata kuliah</th>
                                    <th class="px-6 py-3 border">Nilai Cpmk</th>
                                    <th class="px-6 py-3 border">Bobot</th>
                                    <th class="px-6 py-3 border">Skor (Nilai * Bobot)</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
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
                                <tr class="rounded-lg font-bold" style="background-color: rgb(92, 170, 238)">
                                    <td class="" colspan="5">
                                        Total
                                        {{ $cpmk }}</td>
                                    <td>{{ $items['total_cpmk'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    @endforeach
                    <table class="w-full overflow-x-scroll border rounded-lg text-sm text-center "
                        style="background-color: rgb(247, 222, 59)">
                        <th class="px-6 py-3 border whitespace-nowrap">
                            Total Skor {{ $grubCpl }}</th>
                        <th class="px-6 py-3 border">{{ $grubCpmk['total_score_cpl'] }}</th>
                    </table>
                    <div class="mb-10" style="margin-bottom: 3rem"></div>
                @endforeach
            </div>
        </div>
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />

        <div>
            <div class="flex left px-3">
                <h1 class="text-lg font-medium">Grafik CPL {{ $rekap[0]['namalengkap'] }} </h1>
            </div>
            <div class="max-w-md items-center" id="chart">
            </div>
        </div>

        <div class="flex justify-start px-5 py-5 mx-10" style="margin-left: 3rem">
            <h1>Yogyakarta, {{ \Carbon\Carbon::now()->format('d') }}
                {{ \Carbon\Carbon::now()->translatedFormat('F') }} {{ \Carbon\Carbon::now()->format('Y') }}</h1>
        </div>
        <br />
        <br />
        <br />
        <div class="flex justify-start px-5 py-5" style="margin-bottom: 5rem">
            <h1>Pengesahan dari Pimpinan Perguruan Tinggi</h1>
        </div>
    </div>


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
                    },
                    dataLabels: {
                        position: 'top' // Menampilkan angka di atas bar
                    }
                }
            },
            dataLabels: {
                enabled: true, // Aktifkan data label
                offsetY: -15, // Mengatur jarak label dari bar
                style: {
                    fontSize: '12px',
                    colors: ["#000"] // Warna teks label
                }
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

</body>

</html>
