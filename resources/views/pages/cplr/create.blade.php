@extends('layouts.app')

@section('body')
    <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0">Tambah Sumber Referensi</h1>
    </div>
    <hr />
    @if ($errors->any())
        <p style="color: red">{{ $errors->first() }}</p>
    @endif
    <form class="py-3" action="{{ route('cplr.store') }}" method="POST">
        @csrf
        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="kode_cplr" id="kode_cplr"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required value="{{ old('kode_cplr') }}" />
                <label for="kode_cplr"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Kode
                    CPLR</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="cplr" id="cplr"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required value="{{ old('cplr') }}" />
                <label for="cplr"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">CPLR</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="deskripsi_cplr" id="deskripsi_cplr"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required value="{{ old('deskripsi_cplr') }}" />
                <label for="deskripsi_cplr"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Deskripsi</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <select id="inputState" name="aspek" class="form-control">
                    @foreach ($akKurikulumAspek as $aspek)
                        <option value="{{ $aspek->kdaspek }}">{{ $aspek->aspek }}</option>
                    @endforeach
                </select>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <select id="inputState" name="sumber" class="form-control">
                    @foreach ($akKurikulumSumber as $sumber)
                        <option value="{{ $sumber->kdsumber }}">{{ $sumber->sumber }}</option>
                    @endforeach
                </select>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <select id="inputState" name="unit" class="form-control">
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
