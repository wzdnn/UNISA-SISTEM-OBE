@extends('layouts.app')

@push('style')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@section('body')
<div class="flex items-center justify-between py-5 px-5 mx-10">
    <h1 class="font-bold text-2xl mb-0 text-blue-800">Tambah Sub Bahan Kajian</h1>
</div>
<hr />
@if ($errors->any())
<p style="color: red">{{ $errors->first() }}</p>
@endif
<form class="py-3" action="{{ route('subbk.store') }}" method="POST">
    @csrf
    <div class="grid md:grid-cols-2 md:gap-6">
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="kode_subbk" id="kode_subbk"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required value="{{ old('kode_subbk') }}" />
            <label for="kode_subbk"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Kode
                Sub BK</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="sub_bk" id="sub_bk"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required value="{{ old('sub_bk') }}" />
            <label for="sub_bk"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Sub
                Bahan Kajian</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="referensi" id="referensi"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required value="{{ old('referensi') }}" />
            <label for="referensi"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Referensi</label>
        </div>
        <div class="flex flex-col z-0 w-full mb-6 group">
            <label for="bahan_kajian" class="text-sm text-gray-500">
                Bahan Kajian
            </label>
            <select id="bahan_kajian" name="bahan_kajian" class="form-control">
                @foreach ($akKurikulumBk as $bk)
                <option value="{{ $bk->kdbk }}">{{ $bk->kode_bk }} {{ $bk->bahan_kajian }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col z-0 w-full mb-6 group">
            <label for="unit" class="text-sm text-gray-500">
                Kurikulum
            </label>
            <select id="unit" name="unit" class="form-control">
                @foreach ($akKurikulum as $unit)
                <option value="{{ $unit->kdkurikulum }}">{{ $unit->kurikulum }} {{ $unit->tahun }}</option>
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

@push('script')
<script>
    $(document).ready(function() {
        $('#unit').select2();
        $('#bahan_kajian').select2();
    });
</script>
@endpush