@extends('layouts.app')

@section('body')
    <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0">Mapping Sub Bahan Kajian</h1>
    </div>
    <hr />

    <form action="{{ route('show.cpmk.post', ['id' => $id]) }}" method="post">
        @csrf
        @forelse ($subBK as $item)
            <ul class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg ">
                <li class="w-full border-b border-gray-200 rounded-t-lg ">
                    <div class="flex items-center pl-3">
                        <input type="checkbox" name="subbk[]" id="" value="{{ $item->id }}"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">
                        <label for="subbk[]"
                            class="w-full py-3 ml-2 text-sm font-medium text-gray-900">{{ $item->kode_subbk }}
                            {{ $item->sub_bk }}</label>
                    </div>
                </li>
            </ul>
        @empty
            <p>No Data</p>
        @endforelse
        <br>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
        </div>
    </form>
@endsection
