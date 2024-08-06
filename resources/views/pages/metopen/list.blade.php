@extends('layouts.app')

<br />
@section('body')
    <nav class="flex px-5 py-3 bg-white border shadow-md rounded-lg mb-3 mr-3" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('index.metopen') }}"
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
                        {{ $list->metode_penilaian ?? '' }} | {{ $list->kode_cpmk ?? '' }} | {{ $list->matakuliah ?? '' }}
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    {{-- Kop Dibawah Header --}}
    <div class="flex flex-col py-5">
        <h1 class="font-bold text-2xl mb-0 ">{{ $list->metode_penilaian }}</h1>
        <h3 class="font-medium text-xl mb-0 ">{{ $list->kode_cpmk }} | {{ $list->matakuliah }} </h3>
        <h3 class="font-semibold text-xl mb-0">Bobot CPMK : {{ $list->bobot }}%</h3>
    </div>

    {{-- Filter Tahun Akademik --}}
    <div class="flex flex-col">
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
                <th scope="col" class="px-6 py-3 ">
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
                        <button data-modal-target="popup-modal" id="btnTambah" data-modal-toggle="popup-modal"
                            class="text-white items-center justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            data-id-target="{{ $value->kjn }}" type="button">
                            Isi Mahasiswa
                            {{-- <i class="fa fa-plus" aria-hidden="true"></i> --}}
                            {{-- Isi Penilaian --}}
                        </button>

                        {{-- Model Start --}}
                        {{-- @include('include.flash-massage') --}}
                        <div>
                            <div id="popup-modal" tabindex="-1"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-auto max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow ">
                                        <button type="button"
                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                                            data-modal-hide="popup-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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
                                                        <input type="hidden" name="kdmatakuliah_" id="kdmatakuliah_"
                                                            value="{{ $value->mkd }}">
                                                        <input type="hidden" name="kdjenisnilai_" id="kdjenisnilai_"
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

                                                    <button data-modal-hide="popup-modal" type="submit"
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

                                                        <h1 class="font-bold text-center text-2xl mb-0">Anda Yakin Ingin
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

                        <a
                            href="{{ route('index.penilaian', ['id' => $value->kjn, 'kdtahunakademik' => $value->kdtahunakademik]) }}">
                            <button id="btnDetail"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                type="button">
                                {{-- <i class="fa fa-book" aria-hidden="true"></i> --}}
                                Detail
                            </button>
                        </a>


                        <a href="{{ route('list.delete', ['kdjenisnilai' => $value->kjn]) }}"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data? list data yang sudah dihapus akan menghapus data nilai yang sudah diinputkan juga');">
                            <button
                                class="bg-red-600 hover:bg-red-800 text-white font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2"><i
                                    class="fa-solid fa-trash"></i></button>
                        </a>

                        <button data-modal-target="edit-modal" id="btnTambah" data-modal-toggle="edit-modal"
                            class="text-white items-center justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            data-id-target="{{ $value->kjn }}" type="button">
                            Edit
                            {{-- <i class="fa fa-plus" aria-hidden="true"></i> --}}
                            {{-- Isi Penilaian --}}
                        </button>

                        {{-- Model Start --}}
                        {{-- @include('include.flash-massage') --}}
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
                                                <h1 class="font-bold text-2xl mb-0 mb-4">Edit</h1>
                                                <!-- Modal body -->
                                                <form action="{{ route('update.list', ['id' => $value->kjn]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="flex flex-col py-2">
                                                        <input type="hidden" name="kdjenisnilai" id="kdjenisnilai_">
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
                                                                        {{ $ta->tahunakademik }}
                                                                    </option>
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
    </script>
@endpush
