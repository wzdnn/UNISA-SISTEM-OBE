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

    <div class="flex flex-col space-y-2">
        <h1 class="font-bold text-2xl mb-0 text-blue-800">Detail Sub BK Matakuliah</h1>
        <div class="flex flex-row space-x-3 font-bold">
            <p>Sub BK</p>
            <p>:</p>
            <p>{{ $subbk->subbk->kode_subbk }} {{ $subbk->subbk->sub_bk }}</p>
        </div>
    </div>

    <br />
    <hr />

    <div class="py-2">
        @include('include.flash-massage')
        <div class="my-3 mr-3">
            <div class="w-auto px-3 bg-white border border-gray-200 rounded shadow-lg justify-between">
                <form action="" method="post" class="mb-5">
                    @csrf
                    <table class="w-screen text-sm  text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase">
                        </thead>
                    </table>
                    <div class="py-3">
                        <div class="relative z-0  mb-6 group">
                            <input type="text" name="pokok_bahasan" id="pokok_bahasan"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ old('pokok_bahasan') ?? $subbk->pokok_bahasan }}" />
                            <label for="pokok_bahasan"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Pokok
                                Bahasan</label>
                        </div>
                        <div class="relative z-0  mb-6 group">
                            <input type="number" name="kuliah" id="kuliah"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ old('kuliah') ?? $subbk->kuliah }}" />
                            <label for="kuliah"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Kuliah(jam)</label>
                        </div>
                        <div class="relative z-0  mb-6 group">
                            <input type="number" name="tutorial" id="tutorial"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ old('tutorial') ?? $subbk->tutorial }}" />
                            <label for="tutorial"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tutorial(jam)</label>
                        </div>
                        <div class="relative z-0  mb-6 group">
                            <input type="number" name="seminar" id="seminar"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ old('seminar') ?? $subbk->seminar }}" />
                            <label for="seminar"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Seminar(jam)</label>
                        </div>
                        <div class="relative z-0  mb-6 group">
                            <input type="text" name="praktikum" id="praktikum"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ old('praktikum') ?? $subbk->praktikum }}" />
                            <label for="praktikum"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Praktikum(jam)</label>
                        </div>
                        <div class="relative z-0  mb-6 group">
                            <input type="text" name="skill_lab" id="skill_lab"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ old('skill_lab') ?? $subbk->skill_lab }}" />
                            <label for="skill_lab"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Skill
                                Lab(jam)</label>
                        </div>
                        <div class="relative z-0  mb-6 group">
                            <input type="text" name="field_lab" id="field_lab"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ old('field_lab') ?? $subbk->field_lab }}" />
                            <label for="field_lab"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Field
                                Lab(jam)</label>
                        </div>
                        <div class="relative z-0  mb-6 group">
                            <input type="text" name="praktik" id="praktik"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ old('praktik') ?? $subbk->praktik }}" />
                            <label for="praktik"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Praktik(jam)</label>
                        </div>
                    </div>

                    <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-2"
                        type="submit">UPDATE</button>
                </form>
            </div>
        </div>
    </div>
    <div class="">
        <h2 class="font-bold text-2xl  text-blue-800">CPMKS</h2>
        <hr />
        <br />
        <a href="{{ route('subbk.cpmk.kelola', ['id' => $id, 'sub' => $sub]) }}" class="mb-5"><button
                class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 mb-3">Kelola CPMK
            </button>
        </a>
        <hr />

        <br />
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
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#subbk').select2();
        });
    </script>
@endpush
