@extends('layouts.app')

@section('body')
    <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0 text-gray-700">Organisasi Matakuliah</h1>
    </div>
    <hr />

    <div class="relative py-3">
        <table class="w-full text-sm text-center  text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr class="text-left">
                    <th scope="col" class="px-6 py-3 w-[50px]">
                        Semester
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Tema
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        MK Wajib
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        MK Wajib Universitas
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        MK Pilihan
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        SKS non-pilihan
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        SKS pilihan
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Jumlah MK non pilihan
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Jumlah MK pilihan
                    </th>

                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b text-left">
                    <td scope="row" class="px-6 py-4 font-medium text-center text-gray-900 whitespace-nowrap">
                        8
                    </td>
                    <td class="px-6 py-4 text-left">

                        <!-- Modal toggle -->
                        <button data-modal-target="defaultModal" data-modal-toggle="defaultModal"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="defaultModal" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <div class="grid md:gap-6">
                                            <div class="relative z-0 w-full mb-6 group">
                                                <input type="text" name="tema" id="tema"
                                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                    placeholder=" " required value="{{ old('tema') }}" />
                                                <label for="tema"
                                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tema</label>
                                            </div>
                                        </div>
                                        <div class="grid md:grid-cols-2 md:gap-6">
                                            <div class="flex flex-col z-0 w-full mb-6 group">
                                                <label for="unit" class="text-sm text-gray-500">
                                                    Kurikulum
                                                </label>
                                                <select id="inputState" name="unit" data-live-search="true"
                                                    class="form-control border">
                                                    @foreach ($ak_kurikulum as $unit)
                                                        <option value="{{ $unit->kdkurikulum }}">{{ $unit->kurikulum }}
                                                            {{ $unit->tahun }}
                                                        </option>
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
                        </div>

                    </td>
                    <td class="w-[30vw]">

                        @foreach ($semester8_0 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach

                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>

                    </td>
                    <td class="px-6 py-4">
                        @foreach ($semester8_1 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        @foreach ($semester8_2 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class=" px-6 py-4 ">

                    </td>
                    <td class="px-6 py-4 ">

                    </td>
                    <td class=" px-6 py-4 text-left">

                    </td>
                </tr>
                <tr class="bg-white border-b text-left">
                    <td scope="row" class="px-6 py-4 font-medium text-center text-gray-900 whitespace-nowrap">
                        7
                    </td>
                    <td class="px-6 py-4 text-left">

                        <!-- Modal toggle -->
                        <button data-modal-target="defaultModal" data-modal-toggle="defaultModal"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="defaultModal" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <div class="grid md:gap-6">
                                            <div class="relative z-0 w-full mb-6 group">
                                                <input type="text" name="tema" id="tema"
                                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                    placeholder=" " required value="{{ old('tema') }}" />
                                                <label for="tema"
                                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tema</label>
                                            </div>
                                        </div>
                                        <div class="grid md:grid-cols-2 md:gap-6">
                                            <div class="flex flex-col z-0 w-full mb-6 group">
                                                <label for="unit" class="text-sm text-gray-500">
                                                    Kurikulum
                                                </label>
                                                <select id="inputState" name="unit" data-live-search="true"
                                                    class="form-control border">
                                                    @foreach ($ak_kurikulum as $unit)
                                                        <option value="{{ $unit->kdkurikulum }}">{{ $unit->kurikulum }}
                                                            {{ $unit->tahun }}
                                                        </option>
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
                        </div>

                    </td>
                    <td class="w-[30vw]">
                        @foreach ($semester7_0 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach

                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>

                    </td>
                    <td class="px-6 py-4">
                        @foreach ($semester7_1 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        @foreach ($semester7_2 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class=" px-6 py-4 ">

                    </td>
                    <td class="px-6 py-4 ">

                    </td>
                    <td class=" px-6 py-4 text-left">

                    </td>
                </tr>
                <tr class="bg-white border-b text-left">
                    <td scope="row" class="px-6 py-4 font-medium text-center text-gray-900 whitespace-nowrap">
                        6
                    </td>
                    <td class="px-6 py-4 text-left">
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class="w-[30vw]">
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class=" px-6 py-4 ">

                    </td>
                    <td class="px-6 py-4 ">

                    </td>
                    <td class=" px-6 py-4 text-left">

                    </td>
                </tr>
                <tr class="bg-white border-b text-left">
                    <td scope="row" class="px-6 py-4 font-medium text-center text-gray-900 whitespace-nowrap">
                        5
                    </td>
                    <td class="px-6 py-4 text-left">
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class="w-[30vw]">
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class=" px-6 py-4 ">

                    </td>
                    <td class="px-6 py-4 ">

                    </td>
                    <td class=" px-6 py-4 text-left">

                    </td>
                </tr>
                <tr class="bg-white border-b text-left">
                    <td scope="row" class="px-6 py-4 font-medium text-center text-gray-900 whitespace-nowrap">
                        4
                    </td>
                    <td class="px-6 py-4 text-left">
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class="w-[30vw]">
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class=" px-6 py-4 ">

                    </td>
                    <td class="px-6 py-4 ">

                    </td>
                    <td class=" px-6 py-4 text-left">

                    </td>
                </tr>
                <tr class="bg-white border-b text-left">
                    <td scope="row" class="px-6 py-4 font-medium text-center text-gray-900 whitespace-nowrap">
                        3
                    </td>
                    <td class="px-6 py-4 text-left">
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class="w-[30vw]">
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class=" px-6 py-4 ">

                    </td>
                    <td class="px-6 py-4 ">

                    </td>
                    <td class=" px-6 py-4 text-left">

                    </td>
                </tr>
                <tr class="bg-white border-b text-left">
                    <td scope="row" class="px-6 py-4 font-medium text-center text-gray-900 whitespace-nowrap">
                        2
                    </td>
                    <td class="px-6 py-4 text-left">
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class="w-[30vw]">
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class=" px-6 py-4 ">

                    </td>
                    <td class="px-6 py-4 ">

                    </td>
                    <td class=" px-6 py-4 text-left">

                    </td>
                </tr>
                <tr class="bg-white border-b text-left">
                    <td scope="row" class="px-6 py-4 font-medium text-center text-gray-900 whitespace-nowrap">
                        1
                    </td>
                    <td class="px-6 py-4 text-left">
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class="w-[30vw]">
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="">
                            <button
                                class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                    class="fa fa-plus"></i></button>
                        </a>
                    </td>
                    <td class=" px-6 py-4 ">

                    </td>
                    <td class="px-6 py-4 ">

                    </td>
                    <td class=" px-6 py-4 text-left">

                    </td>
                </tr>

            </tbody>
        </table>
        {{-- {{ $matakuliah->links() }}
        <hr /> --}}
    </div>
@endsection
