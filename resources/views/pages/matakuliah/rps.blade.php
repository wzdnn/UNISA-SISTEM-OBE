@extends('layouts.app')

@push('style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

<br>

@section('body')
    {{-- BreadCrumbs --}}
    <nav class="flex px-5 py-3 bg-white shadow-md mb-3" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('index.mk') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                    <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Matakuliah </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="{{ route('detail.mk', ['id' => $matakuliah->kdmatakuliah]) }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 ">Detail
                        {{ $matakuliah->kodematakuliah }} {{ $matakuliah->matakuliah }}</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">RPS
                        {{ $matakuliah->kodematakuliah }} {{ $matakuliah->matakuliah }}</span>
                </div>
            </li>
    </nav>

    <div class="bg-white px-5 py-5 rounded">
        <div class="items-center ">
            <table class="w-full border-collapse border space-x-0" id="mytable" name="mytable">
                <thead>
                    <tr class="border text-left ">
                        <th class="items-center px-4 py-2">
                            <img src="https://ppb.unisayogya.ac.id/wp-content/uploads/2017/08/cropped-logo-unisa-crop.png"
                                alt="icon unisa" width="100" class="mx-auto center" />
                        </th>
                        <th class="border px-4 py-2" colspan="7">
                            <h2 class="font-bold">Universitas 'Aisyiyah Yogyakarta</h2>
                            <h3 class="font-medium text-sm">Fakultas</h3>
                            <h3 class="font-medium text-sm">{{ auth()->user()->load('namaKdUnit')->namaKdUnit->unitkerja }}
                            </h3>
                            <h3 class="font-medium text-sm">Program: Sarjana</h3>
                            <h3 class="font-medium text-sm">Tahun Akademik</h3>
                        </th>
                        <th class="border px-4 py-2" colspan="4">
                            <h3 class="font-medium text-sm">KODE DOKUMEN</h3>
                        </th>
                        <th class="border px-4 py-2" colspan="4">
                            <h3 class="font-medium text-sm">KODE MATA KULIAH : {{ $matakuliah->kodematakuliah }}</h3>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border ">
                        <td colspan="15" class="bg-blue-100">
                            <h3 class="text-center font-semibold text-lg uppercase">rencana
                                pembelajaran
                                semester (RPS)
                            </h3>
                        </td>
                    </tr>
                    <tr class="text-center justify-center font-bold bg-green-100">
                        <td class="border px-4 py-2">
                            Kode Matakuliah
                        </td>
                        <td class="border px-4 py-2">
                            Nama Blok
                        </td>
                        <td class="border px-4 py-2" colspan="5">
                            Bobot (SKS)
                        </td>
                        <td class="border px-4 py-2" colspan="2">
                            Semester
                        </td>
                        <td class="border px-4 py-2" colspan="2">
                            Status Mata Kuliah
                        </td>
                        <td class="border px-4 py-2" colspan="4">
                            Matakuliah Prasyarat
                        </td>
                    </tr>
                    <tr class="text-center justify-center">
                        <td class="border px-4 py-2 font-bold">
                            {{ $matakuliah->kodematakuliah }}
                        </td>
                        <td class="border px-4 py-2">

                        </td>
                        <td class="border px-4 py-2">
                            Teori
                        </td>
                        <td class="border px-4 py-2">
                            Seminar
                        </td>
                        <td class="border px-4 py-2">
                            Tutorial
                        </td>
                        <td class="border px-4 py-2">
                            Praktikum / Skill Lab
                        </td>
                        <td class="border px-4 py-2">
                            Praktik
                        </td>
                        <td class="border px-4 py-2" colspan="2">
                            {{ $matakuliah->semester }}
                        </td>
                        <td class="border px-4 py-2" colspan="2">
                            {{ $matakuliah->status }}
                        </td>
                        <td class="border px-4 py-2" colspan="4">
                            -
                        </td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Deskripsi Singkat Matakuliah</td>
                        <td class="border px-4 py-2" colspan="15">{{ $matakuliah->deskripsi_mk ?? '' }}</td>
                    </tr>
                    <tr>
                        <td colspan="1" class="border px-4 py-2 font-bold">Capaian Pembelajaran Lulusan (CPL) yang
                            Dibebankan pada MK
                        </td>
                        @foreach ($cpl as $cpls)
                            <td class="border text-center font-bold items-center justify-center bg-green-100">
                                {{ $cpls->kode_cpl ?? '' }}</td>
                            <td colspan="2">{{ $cpls->deskripsi_cpl ?? '' }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="border px-4 py-2 font-bold">Capaian Pembelajaran Mata Kuliah (CPMK)</td>
                        <td colspan="15" class="border px-4 py-2 font-medium bg-green-100">Setelah menyelesaikan
                            pembelajaran mata
                            kuliah ini, mahasiswa diharapkan mampu:</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2"></td>
                        @foreach ($cpmk as $cpmks)
                            <td class="border text-center font-bold items-center justify-center bg-green-100">
                                {{ $cpmks->kode_cpmk ?? '' }}</td>
                            <td colspan="2">{{ $cpmks->cpmk ?? '' }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="border px-4 py-2 font-bold">Kaitan CPMK
                            dengan Materi dan
                            Bentuk
                            Pembelajaran,
                            serta Alokasi
                            Waktu</td>
                        <td class="border px-4 py-2"></td>
                        <td class="border px-4 py-2 font-bold" colspan="6">Bahan Kajian</td>
                        <td class="border px-4 py-2 font-bold" colspan="3">Bentuk Pembelajaran</td>
                        <td class="border px-4 py-2 font-bold" colspan="3">Metode Pembelajaran</td>
                        <td class="border px-4 py-2 font-bold" colspan="3">Alokasi Waktu</td>
                    </tr>
                    @foreach ($relation as $relasi)
                        <tr>
                            <td class="border px-4 py-2">

                            </td>
                            <td class="border px-4 py-2 ">
                                {{ $relasi->kode_cpmk ?? '' }}
                            </td>
                            <td class="border px-4 py-2" colspan="6">
                                {{ $relasi->kode_subbk ?? '' }} - {{ $relasi->sub_bk ?? '' }}
                            </td>
                            <td class="border px-4 py-2" colspan="3">
                                -
                            </td>
                            <td class="border px-4 py-2" colspan="3">
                                {{ $relasi->metodepembelajaran ?? '' }}
                            </td>
                            <td class="border px-4 py-2" colspan="3">
                                -
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="border px-4 py-2 font-bold">Pengalaman Belajar Mahasiswa</td>
                        <td colspan="15" class="border px-4 py-2">
                            Saat Sinkron : <br />
                            @foreach ($sinkron as $s)
                                {{ $loop->iteration ?? '' }}.
                                {{ $s->pengalaman_mahasiswa ?? '' }} <br />
                            @endforeach
                            <br />
                            Saat Asinkron : <br />
                            @foreach ($asinkron as $as)
                                {{ $loop->iteration ?? '' }}.
                                {{ $as->pengalaman_mahasiswa ?? '' }}<br />
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2 font-bold">Akses Media
                            Pembelajaran/
                            LMS
                            dan Persentase
                            Luring & Daring</td>
                        <td colspan="6" class="border px-4 py-2">
                            {{-- @foreach ($aksesmedia as $am)
                                {{ $am->kdakses }}
                            @endforeach --}}
                            {{ $aksesmedia->linkakses ?? '' }}
                        </td>
                        <td colspan="3" class=" border px-4 py-2">Luring : {{ $aksesmedia->luring ?? '' }}%</td>
                        <td colspan="3" class=" border px-4 py-2">Daring : {{ $aksesmedia->daring ?? '' }}%</td>
                        <td colspan="3" class=" border px-4 py-2">Blended : :{{ $aksesmedia->blended ?? '' }}%</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2 font-bold">
                            Metode Penilaian
                            dan Keselarasan
                            dengan CPMK
                        </td>
                        <td colspan="5" class="border px-4 py-2 font-bold">Metode Penilaian</td>
                        <td colspan="5" class="border px-4 py-2 font-bold">Bobot Penilaian (%)</td>
                        <td colspan="5" class="border px-4 py-2 font-bold">Komponen Evaluasi (kriteria/Indikator)</td>
                    </tr>
                    @foreach ($metodebobot as $mb)
                        <tr>
                            <td>

                            </td>

                            <td colspan="5" class="border px-4 py-2 ">
                                {{ $mb->metode_penilaian ?? '' }}
                            </td>

                            <td colspan="5" class="border px-4 py-2 ">
                                {{ $mb->bobot ?? '' }}
                            </td>
                            <td colspan="5" class="border px-4 py-2 ">
                                -
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="border px-4 py-2 font-bold">Daftar Referensi</td>
                        <td colspan="15" class="border px-4 py-2">
                            <p class="font-bold">Referensi Utama :</p>
                            @foreach ($referensiUtama as $utama)
                                {{ $loop->iteration ?? '' }}. {{ $utama->referensi ?? '' }}
                            @endforeach
                            <br />
                            <p class="font-bold">Referensi Tambahan :</p>
                            @foreach ($referensiTambahan as $tambahan)
                                {{ $loop->iteration ?? '' }}. {{ $tambahan->referensi ?? '' }}
                            @endforeach
                            <br />

                            <p class="font-bold">Referensi Luaran :</p>
                            @foreach ($referensiLuaran as $luaran)
                                {{ $loop->iteration ?? '' }}. {{ $luaran->referensi ?? '' }}
                            @endforeach
                            <br />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white px-5 py-5 rounded">
        <div>
            <h1 class="font-semibold text-xl uppercase px-2">Timeline Pembelajaran Mingguan</h1>
        </div>

        <div class="my-1 w-full mx-auto rounded">
            <table class="w-full text-sm rounded text-gray-500" id="mytable" name="mytable"
                style="border: 1 !important">
                <thead class="text-xs text-gray-700 uppercase bg-white">
                    <tr class="text-left">
                        <th scope="col" class="px-6 py-3 ">
                            No.
                        </th>
                        <th scope="col" class="px-6 py-3 ">
                            Minggu Ke-
                        </th>
                        <th scope="col" class="px-6 py-3 ">
                            CPMK
                        </th>
                        <th scope="col" class="px-6 py-3 ">
                            Materi
                        </th>
                        <th scope="col" class="px-6 py-3 ">
                            Metode Pembelajaran
                        </th>
                        <th scope="col" class="px-6 py-3 ">
                            Dosen
                        </th>
                        <th scope="col" class="px-6 py-3 ">
                            Bentuk Pembelajaran
                    </tr>
                </thead>
                <tbody>
                    @if ($timeline->count() > 0)
                        @foreach ($timeline as $key => $t)
                            <tr class="{{ $key % 2 == 0 ? 'bg-gray-100' : 'bg-gray-50' }} border-b text-left">
                                <td class="px-6 py-4">
                                    {{ $loop->iteration ?? '' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $t->mingguke ?? '' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $t->kode_cpmk ?? '' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $t->kode_subbk ?? '' }} {{ $t->materi_pembelajaran ?? '' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $t->metodepembelajaran ?? '' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $t->namalengkap ?? '' }} {{ $t->gelarbelakang ?? '' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $t->jeniskuliah ?? '' }}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="justify-center text-center" colspan="20">Data belum ada</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <script>
        //on load
        $(function() {
            // MergeGridCells('#mytable', 7, false);

            MergeGridCells('#mytable', 2, false);
            MergeGridCells('#mytable', 1, false);


        });

        function MergeGridCells(table_id, dimension_col, is_alternate_color) {
            let i = 0;
            // first_instance holds the first instance of identical td
            // first_instance menyimpan kata yang sama
            let first_instance = null;
            // how many identical td?
            // berapa baris yang sama?
            let rowspan = 1;
            let first_text = '';
            // iterate through rows
            // loop untuk setiap baris
            $(table_id + ' > tbody  > tr').each(function() {

                // find the td of the correct column (determined by the dimension_col set above)
                // ambil teks (sesuai dengan kolom ke-dimension_col)
                let dimension_td = $(this).find('td:nth-child(' + dimension_col + ')');
                let text = btoa(dimension_td[0].innerHTML.trim());

                if (first_instance == null) {
                    // must be the first row
                    // baris pertama
                    first_instance = dimension_td;
                    first_text = text;
                    i++;
                    painting(is_alternate_color, first_instance, i);
                } else if (text == first_text) {
                    // the current td is identical to the previous
                    // baris ini sama dengan baris sebelumnya
                    // remove the current td
                    // delete baris ini
                    dimension_td.remove();
                    ++rowspan;
                    // increment the rowspan attribute of the first instance
                    // baris ini di merge dengan sebelumnya dengan cara menaikkan rowspan baris pertama yang sama sampai dengan baris ini
                    first_instance.attr('rowspan', rowspan);
                    painting(is_alternate_color, first_instance, i);
                } else {
                    // this cell is different from the last, stop previous rowspan
                    // baris ini berbeda dengan yang sebelumnya, hentikan proses merger sebelumnya
                    first_instance = dimension_td;
                    first_text = text;
                    rowspan = 1;
                    i++;
                    painting(is_alternate_color, first_instance, i);
                }

            });
        }

        function painting(is_alternate_color, instance, i) {
            if (is_alternate_color)
                instance.attr('style', 'background-color: ' + ((i % 2 == 0) ? '#FFFFB6' : '#ff9da4'));
        }
    </script>
@endsection
