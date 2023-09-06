@extends('layouts.app')

@section('body')
    <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0">Detail Survei</h1>
    </div>
    <hr />

    {{-- Row Pertama --}}

    {{-- <div class="py-5 grid md:grid-cols-2 md:gap-6">
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="kode_cpl" id="kode_cpl"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " readonly value="" />
            <label for="kode_cpl"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Kode
                CPL</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="number" name="kode_cplr" id="kode_cplr"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " readonly
                value="@foreach ($cpmkShow as $cplcplr)
                                    {{ $cplcplr->kode_cplr }} {{ $cplcplr->cplr }}<br /> @endforeach" />
            <label for="kode_cplr"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">CPLR</label>
        </div>
    </div> --}}

    <form action="{{ route('show.cpmk.post', ['id' => $id]) }}" method="post">
        @csrf
        @forelse ($cpmk as $item)
            <p style="margin-top: 1rem">{{ $item->cpmk }}</p>
            <input type="checkbox" name="cpmk[]" id="" value="{{ $item->id }}">
        @empty
            <p>No Data</p>
        @endforelse
        <br>
        <button type="submit">save</button>
    </form>
@endsection
