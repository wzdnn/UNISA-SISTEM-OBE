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
    </nav>

    <div class="bg-white px-5 py-5  rounded">
        <div class="items-center ">
            <table class="w-full border-collapse border space-x-0">
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
                        <th class="border px-4 py-2">
                            <h3 class="font-medium text-sm">KODE DOKUMEN</h3>
                        </th>
                        <th class="border px-4 py-2">
                            <h3 class="font-medium text-sm">KODE MATA KULIAH : {{ $matakuliah->kodematakuliah }}</h3>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border ">
                        <td colspan="10" class="bg-blue-100">
                            <h3 class="text-center font-semibold text-lg uppercase">rencana program dan kegiatan
                                pembelajaran
                                semester (RPKPS)
                            </h3>
                        </td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">
                            Kode Matakuliah
                        </td>
                        <td class="border px-4 py-2">
                            Nama Blok
                        </td>
                        <td class="border px-4 py-2" colspan="5">
                            Bobot (SKS)
                        </td>
                        <td class="border px-4 py-2">
                            Semester
                        </td>
                        <td class="border px-4 py-2">
                            Status Mata Kuliah
                        </td>
                        <td class="border px-4 py-2">
                            Matakuliah Prasyarat
                        </td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2 font-bold">
                            {{ $matakuliah->kodematakuliah }}
                        </td>
                        <td class="border px-4 py-2">

                        </td>
                        <td class="border px-4 py-2">

                        </td>
                        <td class="border px-4 py-2">

                        </td>
                        <td class="border px-4 py-2">

                        </td>
                        <td class="border px-4 py-2">

                        </td>
                        <td class="border px-4 py-2">

                        </td>
                        <td class="border px-4 py-2">

                        </td>
                        <td class="border px-4 py-2">

                        </td>
                        <td class="border px-4 py-2">

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
