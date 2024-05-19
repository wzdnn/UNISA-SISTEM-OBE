@extends('layouts.app')
<br>
@push('style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@section('body')
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
                    <a href="{{ route('detail.mk', ['id' => $id]) }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 ">Detail
                        {{ $mkSubBk->kodematakuliah }} {{ $mkSubBk->matakuliah }}</a>
                </div>
            </li>

            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Detail
                        {{ $subbk->subbk->kode_subbk }} {{ $subbk->subbk->sub_bk }}</span>
                </div>
            </li>

        </ol>
    </nav>

    <div class="w-auto px-3 bg-white border border-gray-200 rounded shadow-sm justify-between mb-3">

        <div class="flex flex-col space-y-2">
            <h1 class="font-bold text-2xl mb-0 text-blue-800">Detail Sub BK Matakuliah</h1>
            <div class="flex flex-row space-x-3 font-bold">
                <p>Sub BK</p>
                <p>:</p>
                <p>{{ $subbk->subbk->kode_subbk }} {{ $subbk->subbk->sub_bk }}</p>
            </div>
        </div>
    </div>
    <div class="w-auto px-3 bg-white border border-gray-200 rounded shadow-sm justify-between mb-3">
        @include('include.flash-massage')
        <div class="my-3 mr-3">
            <button data-modal-target="authentic-modal" id="materiTambah" data-id-target="{{ $subbk->id }}"
                data-modal-toggle="{{ $subbk->id }}"
                class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold" type="button">
                {{-- <i class="fa fa-plus" aria-hidden="true"></i> --}}
                Tambah Materi
            </button>

            <!-- Main modal -->
            <div id="{{ $subbk->id }}" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative px-2 py-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                        <!-- Modal body -->
                        <div class="p-4 md:p-5">

                            <form class="space-y-4" action="{{ route('store.materi') }}" method="POST">
                                @csrf
                                <input type="hidden" name="materi_input_id" id="materi_input_id"
                                    value="{{ $subbk->id }}">
                                <div>
                                    <label for="materi"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">materi</label>
                                    <input type="text" name="materi" id="materi"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                </div>
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

                                <button type="submit"
                                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <h3 class="font-bold text-2xl text-blue-800">Materi Pembelajaran</h3>
            @foreach ($materi as $mp)
                <a href="{{ route('index.materi', ['materi' => $mp->id, 'sub' => $mp->id_gabung]) }}">
                    <div class="hover:text-blue-300 my-2">

                        <p class="font-medium text-lg">
                            {{ $loop->iteration }}. {{ $mp->materi_pembelajaran }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
    <div class="w-auto px-3 bg-white border border-gray-200 rounded shadow-sm justify-between mb-3">

        <div class="py-2">
            <h2 class="font-bold text-2xl  text-blue-800">CPMKS</h2>
            <hr />
            <br />
            <a href="{{ route('subbk.cpmk.kelola', ['id' => $id, 'sub' => $sub]) }}" class="mb-5"><button
                    class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 mb-3">Kelola CPMK
                </button>
            </a>
            <hr />
        </div>
        <div class="">
            @foreach ($subbk->cpmks as $item)
                <a
                    href="{{ route('cpmkPembelajaran.index', ['id' => $subbk->kdmatakuliah, 'sub' => $item->pivot->id_gabung_subbk, 'id_cpmk' => $item->pivot->id]) }}">
                    <div class=" hover:text-blue-300 my-2">
                        <button class=" px-2 text-md font-semibold p-2">
                            &#x2022; {{ $item->kode_cpmk }} {{ $item->cpmk }}
                        </button>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#subbk').select2();
        });

        const materiTambah = document.querySelectorAll("#materiTambah");
        materiTambah.forEach(e => {
            e.addEventListener("click", () => {
                console.log(e.getAttribute('data-id-target'))
                const targetInput = document.getElementById('materi_input_id');
                targetInput.value = e.getAttribute('data-id-target');
            })
        })
    </script>
@endpush
