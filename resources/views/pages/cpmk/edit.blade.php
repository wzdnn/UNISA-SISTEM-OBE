@extends('layouts.app')

@section('body')
    <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0">Edit CPMK</h1>
    </div>
    <hr />
    <form action="{{ route('edit.cpmk.post', ['id' => $cpmkEdit->id]) }}" method="POST">
        @csrf

        <div class="grid gap-4 mb-4 sm:grid-cols-2">
            <div>
                <label for="kode_cpmk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                    CPMK</label>
                <input type="text" name="kode_cpmk" id="kode_cpmk" value={{ $cpmkEdit->kode_cpmk }}
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5"
                    placeholder="">
            </div>
            <div>
                <label for="cpmk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CPMK</label>
                <input type="text" name="cpmk" id="cpmk" value={{ $cpmkEdit->cpmk }}
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5"
                    placeholder="">
            </div>

        </div>
        <div class="flex items-center space-x-4">
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                Edit
            </button>

        </div>
    </form>
@endsection
