@extends('layouts.app')
<br>
@push('style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

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


    <br>
    <div class="text-center">
        <h1 class="font-bold text-2xl mb-0 text-dark-700">Detail Matakuliah</h1>
    </div>

    <div class="my-3 mx-auto max-w-4xl">
        <div class=" px-3 bg-white border border-gray-200 rounded-lg shadow-lg justify-between">
            <form action="{{ route('post.detail.mk', ['id' => $mkSubBk->kdmatakuliah]) }}" method="post">
                @csrf
                <div class="grid md:grid-cols-2">
                    <div class="relative z-0 px-3 py-3">
                        <label for="kodematakuliah" class="block mb-2 text-sm font-bold text-gray-900 uppercase">Kode
                            Matakuliah</label>
                        <input type="text" name="kodematakuliah" id="kodematakuliah"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-auto p-2.5 "
                            placeholder=" " value="{{ old('kodematakuliah') ?? $mkSubBk->kodematakuliah }}">
                    </div>
                    <div class="relative z-0 px-3 py-3">
                        <label for="matakuliah"
                            class="block mb-2 text-sm font-bold text-gray-900 uppercase">Matakuliah</label>
                        <input type="text" name="matakuliah" id="matakuliah"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            placeholder=" " value="{{ old('matakuliah') ?? $mkSubBk->matakuliah }}">
                    </div>
                </div>
                <hr />
                <div class="grid md:grid-cols-2">
                    <div class="relative z-0 px-3 py-3">
                        <label for="sks" class="block mb-2 text-sm font-bold text-gray-900 uppercase">SKS</label>
                        <input type="text" name="sks" id="sks"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-auto p-2.5 "
                            placeholder=" " value="{{ old('sks') ?? $mkSubBk->sks }}">
                    </div>
                    <div class="relative z-0 px-3 py-3">
                        <label for="rekomendasiSKS" class="block mb-2 text-sm font-bold text-gray-900 uppercase">Rekomendasi
                            SKS</label>
                        <input type="text"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-auto p-2.5 "
                            placeholder=" " disabled value="{{ $rekomendasiSKS[0]->rekomendasisksjam ?? '' }}">
                    </div>
                </div>
                <hr />
                <div class="grid md:grid-cols-2">
                    <div class="relative z-0 px-3 py-3">
                        <label for="akses_media" class="block mb-2 text-sm font-bold text-gray-900 uppercase">Akses
                            Media</label>
                        <input type="text" name="akses_media" id="akses_media"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            placeholder=" " value="{{ old('akses_media') ?? $mkSubBk->akses_media }}">
                    </div>
                    <div class="relative z-0 px-3 py-3 ">
                        <label for="batasNilai" class="block mb-2 text-sm font-bold text-gray-900 uppercase">Batas
                            Nilai</label>
                        <input type="text" name="batasNilai" id="batasNilai"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-auto p-2.5"
                            placeholder=" " value="{{ old('batasNilai') ?? $mkSubBk->batasNilai }}">
                    </div>
                </div>
                <div class="grid md:grid-cols-2">
                    <div class="relative z-0 px-3 py-3 ">
                        <label for="luring" class="block mb-2 text-sm font-bold text-gray-900 uppercase">Luring</label>
                        <input type="text" name="luring" id="luring"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-auto p-2.5"
                            placeholder=" " value="{{ old('luring') ?? $mkSubBk->luring }}%">
                    </div>
                    <div class="relative z-0 px-3 py-3 ">
                        <label for="daring" class="block mb-2 text-sm font-bold text-gray-900 uppercase">Daring</label>
                        <input type="text" name="daring" id="daring"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-auto p-2.5"
                            placeholder=" " value="{{ old('daring') ?? $mkSubBk->daring }}%">
                    </div>
                </div>
                <div>
                    <div class="relative z-0 px-3 py-3">
                        <label for="deskripsi_mk" class="block mb-2 text-sm font-bold text-gray-900 uppercase">Deskripsi
                            Matakuliah</label>
                        <input type="text" name="deskripsi_mk" id="deskripsi_mk"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            placeholder=" " value="{{ old('deskripsi_mk') ?? $mkSubBk->deskripsi_mk }}">
                    </div>
                </div>
                <div class="flex justify-center">
                    <button
                        class="flex items-center bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-sm font-semibold p-2"
                        type="submit">

                        UPDATE
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                        </svg>
                    </button>
                </div>


            </form>
        </div>

        <br />
        <hr />
    </div>

    <div>
        <div class="my-3 px-3 py-3">
            <h2 class="font-bold text-2xl mb-0 text-blue-800">Sub BK</h2>

        </div>
        <a href="{{ route('mk.subbk', ['id' => $mkSubBk->kdmatakuliah]) }}" class="px-3 py-3"><button
                class=" bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 mb-3">Kelola Sub
                Bahan
                Kajian
            </button>
        </a>
        <hr />
        <br />
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
