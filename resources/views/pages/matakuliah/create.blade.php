@extends('layouts.app')

@section('body')
<div class="flex items-center justify-between py-5 px-5 mx-10">
    <h1 class="font-bold text-2xl mb-0">Tambah CPL</h1>
</div>
<hr />
@if ($errors->any())
<p style="color: red">{{ $errors->first() }}</p>
@endif
<form class="py-3" action="{{ route('store.mk') }}" method="POST">
    @csrf
    <div class="grid md:grid-cols-2 md:gap-6">
        <div class="relative z-0 w-full mb-6 group">
            <select id="inputState" name="kdsubbk[]" multiple data-live-search="true" class="form-control">
                @foreach ($SBK as $subbk)
                <option value="{{ $subbk->id }}">{{ $subbk->kode_subbk }} {{ $subbk->sub_bk }}</option>
                @endforeach
            </select>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="kodematakuliah" id="kodematakuliah"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required value="{{ old('kodematakuliah') }}" />
            <label for="kodematakuliah"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Kode Matakuliah</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="matakuliah" id="matakuliah"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required value="{{ old('matakuliah') }}" />
            <label for="matakuliah"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">   Matakuliah</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="mk_singkat" id="mk_singkat"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required value="{{ old('mk_singkat') }}" />
            <label for="mk_singkat"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">MK Singkat</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="semester" id="semester"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required value="{{ old('semester') }}" />
            <label for="semester"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Semester</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="isObe" id="isObe"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required value="{{ old('isObe') }}" />
            <label for="isObe"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">isObe</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <select id="inputState" name="unit" class="form-control">
                @foreach ($ak_kurikulum as $item)
                <option value="{{ $item->kdkurikulum }}">{{ $item->kurikulum }}</option>
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