@extends('layouts.app')
<br>
@push('style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@section('body')
    <div class="py-2">
        @include('include.flash-massage')
        <div class="my-3 mr-3">
            <div class="w-auto px-3 bg-white border border-gray-200 rounded shadow-sm justify-between mb-3">

                <div class="flex flex-col space-y-2 py-2 mb-2">
                    <h1 class="font-bold text-2xl mb-0 text-blue-800">Detail Materi Sub BK</h1>
                    <div class="flex flex-row space-x-3 font-bold">
                        <p>Sub BK</p>
                        <p>:</p>
                        <p>{{ $detail->subbk->kode_subbk }} {{ $detail->subbk->sub_bk }}</p>
                    </div>
                </div>
            </div>

            <div class="w-auto px-3 bg-white border border-gray-200 rounded shadow-lg justify-between">
                <form action="" method="post" class="mb-5">
                    @csrf
                    <table class="w-screen text-sm  text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase">
                        </thead>
                    </table>

                    <div class="py-3 mt-4">
                        <div class="relative z-0  mb-6 group">
                            <input type="text" name="materi_pembelajaran" id="materi_pembelajaran"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ old('materi_pembelajaran') ?? $subbk->materi_pembelajaran }}" />
                            <label for="materi_pembelajaran"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Materi
                                Pembelajaran</label>
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
                        <div class="relative z-0  mb-6 group">
                            <input type="text" name="penugasan" id="penugasan"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ old('penugasan') ?? $subbk->penugasan }}" />
                            <label for="penugasan"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Penugasan(jam)</label>
                        </div>
                        <div class="relative z-0  mb-6 group">
                            <input type="text" name="belajar_mandiri" id="belajar_mandiri"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ old('belajar_mandiri') ?? $subbk->belajar_mandiri }}" />
                            <label for="belajar_mandiri"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Belajar
                                Mandiri(jam)</label>
                        </div>
                    </div>

                    <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-2"
                        type="submit">UPDATE</button>
                </form>
            </div>
        </div>
    </div>
@endsection
