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
                <a href="{{ route('sp.index') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                    <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Struktur Program
                </a>
            </li>

            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Tambah Struktur
                        Program</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="text-center py-2">
        <h1 class="font-bold text-2xl mb-0">Tambah Struktur Program</h1>
    </div>

    <div class="my-3 mx-auto max-w-4xl">
        <div class="px-3 bg-white border border-gray-200 rounded shadow-lg justify-between">
            <form class="py-3" action="{{ route('sp.store') }}" method="POST">
                @csrf
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="flex flex-col z-0 w-full mb-6 group">
                        <label for="matakuliah" class="text-sm text-gray-500">
                            Matakuliah
                        </label>
                        <select id="kdmatakuliah" name="kdmatakuliah" class="form-control">
                            @foreach ($matakuliah as $mk)
                                <option value="{{ $mk->kdmatakuliah }}">
                                    {{ $mk->kodematakuliah }} - {{ $mk->matakuliah }} - {{ $mk->sks }} SKS</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="flex flex-col z-0 w-full mb-6 group">
                        <label for="dosen1" class="text-sm text-gray-500">
                            Dosen Utama
                        </label>
                        <select id="dosen1" name="dosen1" class="form-control">
                            @foreach ($dosen1 as $dos1)
                                <option value="{{ $dos1->kdperson }}"> {{ $dos1->namalengkap }} {{ $dos1->gelarbelakang }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col z-0 w-full mb-6 group">
                        <label for="dosen2" class="text-sm text-gray-500">
                            Dosen Pelaporan PDDIKTI
                        </label>
                        <select id="dosen2" name="dosen2" class="form-control">
                            @foreach ($dosen2 as $dos1)
                                <option value="{{ $dos1->kdperson }}"> {{ $dos1->namalengkap }} {{ $dos1->gelarbelakang }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="keterangan" id="keterangan"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " value="{{ old('keterangan') }}" />
                        <label for="keterangan"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Keterangan</label>
                    </div>
                </div>

                {{-- break section 1 --}}
                <hr />

                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0   mb-6 group">
                        <input type="number" name="teori" id="teori"
                            class="block py-2.5 px-0   text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " value="" />
                        <label for="teori"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Teori(KT)</label>
                    </div>
                    <div class="relative z-0  mb-6 group">
                        <input type="number" name="pertemuan_kt" id="pertemuan_kt"
                            class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " value="" />
                        <label for="pertemuan_kt"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Jumlah
                            Pertemuan</label>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">

                    <div class="relative z-0  mb-6 group">
                        <input type="number" name="tutorial" id="tutorial"
                            class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " value="" />
                        <label for="tutorial"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tutorial(KP/T)</label>
                    </div>
                    <div class="relative z-0  mb-6 group">
                        <input type="number" name="pertemuan_kp" id="pertemuan_kp"
                            class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " value="" />
                        <label for="pertemuan_kp"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Jumlah
                            Pertemuan</label>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0  mb-6 group">
                        <input type="number" name="seminar" id="seminar"
                            class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " value="" />
                        <label for="seminar"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Seminar(S)</label>
                    </div>
                    <div class="relative z-0  mb-6 group">
                        <input type="number" name="pertemuan_s" id="pertemuan_s"
                            class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " value="" />
                        <label for="pertemuan_s"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Jumlah
                            Pertemuan</label>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">

                    <div class="relative z-0  mb-6 group">
                        <input type="number" name="praktikum" id="praktikum"
                            class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " value="" />
                        <label for="praktikum"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Praktikum(P)</label>
                    </div>
                    <div class="relative z-0  mb-6 group">
                        <input type="number" name="pertemuan_p" id="pertemuan_p"
                            class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " value="" />
                        <label for="pertemuan_p"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Jumlah
                            Pertemuan</label>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0  mb-6 group">
                        <input type="number" name="praktik" id="praktik"
                            class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " value="" />
                        <label for="praktik"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Praktik(Pr)</label>
                    </div>
                    <div class="relative z-0  mb-6 group">
                        <input type="number" name="pertemuan_pr" id="pertemuan_pr"
                            class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " value="" />
                        <label for="pertemuan_pr"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Jumlah
                            Pertemuan</label>
                    </div>
                </div>

                <hr />
                <br />

                {{-- Break section 2 --}}

                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="flex flex-col z-0 w-full mb-6 group">
                        <label for="tahunakademik" class="text-sm text-gray-500">
                            Tahun Akademik
                        </label>
                        <select id="tahunakademik" name="tahunakademik" class="form-control">
                            @foreach ($tahunAkademik as $ta)
                                <option value="{{ $ta->kdtahunakademik }}"> {{ $ta->tahunakademik }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="hidden flex-col z-0 w-full mb-6 group">
                        <label for="kurikulum" class="text-sm text-gray-500">
                            Kurikulum
                        </label>
                        <select id="kurikulum" name="kurikulum" class="form-control ">
                            @foreach ($kurikulum as $k)
                                <option value="{{ $k->kdkurikulum }}"> {{ $k->kurikulum }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr />
                <div class="flex justify-center pt-2">
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
            $('#kdmatakuliah').select2();
            $('#dosen1').select2();
            $('#dosen2').select2();
            $('#tahunakademik').select2();
            $('#kurikulum').select2();
        });
    </script>
@endpush
