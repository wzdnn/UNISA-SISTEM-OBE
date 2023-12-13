@extends('layouts.app')

@push('style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@section('body')
    <nav class="flex px-5 py-3 bg-white shadow-md mb-3" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('bk.index') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                    <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Bahan Kajian
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Edit</span>
                </div>
            </li>

        </ol>
    </nav>

    <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0 text-gray-700">Tambah Bahan Kajian</h1>
    </div>
    <hr />
    @if ($errors->any())
        <p style="color: red">{{ $errors->first() }}</p>
    @endif
    <div class="my-3 mr-3">
        <div class="px-3 bg-white border border-gray-200 rounded shadow-lg justify-between">
            <form class="py-3" action="{{ route('update.bk', ['id' => $bkEdit->id]) }}" method="POST">
                @csrf
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="kode_bk" id="kode_bk"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " required value="{{ $bkEdit->kode_bk }}" />
                        <label for="kode_bk"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Kode
                            BK</label>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="bahan_kajian" id="bahan_kajian"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " required value="{{ $bkEdit->bahan_kajian }}" />
                        <label for="bahan_kajian"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Bahan
                            Kajian</label>
                    </div>
                    <div class="flex flex-col z-0 w-full mb-6 group">
                        <label for="basil" class="text-sm text-gray-500">
                            Basis Ilmu
                        </label>
                        <select id="basil" name="basil" class="form-control">
                            @foreach ($akKurikulumBasil as $basil)
                                <option value="{{ $basil->id }}">{{ $basil->basis_ilmu }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col z-0 w-full mb-6 group">
                        <label for="Bidang Ilmu" class="text-sm text-gray-500">
                            Bidang Ilmu
                        </label>
                        <select id="bidil" name="bidil" class="form-control">
                            @foreach ($akKurikulumBidil as $bidil)
                                <option value="{{ $bidil->id }}">{{ $bidil->bidang_ilmu }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="py-3">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
                </div>

            </form>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#basil').select2();
            $('#bidil').select2();
        });
    </script>
@endpush
