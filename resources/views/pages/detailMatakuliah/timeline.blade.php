@extends('layouts.app')

@push('style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

<br>

@section('body')
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
                                href="{{ route('timeline.edit', ['id' => $t->kdmatakuliah, 'kdtimeline' => $t->kdtimeline]) }}">
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
