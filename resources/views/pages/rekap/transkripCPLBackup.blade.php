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
    <div name="informasi-awal" class="flex flex-col justify-end px-3">
        <div class="grid-cols-2 mb-2">
            <div class="flex justify-end">
                <div>
                    <p class="font-bold">I. INFORMASI TENTANG IDENTITAS DIRI PEMEGANG SKPI</p>
                    <i class="ml-3 text-left text-sm">INFORMATION of PERSONAL INFORMATION DIPLOMA SUPPLEMENT HOLDER</i>
                </div>
            </div>
            <div class="flex justify-end">
                <table class="border">
                    <tr>
                        <td class="px-3 py-2 border font-bold">
                            I.1
                        </td>
                        <td class="px-3 py-2 border">
                            <p>Nama Lengkap dan Gelar</p>
                            <i class="text-sm">Full Name and title</i>
                        </td>
                        <td class="px-3 py-2 border">
                            {{ $rekap[0]['namalengkap'] }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 border font-bold">
                            I.2
                        </td>
                        <td class="px-3 py-2 border">
                            <p>Tempat dan Tanggal Lahir</p>
                            <i class="text-sm">Place and Date of Birth</i>
                        </td>
                        <td class="px-3 py-2 border">
                            {{ $rekap[0]['tempatlahir'] }}, {{ $rekap[0]['tanggallahir'] }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 border font-bold">
                            I.3
                        </td>
                        <td class="px-3 py-2 border">
                            <p>Nomor Induk Mahasiswa</p>
                            <i class="text-sm">Student Identification Number</i>
                        </td>
                        <td class="px-3 py-2 border">
                            {{ $rekap[0]['nim'] }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 border font-bold">
                            I.4
                        </td>
                        <td class="px-3 py-2 border">
                            <p>Tahun Masuk</p>
                            <i class="text-sm">Year of Admission</i>
                        </td>
                        <td class="px-3 py-2 border">
                            {{ $rekap[0]['kdtamasuk'] }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 border font-bold">
                            I.5
                        </td>
                        <td class="px-3 py-2 border">
                            <p>Tahun Lulus</p>
                            <i class="text-sm">Year of Graduation</i>
                        </td>
                        <td class="px-3 py-2 border">
                            -
                        </td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 border font-bold">
                            I.6
                        </td>
                        <td class="px-3 py-2 border">
                            <p>Nomor Ijazah Nasional</p>
                            <i class="text-sm">Number of National Certification</i>
                        </td>
                        <td class="px-3 py-2 border">
                            -
                        </td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 border font-bold">
                            I.7
                        </td>
                        <td class="px-3 py-2 border">
                            <p>Gelar</p>
                            <i class="text-sm">title</i>
                        </td>
                        <td class="px-3 py-2 border">
                            {{ $yudisium->gelar }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="grid-cols-2 mb-2">
            <div class="flex justify-end">
                <div>
                    <p class="font-bold">II. INFORMASI TENTANG IDENTITAS PENYELENGGARA PROGRAM</p>
                    <i class="ml-3 text-left text-sm">INFORMATION of IDENTITY HIGHER EDUCATION INSTITUTION</i>
                </div>
            </div>
            <div class="flex justify-end">
                <table class="border">
                    <tr>
                        <td class="px-3 py-2 border font-bold">
                            II.1
                        </td>
                        <td class="px-3 py-2 border">
                            <p>SK Pendirian Perguruan Tinggi</p>
                            <i class="text-sm">Full Name and title</i>
                        </td>
                        <td class="px-3 py-2 border">
                            -
                        </td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 border font-bold">
                            II.2
                        </td>
                        <td class="px-3 py-2 border">
                            <p>Nama Perguruan Tinggi</p>
                            <i class="text-sm">Name of University</i>
                        </td>
                        <td class="px-3 py-2 border">
                            Universitas 'Aisyiyah Yogyakarta
                        </td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 border font-bold">
                            II.3
                        </td>
                        <td class="px-3 py-2 border">
                            <p>Nama Program Studi</p>
                            <i class="text-sm">Study Program</i>
                        </td>
                        <td class="px-3 py-2 border">
                            {{ $programStudi->namaprodi }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 border font-bold">
                            II.4
                        </td>
                        <td class="px-3 py-2 border">
                            <p>Jenis Pendidikan</p>
                            <i class="text-sm">Classification Study</i>
                        </td>
                        <td class="px-3 py-2 border">
                            Universitas
                        </td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 border font-bold">
                            II.5
                        </td>
                        <td class="px-3 py-2 border">
                            <p>Jenjang Pendidikan</p>
                            <i class="text-sm">Level of Education</i>
                        </td>
                        <td class="px-3 py-2 border">
                            {{ $yudisium->jenjang }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 border font-bold">
                            II.6
                        </td>
                        <td class="px-3 py-2 border">
                            <p>Jenjang Kualifikasi Sesuai KKNI</p>
                            <i class="text-sm">Level of Qualification in the National Qualification Framework(KKNI)</i>
                        </td>
                        <td class="px-3 py-2 border">
                            Level {{ $programStudi->levelkkni }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 border font-bold">
                            II.7
                        </td>
                        <td class="px-3 py-2 border">
                            <p>Persyaratan Penerimaan</p>
                            <i class="text-sm">Entry Requirement</i>
                        </td>
                        <td class="px-3 py-2 border">
                            {{ $programStudi->persyaratanpenerimaan }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 border font-bold">
                            II.8
                        </td>
                        <td class="px-3 py-2 border">
                            <p>Bahasa Pengantar Kuliah</p>
                            <i class="text-sm">Language Study</i>
                        </td>
                        <td class="px-3 py-2 border">
                            {{ $programStudi->bahasapengantar }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 border font-bold">
                            II.9
                        </td>
                        <td class="px-3 py-2 border">
                            <p>Sistem Penilaian</p>
                            <i class="text-sm">Grading System</i>
                        </td>
                        <td class="px-3 py-2 border">
                            {{ $programStudi->sistempenilaian }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 border font-bold">
                            II.10
                        </td>
                        <td class="px-3 py-2 border">
                            <p>Lama Studi Reguler</p>
                            <i class="text-sm">Reguler Study Period</i>
                        </td>
                        <td class="px-3 py-2 border">
                            4 Tahun
                        </td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 border font-bold">
                            II.11
                        </td>
                        <td class="px-3 py-2 border">
                            <p>Pendidikan Lanjutan</p>
                            <i class="text-sm">Access to Further Study</i>
                        </td>
                        <td class="px-3 py-2 border">
                            {{ $programStudi->pendidikanlanjutan }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 border font-bold">
                            II.12
                        </td>
                        <td class="px-3 py-2 border">
                            <p>Status Profesi</p>
                            <i class="text-sm">Professional Status</i>
                        </td>
                        <td class="px-3 py-2 border">
                            -
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div name="informasi-cpl-ttd">
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

                        <table class="w-full overflow-x-scroll border rounded-lg text-sm text-center">
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
                                    <tr class="text-center ">
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
                    {{-- <div class="mb-10" style="margin-bottom: 3rem"></div> --}}
                @endforeach
            </div>
        </div>
        <div>
            <div class="flex left px-3">
                <h1 class="text-lg font-medium">Grafik CPL {{ $rekap[0]['namalengkap'] }} </h1>
            </div>
            <div class="max-w-md items-center" id="chart">
            </div>
        </div>


        <div class="grid-cols-2 px-3 mb-5">
            <div class="flex justify-start">
                <div>
                    <p class="font-bold">III. INFORMASI TENTANG KUALIFIKASI DAN HASIL YANG DICAPAI</p>
                    <i class="ml-3 text-left text-sm">INFORMATION of QUALIFICATION AND LEARNING OUTCOME</i>
                </div>
            </div>
            <div class="flex justify-start">
                <table class="border">
                    <tr>
                        <td class="px-3 py-2  font-bold">
                            1.
                        </td>
                        <td class="px-3 py-2 ">
                            <p>Kepemimpinan (Dari Unversitas)</p>
                            <i class="text-sm">Leadership (From University)</i>
                        </td>
                    </tr>
                    <tr class="border">
                        <td>

                        </td>
                        <td>
                            <p>- Pespama</p>
                            <p>- BAP</p>
                            <p>- OSCIE</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2  font-bold">
                            2.
                        </td>
                        <td class="px-3 py-2 ">
                            <p>Pengembangan Diri</p>
                            <i class="text-sm">Personal Development</i>
                        </td>
                    </tr>
                    <tr class="border">
                        <td>

                        </td>
                        <td>
                            <p>- Himpunan Mahasiswa Teknologi Informasi</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <br />
        <br />


        <div>
            <table class="w-full border-collapse">
                <!-- Baris untuk lokasi dan tanggal -->
                <tr class="w-full">
                    <td class="text-left w-1/2"></td>
                    <td class="text-right px-5 w-1/2">
                        <h1 id="indo">Diterbitkan di Yogyakarta, {{ \Carbon\Carbon::now()->format('d') }}
                            {{ \Carbon\Carbon::now()->translatedFormat('F') }}
                            {{ \Carbon\Carbon::now()->format('Y') }}
                        </h1>
                    </td>
                </tr>
                <!-- Baris untuk Rektor dan Dekan -->
                <tr class="w-full">
                    <td class="px-5 text-left w-1/2">
                        <h1 id="indo">{{ $yudisium->jabatanttd1transkrip }}</h1>
                    </td>
                    <td class="px-5 text-right w-1/2">
                        <h1 id="indo">{{ $yudisium->jabatanttd2transkrip }}</h1>
                    </td>
                </tr>
                <!-- Baris kosong untuk spasi tambahan -->
                <tr>
                    <td colspan="2">
                        <br />
                        <br />
                        <br />
                        <br />
                    </td>
                </tr>
                <!-- Baris untuk nama rektor dan dekan -->
                <tr class="w-full">
                    <td class="px-5 text-left w-1/2">
                        {{ $yudisium->namattd1transkrip }}
                    </td>
                    <td class="px-5 text-right w-1/2">
                        {{ $yudisium->namattd2transkrip }}
                    </td>
                </tr>
            </table>

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
