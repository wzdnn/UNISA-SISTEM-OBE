@extends('layouts.app')

@push('style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@section('body')
    @include('include.flash-massage')
    <!-- Breadcrumb -->
    <nav class="flex px-5 py-3 bg-white border shadow-md rounded-lg mb-3" aria-label="Breadcrumb">
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
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Detail
                        {{ $mkSubBk->kodematakuliah }} {{ $mkSubBk->matakuliah }}</span>
                </div>
            </li>
        </ol>
    </nav>




    <div class="flex items-center">
        <h1 class="font-bold text-2xl mb-0 text-blue-800">Detail Matakuliah</h1>
    </div>

    <div class="my-3">
        {{-- <h2 class="text-lg">Kode : {{ $mkSubBk->kdmatakuliah }}</h2>
    <h2 class="text-lg">Mata Kuliah : {{ $mkSubBk->matakuliah }}</h2> --}}
        <form action="{{ route('post.detail.mk', ['id' => $mkSubBk->kdmatakuliah]) }}" method="post">
            @csrf
            <table class="w-[40vh] text-sm  text-gray-500 ">
                <thead class="text-lg text-gray-700 uppercase">
                    <tr class="text-left">
                        <th scope="col">
                            Kode
                        </th>
                        <th scope="col">
                            :
                        </th>
                        <th scope="col">
                            <input type="text" name="kodematakuliah" id="kodematakuliah"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ old('kodematakuliah') ?? $mkSubBk->kodematakuliah }}" />
                            <label for="kodematakuliah"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Kode
                                Matakuliah</label>
                        </th>
                    </tr>
                    <tr class="text-left">
                        <th>
                            Matakuliah
                        </th>
                        <th class="">
                            :
                        </th>
                        <th>
                            <input type="text" name="matakuliah" id="matakuliah"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ old('matakuliah') ?? $mkSubBk->matakuliah }}" />
                            <label for="matakuliah"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Matakuliah</label>
                        </th>
                    </tr>
                    <tr class="text-left">
                        <th>
                            MK Singkat
                        </th>
                        <th class="">
                            :
                        </th>
                        <th class="ml-3">
                            <input type="text" name="mk_singkat" id="mk_singkat"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ old('mk_singkat') ?? $mkSubBk->mk_singkat }}" />
                            <label for="mk_singkat"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">MK
                                Singkat</label>
                        </th>

                    </tr>
                    <tr class="text-left">
                        <th>
                            SKS
                        </th>
                        <th class="">
                            :
                        </th>
                        <th class="ml-3">
                            <input type="text" name="sks" id="sks"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ old('sks') ?? $mkSubBk->sks }}" />
                            <label for=""
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">SKS</label>
                        </th>
                        {{-- <th class="text-xs px-3">
                            Rekomendasi SKS
                        </th>
                        <th class="">
                            :
                        </th>
                        <th class="ml-3">

                            <input type="text"
                                class="block py-2.5 px-2  text-sm text-gray-900 bg-transparent  border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " disabled value="{{ $rekomendasiSKS->rekomendasi_sks ?? '' }}" />
                        </th> --}}
                    </tr>
                </thead>
            </table>
            <div class="my-3">
                <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-2"
                    type="submit">UPDATE</button>
            </div>
        </form>

        <br />
        <hr />
    </div>

    <div>
        <a href="{{ route('mk.subbk', ['id' => $mkSubBk->kdmatakuliah]) }}"><button
                class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 mb-3">Kelola Sub
                Bahan
                Kajian
            </button>
        </a>
        <hr />
        <br />
        <div class="my-3">
            <h2 class="font-bold text-2xl mb-0 text-blue-800">Sub BK</h2>

        </div>

        <table class="w-screen text-sm  text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase">
                <tr>
                    <th scope="col" class="text-left">

                        @foreach ($mkSubBk->MKtoSub_bk as $item)
                            <a
                                href="{{ route('subbk.cpmk', ['id' => $mkSubBk->kdmatakuliah, 'sub' => $item->pivot->id]) }}">
                                <div class="p-3 hover:text-blue-300">
                                    <button
                                        class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-2">
                                        &#x2022; {{ $item->kode_subbk }} {{ $item->sub_bk }}
                                    </button>
                                </div>
                            </a>
                        @endforeach
                    </th>
                </tr>
            </thead>
        </table>
    </div>

    {{-- <h2 class="text-lg font-medium my-8">Sub BK</h2> --}}
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#subbk').select2();
        });
    </script>
@endpush
