@extends('layouts.app')

@push('style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

<br>

@section('body')
    @include('include.flash-massage')
    <!-- Breadcrumb -->
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

            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Tambah Timeline
                        {{ $matakuliah->kodematakuliah }} {{ $matakuliah->matakuliah }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="text-center py-2">
        <h1 class="font-bold text-2xl mb-0">Edit Timeline Pembelajaran Mingguan</h1>
    </div>

    <div class="my-3 mx-auto max-w-4xl">
        <div class="px-3 bg-white border border-gray-200 rounded shadow-lg justify-between">
            <form class="py-3" action="{{ route('timeline.update', ['id' => $timeline->kdtimeline]) }}" method="POST">
                @csrf
                <div class="grid md:grid-cols-2 md:gap-6 my-2">
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="mingguke" id="mingguke"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " value="{{ $timeline->mingguke }}" />
                        <label for="mingguke"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Minggu
                            ke-</label>
                    </div>
                    <div class="flex flex-col z-0 w-full mb-6 group">
                        <label for="cpmk" class="text-sm text-gray-500">
                            CPMK
                        </label>
                        <select id="kdcpmk" name="kdcpmk" class="form-control">
                            @foreach ($cpmk as $c)
                                <option value="{{ $c->id }}">{{ $c->kode_cpmk }} {{ $c->cpmk }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="flex flex-col z-0 w-full mb-6 group">
                        <label for="materi" class="text-sm text-gray-500">
                            Materi
                        </label>
                        <select id="kdmateri" name="kdmateri" class="form-control">
                            @foreach ($materi as $m)
                                <option value="{{ $m->kdmateri }}" @selected(in_array($m->kdmateri, $id_materi))>{{ $m->kode_subbk }}
                                    {{ $m->materi_pembelajaran }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col z-0 w-full mb-6 group">
                        <label for="metode_pembelajaran" class="text-sm text-gray-500">
                            Metode Pembelajaran
                        </label>
                        <select id="kdmetopem" name="kdmetopem" class="form-control">
                            @foreach ($metopem as $mp)
                                <option value="{{ $mp->id }}" @selected(in_array($mp->id, $id_metopem))>
                                    {{ $mp->metodepembelajaran }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="flex flex-col z-0 w-full mb-6 group">
                        <label for="dosen" class="text-sm text-gray-500">
                            Dosen
                        </label>
                        <select id="kdperson" name="kdperson" class="form-control">
                            @foreach ($dosen as $dos)
                                <option value="{{ $dos->kdperson }}"@selected(in_array($dos->kdperson, $id_dosen))>{{ $dos->gelardepan }}
                                    {{ $dos->namalengkap }}
                                    {{ $dos->gelarbelakang }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col z-0 w-full mb-6 group">
                        <label for="jeniskuliah" class="text-sm text-gray-500">
                            Bentuk Pembelajaran
                        </label>
                        <select id="kdjeniskuliah" name="kdjeniskuliah" class="form-control">
                            @foreach ($jeniskuliah as $jeniskuliahs)
                                <option value="{{ $jeniskuliahs->kdjeniskuliah }}"@selected(in_array($jeniskuliahs->kdjeniskuliah, $id_jeniskuliah))>
                                    {{ $jeniskuliahs->jeniskuliah }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 md:gap-6">

                    <div class=" flex flex-col z-0 w-full mb-6 group">
                        <label for="tahunakademik" class="text-sm text-gray-500">
                            Tahun Akademik
                        </label>
                        <select id="tahunakademik" name="tahunakademik" class="form-control">
                            @foreach ($tahunAkademik as $ta)
                                <option value="{{ $ta->kdtahunakademik }}"@selected(in_array($ta->kdtahunakademik, $id_tahunakademik))>
                                    {{ $ta->tahunakademik }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="keterangan" id="keterangan"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " value="{{ $timeline->keterangan }}" />
                        <label for="keterangan"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Keterangan</label>
                    </div>


                    <input type="text" hidden value="{{ $matakuliah->kdmatakuliah }}" name="kdmatakuliah"
                        id="kdmatakuliah" />

                </div>

                <div class="flex justify-center">
                    <button type="submit"
                        class="flex items-center justify-center mx-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5">
                        <span class="mr-2 font-medium">Submit</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#kdmateri').select2();
            $('#kdcpmk').select2();
            $('#kdjeniskuliah').select2();
            $('#kdperson').select2();
            $('#kdmetopem').select2();
            $('#tahunakademik').select2();
        });
    </script>
@endpush
