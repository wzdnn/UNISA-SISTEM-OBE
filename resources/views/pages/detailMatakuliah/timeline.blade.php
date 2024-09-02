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
                <a href="{{ route('index.mk') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                    <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Matakuliah
                </a>
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

            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="{{ route('timeline.index', ['id' => $matakuliah->kdmatakuliah]) }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 ">Timeline Matakuliah</a>
                </div>
            </li>
        </ol>
    </nav>


    <div class="bg-white rounded px-4 py-2">
        <div>
            <h1 class="font-semibold text-xl uppercase">Timeline Pembelajaran Mingguan</h1>
            <h1 class="font-semibold text-xl">Matakuliah : {{ $matakuliah->matakuliah }}</h1>
        </div>
        <div class="flex items-end justify-end mb-2">
            <a href="{{ route('timeline.create', ['id' => $matakuliah->kdmatakuliah]) }}">
                <button
                    class="flex items-center bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1">Tambah
                    Timeline</button>
            </a>
        </div>
    </div>


    <div class="my-1 w-full mx-auto rounded">
        <table class="w-full text-sm rounded text-gray-500" id="mytable" name="mytable" style="border: 1 !important">
            <thead class="text-xs text-gray-700 uppercase bg-white">
                <tr class="text-left">
                    <th scope="col" class="px-6 py-3 ">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Minggu Ke-
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Keterangan
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
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($timeline as $key => $t)
                    <tr class="{{ $key % 2 == 0 ? 'bg-gray-100' : 'bg-gray-50' }} border-b text-left">
                        <td class="px-6 py-4">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $t->mingguke }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $t->keterangan }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $t->kode_cpmk }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $t->kode_subbk }} {{ $t->materi_pembelajaran }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $t->metodepembelajaran }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $t->namalengkap }} {{ $t->gelarbelakang }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $t->jeniskuliah }}
                        </td>
                        <td class="px-6 py-4">
                            <a
                                href="{{ route('timeline.edit', ['id' => $matakuliah->kdmatakuliah, 'kdtimeline' => $t->kdtimeline]) }}">
                                <button
                                    class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1"><i
                                        class="fa-regular fa-pen-to-square"></i></button>
                            </a>
                            <a href="{{ route('timeline.delete', ['id' => $t->kdtimeline]) }}"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data?');">
                                <button
                                    class="bg-red-600 hover:bg-red-800 text-white rounded px-2 text-md font-semibold p-1"><i
                                        class="fa-solid fa-trash"></i></button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
@endsection
