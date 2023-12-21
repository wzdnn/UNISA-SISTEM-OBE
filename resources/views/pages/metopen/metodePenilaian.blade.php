@extends('layouts.app')

@section('body')
    <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0 text-gray-700">Metode Penilaian</h1>
        <button data-modal-target="defaultModal" data-modal-toggle="defaultModal"
            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
            Tambah Metode Penilaian
        </button>

        <!-- Main modal -->
        <div id="defaultModal" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                    <form class="py-3" action="{{ route('post.metopen') }}" method="POST">
                        @csrf
                        <div class="">
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="metode_penilaian" id="metode_penilaian"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required value="{{ old('metode_penilaian') }}" />
                                <label for="metode_penilaian"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Metode
                                    Penilaian</label>
                            </div>
                        </div>
                        <div class="py-3">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <hr />

    <div class="relative py-3">
        <table class="w-full text-sm text-center  text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 w-[50px]">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3 text-left ">
                        Metode Penilaian
                    </th>
                    <th scope="col" class="px-6 py-3 text-left ">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($metopen->count() > 0)
                    @foreach ($metopen as $key => $metopens)
                        <tr class="bg-white border-b text-left">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ ($metopen->currentPage() - 1) * $metopen->perPage() + $key + 1 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $metopens->metode_penilaian }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('delete.metopen', ['id' => $metopens->id]) }}">
                                    <button
                                        class="bg-red-600 hover:bg-red-800 text-white rounded px-2 text-md font-semibold p-1"><i
                                            class="fa-solid fa-trash"></i></button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="justify-center text-center" colspan="5">Metode Penilaian belum ada</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <hr />
    </div>
@endsection
