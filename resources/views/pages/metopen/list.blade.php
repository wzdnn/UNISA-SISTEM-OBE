@extends('layouts.app')

<br />
@section('body')
    <nav class="flex px-5 py-3 bg-white border shadow-md rounded-lg mb-3 mr-3" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ request()->query('redirect_url') ?? route('index.metopen') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                    <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Penilaian
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Detail -
                        {{ $insert->metode_penilaian ?? '' }} | {{ $insert->kode_cpmk ?? '' }} |
                        {{ $insert->matakuliah ?? '' }}
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    {{-- Kop Dibawah Header --}}
    <div class="flex flex-col py-5">
        <h1 class="font-bold text-2xl mb-0 ">{{ $insert->metode_penilaian ?? '' }}</h1>
        <h3 class="font-medium text-xl mb-0 ">{{ $insert->kode_cpmk ?? '' }} | {{ $insert->matakuliah ?? '' }} </h3>
        <h3 class="font-semibold text-xl mb-0">Bobot CPMK : {{ $insert->bobot ?? '' }}%</h3>
    </div>

    {{-- Filter Tahun Akademik --}}
    <div class="flex flex-col">
        <div>

            <form method="GET" class="rounded">
                @csrf
                <select name="filter" id="" class="rounded">
                    <option value="null">Tahun Akademik</option>
                    @foreach ($tahunAkademik as $item)
                        <option value="{{ $item->kdtahunakademik }}" @selected(request()->filter == $item->kdtahunakademik)>{{ $item->tahunakademik }}
                        </option>
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

        <div>
            <!-- Modal toggle -->
            <button data-modal-target="authentic-modal" id="tgsTambah" data-id-target="{{ $insert->gmcid ?? '' }}"
                data-modal-toggle="{{ $insert->gmcid ?? '' }}"
                class="text-white items-center justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                type="button">
                Tambah Keterangan
            </button>

            <!-- Main modal -->
            <div id="{{ $insert->gmcid ?? '' }}" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            <h1 class="font-bold text-2xl mb-0 ">
                                {{ $insert->metode_penilaian ?? '' }} </h1>
                            <h3 class="font-medium text-xl mb-0 text-gray-500">
                                {{ $insert->kode_cpmk ?? '' }} </h3>
                            <h3 class="font-semibold text-md text-justify">{{ $insert->cpmk ?? '' }}
                            </h3>
                            <h3 class="font-semibold text-l mb-0">Bobot CPMK :
                                {{ $insert->bobot ?? '' }}%

                            </h3>

                            <form class="space-y-4" action="{{ route('tugas.keterangan') }}" method="POST">
                                @csrf
                                <input type="hidden" name="tgsinput_id" id="tgsinput_id"
                                    value="{{ $insert->gmcid ?? '' }}">
                                {{-- <input type="hidden" name="kdmatakuliah" id="kdmatakuliah"
                                value="{{ $value->kdmatakuliah }}"> --}}

                                <div>
                                    <label for="keterangan"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                                    <input type="text" name="keterangan" id="keterangan"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                </div>

                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div>
                                        <label for="keterangan"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun
                                            Akademik</label>
                                        <select id="tahunakademik" name="tahunakademik" class="form-control">
                                            @foreach ($tahunAkademik as $tahunakademik)
                                                <option value="{{ $tahunakademik->kdtahunakademik }}">
                                                    {{ $tahunakademik->tahunakademik }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex flex-col z-0 w-full mb-6 group">
                                        <label for="idjenisprogram"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Jenis Program
                                        </label>
                                        <select id="idjenisprogram" name="idjenisprogram" class="form-control">
                                            @foreach ($jenisProgram as $jp)
                                                <option value="{{ $jp->kdjenisprogram }}">
                                                    {{ $jp->jenisprogram }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <label for="idlensa"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Id
                                            Lensa</label>
                                        <input type="text" name="idlensa" id="idlensa"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    </div>
                                    <div class="flex flex-col z-0 w-full mb-6 group">
                                        <label for="idtipelensa"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Tipe Tugas
                                        </label>
                                        <select id="idtipelensa" name="idtipelensa" class="form-control">
                                            @foreach ($tipeLensa as $tl)
                                                <option value="{{ $tl->id }}">
                                                    {{ $tl->tipelensa }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="grid md:grid-cols-2 md:gap-6">


                                </div>

                                <button type="submit"
                                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <p class="text-red-600 flex py-2 ml-3 mb-2 font-bold text-xl">*Apabila ingin mengubah nilai, tidak perlu menghapus
            list
            dan
            mengulang,
            tetapi
            hanya
            perlu menginput datanya kembali</p>
    </div>

    {{-- Isian Tabel Tahun Akademik --}}
    <table class="w-full text-sm text-center  text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr class="text-left">
                <th scope="col" class="px-6 py-3 w-[50px]">
                    No.
                </th>
                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                    Keterangan
                </th>
                <th scope="col" class="px-6 py-3">
                    Tahun Akademik
                </th>
                <th scope="col" class="px-6 py-3">
                    Id Lensa
                </th>
                <th scope="col" class="px-6 py-3">
                    Tipe Lensa
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listNilai as $key => $value)
                <tr class="bg-white border-b text-left shadow hover:bg-gray-100">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ ($listNilai->currentPage() - 1) * $listNilai->perPage() + $key + 1 }}
                    </td>
                    <td class="px-6 py-4 ">

                        {{ $value->keterangan }}

                    </td>
                    <td class="px-6 py-4">
                        {{ $value->tahunakademik }}
                    </td>
                    <td class="px-6 py-4">

                        <a href="{{ $value->url }}{{ $value->idlensa }}" target="blank_">

                            {{ $value->idlensa }}
                        </a>

                    </td>
                    <td class="px-6 py-4">
                        {{ $value->tipelensa }}
                    </td>

                    <td class="flex space-x-1 px-6 py-4">
                        @if ($value->idjenisprogram == 1)
                            <button data-modal-target="popup-modal-reguler" id="btnTambah"
                                data-modal-toggle="popup-modal-reguler"
                                class="text-white items-center justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                data-id-target="{{ $value->kjn }}" type="button">
                                Isi Mahasiswa Reguler
                                {{-- <i class="fa fa-plus" aria-hidden="true"></i> --}}
                                {{-- Isi Penilaian --}}
                            </button>

                            {{-- Model Start --}}
                            {{-- @include('include.flash-massage') --}}
                            <div>
                                <div id="popup-modal-reguler" tabindex="-1"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-auto max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow ">
                                            <button type="button"
                                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                                                data-modal-hide="popup-modal-reguler">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-4">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg dark:bg-gray-700">
                                                    <h1 class="font-bold text-2xl mb-0">Isi Mahasiswa</h1>
                                                    <h3 class="font-medium text-l mb-0 mt-3">Silahkan pilih kelas dan tahun
                                                        akademik
                                                        untuk mengisi mahasiswa kedalam {{ $value->keterangan }}</h3>
                                                    <!-- Modal body -->
                                                    <form action="{{ route('copy.mhs', ['id' => $value->kjn]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="flex flex-col py-2">
                                                            <input name="kdmatakuliah_" id="kdmatakuliah_"
                                                                value="{{ $value->mkd }}">
                                                            <input name="kdjenisnilai_" id="kdjenisnilai_"
                                                                value="{{ $value->kjn }}">
                                                        </div>
                                                        <div class="flex flex-col z-0 w-full mb-6 group">
                                                            <label for="unit" class="text-sm text-gray-500">
                                                                Kelas
                                                            </label>

                                                            <select id="kelas_" name="kelas_" data-live-search="true"
                                                                class="form-control rounded">
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="K">K</option>
                                                            </select>
                                                        </div>
                                                        <div class="flex flex-col z-0 w-full mb-6 group">
                                                            <label for="unit" class="text-sm text-gray-500">
                                                                Tahun Akademik
                                                            </label>
                                                            <select id="kdtahunakademik_" name="kdtahunakademik_"
                                                                class="form-control rounded">
                                                                @foreach ($tahunAkademik as $tahunakademik)
                                                                    <option value="{{ $tahunakademik->kdtahunakademik }}">
                                                                        {{ $tahunakademik->tahunakademik }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <button data-modal-hide="popup-modal-reguler" type="submit"
                                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-2 py-2 text-center">
                                                            Submit
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif ($value->idjenisprogram == 2)
                            <button data-modal-target="popup-modal-mbkm" id="btnTambahMbkm"
                                data-modal-toggle="popup-modal-mbkm"
                                class="text-white items-center justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                data-id-target="{{ $value->kjn }}" type="button">
                                Isi Mahasiswa MBKM
                            </button>

                            {{-- Model Start --}}
                            <div>
                                <div id="popup-modal-mbkm" tabindex="-1"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-auto max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow ">
                                            <button type="button"
                                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                                                data-modal-hide="popup-modal-mbkm">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-4">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg dark:bg-gray-700">
                                                    <h1 class="font-bold text-2xl mb-0">Isi Mahasiswa</h1>
                                                    <h3 class="font-medium text-l mb-0 mt-3">Silahkan pilih kelas dan
                                                        tahun
                                                        akademik
                                                        untuk mengisi mahasiswa kedalam {{ $value->keterangan }}</h3>
                                                    <!-- Modal body -->
                                                    <form action="{{ route('copy.mhs.mbkm', ['id' => $value->kjn]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="flex flex-col py-2">
                                                            <input name="kdmatakuliah_" id="kdmatakuliah_"
                                                                value="{{ $value->mkd }}">
                                                            <input name="kdjenisnilai_Mbkm" id="kdjenisnilai_Mbkm"
                                                                value="{{ $value->kjn }}">
                                                        </div>
                                                        <div class="flex flex-col z-0 w-full mb-6 group">
                                                            <label for="unit" class="text-sm text-gray-500">
                                                                Tahun Akademik
                                                            </label>
                                                            <select id="kdtahunakademik_" name="kdtahunakademik_"
                                                                class="form-control rounded">
                                                                @foreach ($tahunAkademik as $tahunakademik)
                                                                    <option value="{{ $tahunakademik->kdtahunakademik }}">
                                                                        {{ $tahunakademik->tahunakademik }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <button data-modal-hide="popup-modal-mbkm" type="submit"
                                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-2 py-2 text-center">
                                                            Submit
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (!($value->idlensa == 0))
                            <button data-modal-target="ambilNilai-modal" id="btnTambah"
                                data-modal-toggle="ambilNilai-modal"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                data-id-target="{{ $value->kjn }}" type="button">
                                Ambil Nilai Dari Lensa
                            </button>
                            <div>
                                <div id="ambilNilai-modal" tabindex="-1"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-auto max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow ">
                                            <button type="button"
                                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                                                data-modal-hide="ambilNilai-modal">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-4">
                                                <div class="relative bg-white rounded-lg dark:bg-gray-700">
                                                    <form action="{{ route('ambil.nilai', ['id' => $value->kjn]) }}"
                                                        method="POST">
                                                        @csrf

                                                        <h1 class="font-bold text-center text-2xl mb-0">Anda Yakin
                                                            Ingin
                                                            Mengambil
                                                            Nilai Dari Lensa?</h1>
                                                        <button data-modal-hide="ambilNilai-modal" type="submit"
                                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-2 py-2 text-center">
                                                            Submit
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($value->idjenisprogram == 1)
                            <a
                                href="{{ route('index.penilaian', ['id' => $value->kjn, 'kdtahunakademik' => $value->kdtahunakademik]) }}">
                                <button id="btnDetail"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                    type="button">
                                    {{-- <i class="fa fa-book" aria-hidden="true"></i> --}}
                                    Detail Reguler
                                </button>
                            </a>
                        @elseif ($value->idjenisprogram == 2)
                            <a
                                href="{{ route('index.penilaian.mbkm', ['id' => $value->kjn, 'kdtahunakademik' => $value->kdtahunakademik]) }}">
                                <button id="btnDetail"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                    type="button">
                                    {{-- <i class="fa fa-book" aria-hidden="true"></i> --}}
                                    Detail MBKM
                                </button>
                            </a>
                        @endif



                        <a href="{{ route('list.delete', ['kdjenisnilai' => $value->kjn]) }}"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data? list data yang sudah dihapus akan menghapus data nilai yang sudah diinputkan juga');">
                            <button
                                class="bg-red-600 hover:bg-red-800 text-white font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2"><i
                                    class="fa-solid fa-trash"></i></button>
                        </a>

                        <button data-modal-target="edit-modal" id="btnEdit" data-modal-toggle="edit-modal"
                            data-kjn="{{ $value->kjn }}" data-keterangan="{{ $value->keterangan }}"
                            data-idlensa="{{ $value->idlensa }}" data-tahunakademik="{{ $value->kdtahunakademik }}"
                            data-idtipelensa="{{ $value->idtipelensa }}"
                            data-idjenisprogram="{{ $value->idjenisprogram }}"
                            class="text-white items-center justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            data-id-target="{{ $value->kjn }}" type="button">
                            Edit
                        </button>

                        <div>
                            <div id="edit-modal" tabindex="-1"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-auto max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow ">
                                        <button type="button"
                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                                            data-modal-hide="edit-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-4">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg dark:bg-gray-700">
                                                <h1 class="font-bold text-2xl mb-4">Edit</h1>
                                                <!-- Modal body -->
                                                <form action="{{ route('update.list', ['id' => $value->kjn]) }}"
                                                    method="POST">
                                                    @csrf

                                                    <div class="flex flex-col py-2">
                                                        <input name="kdjenisnilai_edit" id="kdjenisnilai_edit"
                                                            value="{{ $value->kjn }}">
                                                    </div>

                                                    <div class="grid md:grid-cols-2 md:gap-6">
                                                        <div class="col-span-2 mb-2">
                                                            <label for="keterangan"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                                                            <input type="text" name="keterangan" id="keterangan"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                placeholder="" value="{{ $value->keterangan }}">
                                                        </div>
                                                        <div class="col-span-2 mb-2">
                                                            <label for="tahunakademik"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun
                                                                Akademik</label>
                                                            <select id="tahunakademik" name="tahunakademik"
                                                                class="form-control">
                                                                @foreach ($tahunAkademik as $ta)
                                                                    <option value="{{ $ta->kdtahunakademik }}">
                                                                        {{ $ta->tahunakademik }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="grid md:grid-cols-2 md:gap-6">
                                                        <div class="relative z-0 w-full mb-6 group">
                                                            <label for="idlensa"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Id
                                                                Lensa</label>
                                                            <input type="text" name="idlensa" id="idlensa"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                                                value="{{ $value->idlensa ?? '' }}">
                                                        </div>
                                                        <div class="flex flex-col z-0 w-full mb-6 group">
                                                            <label for="idtipelensa" class="text-sm text-gray-500">
                                                                Tipe Tugas
                                                            </label>
                                                            <select id="idtipelensa" name="idtipelensa"
                                                                class="form-control">
                                                                @foreach ($tipeLensa as $tl)
                                                                    <option value="{{ $tl->id }}">
                                                                        {{ $tl->tipelensa }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="grid md:grid-cols-2 md:gap-6">

                                                        <div class="flex flex-col z-0 w-full mb-6 group">
                                                            <label for="idjenisprogram"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                                Jenis Program
                                                            </label>
                                                            <select id="idjenisprogram" name="idjenisprogram"
                                                                class="form-control">
                                                                @foreach ($jenisProgram as $jp)
                                                                    <option value="{{ $jp->kdjenisprogram }}">
                                                                        {{ $jp->jenisprogram }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <button data-modal-hide="edit-modal" type="submit"
                                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-2 py-2 text-center">
                                                        Submit
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>


                </tr>
            @endforeach

        </tbody>
    </table>
@endsection

@push('script')
    <script>
        const btnTambah = document.querySelectorAll("#btnTambah");
        btnTambah.forEach(e => {
            e.addEventListener("click", () => {
                console.log(e.getAttribute('data-id-target'));
                const inputTarget = document.getElementById('kdjenisnilai_');
                inputTarget.value = e.getAttribute('data-id-target');
            })
        });

        const btnTambahMbkm = document.querySelectorAll("#btnTambahMbkm");
        btnTambahMbkm.forEach(e => {
            e.addEventListener("click", () => {
                console.log(e.getAttribute('data-id-target'));
                const inputTarget = document.getElementById('kdjenisnilai_Mbkm');
                inputTarget.value = e.getAttribute('data-id-target');
            })
        });

        const tgsTambah = document.querySelectorAll("#tgsTambah");
        tgsTambah.forEach(e => {
            e.addEventListener("click", () => {
                console.log(e.getAttribute('data-id-target'))
                const targetInput = document.getElementById('tgsinput_id');
                targetInput.value = e.getAttribute('data-id-target');
            })
        })

        const btnEdit = document.querySelectorAll("#btnEdit");
        btnEdit.forEach(e => {
            e.addEventListener("click", () => {
                console.log(e.getAttribute('data-id-target'));
                const inputTarget = document.getElementById('kdjenisnilai_edit');
                inputTarget.value = e.getAttribute('data-id-target');
            })
        });

        document.addEventListener('DOMContentLoaded', function() {
            var editButtons = document.querySelectorAll('#btnEdit');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Ambil data dari tombol yang di klik
                    var kjnValue = button.getAttribute('data-kjn');
                    var keteranganValue = button.getAttribute('data-keterangan');
                    var idlensaValue = button.getAttribute('data-idlensa');
                    var tahunakademikValue = button.getAttribute('data-tahunakademik');
                    var idtipelensaValue = button.getAttribute('data-idtipelensa');
                    var idjenisprogramValue = button.getAttribute('data-idjenisprogram');

                    // Set nilai input di modal
                    document.getElementById('kdjenisnilai_edit').value = kjnValue;
                    document.getElementById('keterangan').value = keteranganValue;
                    document.getElementById('idlensa').value = idlensaValue;

                    // Set nilai select di modal
                    document.getElementById('tahunakademik').value = tahunakademikValue;
                    document.getElementById('idtipelensa').value = idtipelensaValue;
                    document.getElementById('idjenisprogram').value = idjenisprogramValue;

                    // Debugging: Pastikan nilai benar-benar diatur
                    console.log("Tahun Akademik:", tahunakademikValue);
                    console.log("Tipe Lensa:", idtipelensaValue);
                    console.log("Jenis Program:", idjenisprogramValue);
                });
            });
        });
    </script>
@endpush
