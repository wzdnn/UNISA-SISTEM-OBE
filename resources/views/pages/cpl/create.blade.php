@extends('layouts.app')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>

</style>
@endpush

@section('body')
    <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0">Tambah CPL</h1>
    </div>
    <hr />
    @if ($errors->any())
        <p style="color: red">{{ $errors->first() }}</p>
    @endif
    <form class="py-3" action="{{ route('cpl.store') }}" method="POST">
        @csrf
        <div class="grid md:grid-cols-2 md:gap-6">

            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="kode_cpl" id="kode_cpl"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required value="{{ old('kode_cpl') }}" />
                <label for="kode_cpl"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Kode
                    cpl</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="cpl" id="cpl"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required value="{{ old('cpl') }}" />
                <label for="cpl"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">cpl</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <select id="kode-pl" name="kdpl[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @foreach ($ak_kurikulum_pl as $pl)
                        <option value="{{ $pl->id }}">{{ $pl->kode_pl }} {{ $pl->profile_lulusan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="deskripsi_cpl" id="deskripsi_cpl"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required value="{{ old('deskripsi_cpl') }}" />
                <label for="deskripsi_cpl"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Deskripsi
                    CPL</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <select id="inputState" name="aspek" class="form-control">
                    @foreach ($ak_kurikulum_aspek as $aspek)
                        <option value="{{ $aspek->kdaspek }}">{{ $aspek->aspek }}</option>
                    @endforeach
                </select>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <select id="inputState" name="unit" class="form-control">
                    @foreach ($ak_kurikulum as $item)
                        <option value="{{ $item->kdkurikulum }}">{{ $item->kurikulum }} {{ $item->tahun }}</option>
                    @endforeach
                </select>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <select id="inputState" name="kdcplr[]" multiple data-live-search="true" class="form-control">
                    @foreach ($ak_kurikulum_cplr as $cplr)
                        <option value="{{ $cplr->id }}">{{ $cplr->kode_cplr }} {{ $cplr->cplr }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="py-3">
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
        </div>

    </form>
@endsection
