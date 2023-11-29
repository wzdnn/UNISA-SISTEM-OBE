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
                    <td class="w-[50vw] text-left">
                        @foreach ($tema8 as $value)
                            &#x2022; {{ $value->tema }}
                            <br />
                        @endforeach

                        <!-- Modal toggle -->
                        <button data-modal-target="defaultModal8" data-modal-toggle="defaultModal8"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="defaultModal8" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <form class="py-3" action="{{ route('store.tema') }}" method="POST">
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
                                        <div class="hidden md:grid-cols-2 md:gap-6">
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
                                        <div class="hidden md:gap-6">
                                            <div class="relative z-0 w-[10vw] mb-6 group">
                                                <input type="text" name="semester" id="semester"
                                                    class=" block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                    placeholder=" " required value="8" />
                                                <label for="semester"
                                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Semester</label>
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

                        <!-- Modal toggle -->
                        <button data-modal-target="modal-sem-8" data-modal-toggle="modal-sem-8"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="modal-sem-8" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah Semester
                                        8</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="8">
                                        <select class="w-[41vw]" id="mkselect8" name="mkselect[]" multiple="multiple">
                                            @foreach ($matakuliah as $item)
                                                <option value="{{ $item->kdmatakuliah }}">
                                                    {{ $item->kodematakuliah }} {{ $item->matakuliah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                                            type="submit">UPDATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </td>
                    <td class="w-[30vw]">
                        @foreach ($semester8_1 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach
                        <!-- Modal toggle -->
                        <button data-modal-target="modal-sem-8-1" data-modal-toggle="modal-sem-8-1"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="modal-sem-8-1" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah
                                        Semester
                                        8</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="8">
                                        <input type="hidden" name="ispilihan" value="1">
                                        <select class="w-[41vw]" id="mkselect8-1" name="mkselect[]" multiple="multiple">
                                            @foreach ($matakuliah as $item)
                                                <option value="{{ $item->kdmatakuliah }}">
                                                    {{ $item->kodematakuliah }} {{ $item->matakuliah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                                            type="submit">UPDATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="w-[30vw]">
                        @foreach ($semester8_2 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach
                        <!-- Modal toggle -->
                        <button data-modal-target="modal-sem-8-2" data-modal-toggle="modal-sem-8-2"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="modal-sem-8-2" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah
                                        Semester
                                        8</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="8">
                                        <input type="hidden" name="ispilihan" value="2">
                                        <select class="w-[41vw]" id="mkselect8-2" name="mkselect[]" multiple="multiple">
                                            @foreach ($matakuliah as $item)
                                                <option value="{{ $item->kdmatakuliah }}">
                                                    {{ $item->kodematakuliah }} {{ $item->matakuliah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                                            type="submit">UPDATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>
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
                    <td class="w-[50vw] text-left">
                        @foreach ($tema7 as $value)
                            &#x2022; {{ $value->tema }}
                            <br />
                        @endforeach

                        <!-- Modal toggle -->
                        <button data-modal-target="defaultModal7" data-modal-toggle="defaultModal7"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="defaultModal7" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <form class="py-3" action="{{ route('store.tema') }}" method="POST">
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
                                        <div class="hidden md:grid-cols-2 md:gap-6">
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
                                        <div class="hidden md:gap-6">
                                            <div class="relative z-0 w-[10vw] mb-6 group">
                                                <input type="text" name="semester" id="semester"
                                                    class=" block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                    placeholder=" " required value="7" />
                                                <label for="semester"
                                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Semester</label>
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

                        <!-- Modal toggle -->
                        <button data-modal-target="modal-sem-7" data-modal-toggle="modal-sem-7"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="modal-sem-7" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah
                                        Semester
                                        7</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="7">
                                        <select class="w-[41vw]" id="mkselect7" name="mkselect[]" multiple="multiple">
                                            @foreach ($matakuliah as $item)
                                                <option value="{{ $item->kdmatakuliah }}">
                                                    {{ $item->kodematakuliah }} {{ $item->matakuliah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                                            type="submit">UPDATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </td>
                    <td class="w-[30vw]">
                        @foreach ($semester7_1 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach
                        <!-- Modal toggle -->
                        <button data-modal-target="modal-sem-7-1" data-modal-toggle="modal-sem-7-1"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="modal-sem-7-1" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah
                                        Semester
                                        7</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="7">
                                        <input type="hidden" name="ispilihan" value="1">
                                        <select class="w-[41vw]" id="mkselect7-1" name="mkselect[]" multiple="multiple">
                                            @foreach ($matakuliah as $item)
                                                <option value="{{ $item->kdmatakuliah }}">
                                                    {{ $item->kodematakuliah }} {{ $item->matakuliah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                                            type="submit">UPDATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="w-[30vw]">
                        @foreach ($semester7_2 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach
                        <button data-modal-target="modal-sem-7-2" data-modal-toggle="modal-sem-7-2"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="modal-sem-7-2" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah
                                        Semester
                                        7</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="7">
                                        <input type="hidden" name="ispilihan" value="2">
                                        <select class="w-[41vw]" id="mkselect7-2" name="mkselect[]" multiple="multiple">
                                            @foreach ($matakuliah as $item)
                                                <option value="{{ $item->kdmatakuliah }}">
                                                    {{ $item->kodematakuliah }} {{ $item->matakuliah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                                            type="submit">UPDATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>
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
                    <td class="w-[50vw] text-left">
                        @foreach ($tema6 as $value)
                            &#x2022; {{ $value->tema }}
                            <br />
                        @endforeach

                        <!-- Modal toggle -->
                        <button data-modal-target="defaultModal6" data-modal-toggle="defaultModal6"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="defaultModal6" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <form class="py-3" action="{{ route('store.tema') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="6">
                                        <div class="grid md:gap-6">
                                            <div class="relative z-0 w-full mb-6 group">
                                                <input type="text" name="tema" id="tema"
                                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                    placeholder=" " required value="{{ old('tema') }}" />
                                                <label for="tema"
                                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tema</label>
                                            </div>
                                        </div>
                                        <div class="hidden md:grid-cols-2 md:gap-6">
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
                                        <div class="hidden md:gap-6">
                                            <div class="relative z-0 w-[10vw] mb-6 group">
                                                <input type="text" name="semester" id="semester"
                                                    class=" block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                    placeholder=" " required value="6" />
                                                <label for="semester"
                                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Semester</label>
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
                        @foreach ($semester6_0 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach

                        <!-- Modal toggle -->
                        <button data-modal-target="modal-sem-6-0" data-modal-toggle="modal-sem-6-0"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="modal-sem-6-0" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah
                                        Semester
                                        6</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="6">
                                        <input type="hidden" name="ispilihan" value="0">
                                        <select class="w-[41vw]" id="mkselect6" name="mkselect[]" multiple="multiple">
                                            @foreach ($matakuliah as $item)
                                                <option value="{{ $item->kdmatakuliah }}">
                                                    {{ $item->kodematakuliah }} {{ $item->matakuliah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                                            type="submit">UPDATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </td>
                    <td class="w-[30vw]">
                        @foreach ($semester6_1 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach
                        <!-- Modal toggle -->
                        <button data-modal-target="modal-sem-6-1" data-modal-toggle="modal-sem-6-1"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="modal-sem-6-1" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah
                                        Semester
                                        6</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="6">
                                        <input type="hidden" name="ispilihan" value="1">
                                        <select class="w-[41vw]" id="mkselect6-1" name="mkselect[]" multiple="multiple">
                                            @foreach ($matakuliah as $item)
                                                <option value="{{ $item->kdmatakuliah }}">
                                                    {{ $item->kodematakuliah }} {{ $item->matakuliah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                                            type="submit">UPDATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="w-[30vw]">
                        @foreach ($semester6_2 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach
                        <!-- Modal toggle -->
                        <button data-modal-target="modal-sem-6-2" data-modal-toggle="modal-sem-6-2"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="modal-sem-6-2" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah
                                        Semester
                                        6</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="6">
                                        <input type="hidden" name="ispilihan" value="2">
                                        <select class="w-[41vw]" id="mkselect6-2" name="mkselect[]" multiple="multiple">
                                            @foreach ($matakuliah as $item)
                                                <option value="{{ $item->kdmatakuliah }}">
                                                    {{ $item->kodematakuliah }} {{ $item->matakuliah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                                            type="submit">UPDATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>
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
                    <td class="w-[50vw] text-left">
                        @foreach ($tema5 as $value)
                            &#x2022; {{ $value->tema }}
                            <br />
                        @endforeach

                        <!-- Modal toggle -->
                        <button data-modal-target="defaultModal5" data-modal-toggle="defaultModal5"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="defaultModal5" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <form class="py-3" action="{{ route('store.tema') }}" method="POST">
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
                                        <div class="hidden md:grid-cols-2 md:gap-6">
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
                                        <div class="hidden md:gap-6">
                                            <div class="relative z-0 w-[10vw] mb-6 group">
                                                <input type="text" name="semester" id="semester"
                                                    class=" block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                    placeholder=" " required value="5" />
                                                <label for="semester"
                                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Semester</label>
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
                        @foreach ($semester5_0 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach

                        <!-- Modal toggle -->
                        <button data-modal-target="modal-sem-5-0" data-modal-toggle="modal-sem-5-0"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="modal-sem-5-0" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah
                                        Semester
                                        5</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="5">
                                        <input type="hidden" name="ispilihan" value="0">
                                        <select class="w-[41vw]" id="mkselect5" name="mkselect[]" multiple="multiple">
                                            @foreach ($matakuliah as $item)
                                                <option value="{{ $item->kdmatakuliah }}">
                                                    {{ $item->kodematakuliah }} {{ $item->matakuliah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                                            type="submit">UPDATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </td>
                    <td class="w-[30vw]">
                        @foreach ($semester5_1 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach

                        <!-- Modal toggle -->
                        <button data-modal-target="modal-sem-5-1" data-modal-toggle="modal-sem-5-1"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="modal-sem-5-1" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah
                                        Semester
                                        5</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="5">
                                        <input type="hidden" name="ispilihan" value="1">
                                        <select class="w-[41vw]" id="mkselect5-1" name="mkselect[]" multiple="multiple">
                                            @foreach ($matakuliah as $item)
                                                <option value="{{ $item->kdmatakuliah }}">
                                                    {{ $item->kodematakuliah }} {{ $item->matakuliah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                                            type="submit">UPDATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </td>
                    <td class="w-[30vw]">
                        @foreach ($semester5_2 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach
                        <!-- Modal toggle -->
                        <button data-modal-target="modal-sem-5-2" data-modal-toggle="modal-sem-5-2"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="modal-sem-5-2" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah
                                        Semester
                                        5</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="5">
                                        <input type="hidden" name="ispilihan" value="2">
                                        <select class="w-[41vw]" id="mkselect5-2" name="mkselect[]" multiple="multiple">
                                            @foreach ($matakuliah as $item)
                                                <option value="{{ $item->kdmatakuliah }}">
                                                    {{ $item->kodematakuliah }} {{ $item->matakuliah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                                            type="submit">UPDATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>
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
                    <td class="w-[50vw] text-left">
                        @foreach ($tema4 as $value)
                            &#x2022; {{ $value->tema }}
                            <br />
                        @endforeach

                        <!-- Modal toggle -->
                        <button data-modal-target="defaultModal4" data-modal-toggle="defaultModal4"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="defaultModal4" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <form class="py-3" action="{{ route('store.tema') }}" method="POST">
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
                                        <div class="hidden md:grid-cols-2 md:gap-6">
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
                                        <div class="hidden md:gap-6">
                                            <div class="relative z-0 w-[10vw] mb-6 group">
                                                <input type="text" name="semester" id="semester"
                                                    class=" block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                    placeholder=" " required value="4" />
                                                <label for="semester"
                                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Semester</label>
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
                        @foreach ($semester4_0 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach

                        <!-- Modal toggle -->
                        <button data-modal-target="modal-sem-4-0" data-modal-toggle="modal-sem-4-0"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="modal-sem-4-0" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah
                                        Semester
                                        4</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="4">
                                        <input type="hidden" name="ispilihan" value="0">
                                        <select class="w-[41vw]" id="mkselect4" name="mkselect[]" multiple="multiple">
                                            @foreach ($matakuliah as $item)
                                                <option value="{{ $item->kdmatakuliah }}">
                                                    {{ $item->kodematakuliah }} {{ $item->matakuliah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                                            type="submit">UPDATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </td>
                    <td class="w-[30vw]">
                        @foreach ($semester4_1 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach
                        <!-- Modal toggle -->
                        <button data-modal-target="modal-sem-4-1" data-modal-toggle="modal-sem-4-1"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="modal-sem-4-1" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah
                                        Semester
                                        4</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="4">
                                        <input type="hidden" name="ispilihan" value="1">
                                        <select class="w-[41vw]" id="mkselect4-1" name="mkselect[]" multiple="multiple">
                                            @foreach ($matakuliah as $item)
                                                <option value="{{ $item->kdmatakuliah }}">
                                                    {{ $item->kodematakuliah }} {{ $item->matakuliah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                                            type="submit">UPDATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="w-[30vw]">
                        @foreach ($semester4_2 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach
                        <!-- Modal toggle -->
                        <button data-modal-target="modal-sem-4-2" data-modal-toggle="modal-sem-4-2"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="modal-sem-4-2" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah
                                        Semester
                                        4</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="4">
                                        <input type="hidden" name="ispilihan" value="2">
                                        <select class="w-[41vw]" id="mkselect4-2" name="mkselect[]" multiple="multiple">
                                            @foreach ($matakuliah as $item)
                                                <option value="{{ $item->kdmatakuliah }}">
                                                    {{ $item->kodematakuliah }} {{ $item->matakuliah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                                            type="submit">UPDATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>
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
                    <td class="w-[50vw] text-left">
                        @foreach ($tema3 as $value)
                            &#x2022; {{ $value->tema }}
                            <br />
                        @endforeach

                        <!-- Modal toggle -->
                        <button data-modal-target="defaultModal3" data-modal-toggle="defaultModal3"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="defaultModal3" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <form class="py-3" action="{{ route('store.tema') }}" method="POST">
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
                                        <div class="hidden md:grid-cols-2 md:gap-6">
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
                                        <div class="hidden md:gap-6">
                                            <div class="relative z-0 w-[10vw] mb-6 group">
                                                <input type="text" name="semester" id="semester"
                                                    class=" block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                    placeholder=" " required value="3" />
                                                <label for="semester"
                                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Semester</label>
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
                        @foreach ($semester3_0 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach

                        <!-- Modal toggle -->
                        <button data-modal-target="modal-sem-3-0" data-modal-toggle="modal-sem-3-0"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="modal-sem-3-0" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah
                                        Semester
                                        3</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="3">
                                        <input type="hidden" name="ispilihan" value="0">
                                        <select class="w-[41vw]" id="mkselect3" name="mkselect[]" multiple="multiple">
                                            @foreach ($matakuliah as $item)
                                                <option value="{{ $item->kdmatakuliah }}">
                                                    {{ $item->kodematakuliah }} {{ $item->matakuliah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                                            type="submit">UPDATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </td>
                    <td class="w-[30vw]">
                        @foreach ($semester3_1 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach
                        <!-- Modal toggle -->
                        <button data-modal-target="modal-sem-3-1" data-modal-toggle="modal-sem-3-1"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="modal-sem-3-1" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah
                                        Semester
                                        3</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="3">
                                        <input type="hidden" name="ispilihan" value="1">
                                        <select class="w-[41vw]" id="mkselect3-1" name="mkselect[]" multiple="multiple">
                                            @foreach ($matakuliah as $item)
                                                <option value="{{ $item->kdmatakuliah }}">
                                                    {{ $item->kodematakuliah }} {{ $item->matakuliah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                                            type="submit">UPDATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="w-[30vw]">
                        @foreach ($semester3_2 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach
                        <!-- Modal toggle -->
                        <button data-modal-target="modal-sem-3-2" data-modal-toggle="modal-sem-3-2"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="modal-sem-3-2" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah
                                        Semester
                                        3</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="3">
                                        <input type="hidden" name="ispilihan" value="2">
                                        <select class="w-[41vw]" id="mkselect3-2" name="mkselect[]" multiple="multiple">
                                            @foreach ($matakuliah as $item)
                                                <option value="{{ $item->kdmatakuliah }}">
                                                    {{ $item->kodematakuliah }} {{ $item->matakuliah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                                            type="submit">UPDATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>
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
                    <td class="w-[50vw] text-left">
                        @foreach ($tema2 as $value)
                            &#x2022; {{ $value->tema }}
                            <br />
                        @endforeach

                        <!-- Modal toggle -->
                        <button data-modal-target="defaultModal2" data-modal-toggle="defaultModal2"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="defaultModal2" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <form class="py-3" action="{{ route('store.tema') }}" method="POST">
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
                                        <div class="hidden md:grid-cols-2 md:gap-6">
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
                                        <div class="hidden md:gap-6">
                                            <div class="relative z-0 w-[10vw] mb-6 group">
                                                <input type="text" name="semester" id="semester"
                                                    class=" block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                    placeholder=" " required value="2" />
                                                <label for="semester"
                                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Semester</label>
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
                        @foreach ($semester2_0 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach

                        <!-- Modal toggle -->
                        <button data-modal-target="modal-sem-2-0" data-modal-toggle="modal-sem-2-0"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="modal-sem-2-0" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah
                                        Semester
                                        2</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="2">
                                        <input type="hidden" name="ispilihan" value="0">
                                        <select class="w-[41vw]" id="mkselect2" name="mkselect[]" multiple="multiple">
                                            @foreach ($matakuliah as $item)
                                                <option value="{{ $item->kdmatakuliah }}">
                                                    {{ $item->kodematakuliah }} {{ $item->matakuliah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                                            type="submit">UPDATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </td>
                    <td class="w-[30vw]">
                        @foreach ($semester2_1 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach
                        <!-- Modal toggle -->
                        <button data-modal-target="modal-sem-2-2" data-modal-toggle="modal-sem-2-2"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="modal-sem-2-2" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah
                                        Semester
                                        2</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="2">
                                        <input type="hidden" name="ispilihan" value="1">
                                        <select class="w-[41vw]" id="mkselect2-2" name="mkselect[]" multiple="multiple">
                                            @foreach ($matakuliah as $item)
                                                <option value="{{ $item->kdmatakuliah }}">
                                                    {{ $item->kodematakuliah }} {{ $item->matakuliah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                                            type="submit">UPDATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="w-[30vw]">
                        @foreach ($semester2_2 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach
                        <!-- Modal toggle -->
                        <button data-modal-target="modal-sem-2-2" data-modal-toggle="modal-sem-2-2"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="modal-sem-2-2" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah
                                        Semester
                                        2</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="2">
                                        <input type="hidden" name="ispilihan" value="2">
                                        <select class="w-[41vw]" id="mkselect2-2" name="mkselect[]" multiple="multiple">
                                            @foreach ($matakuliah as $item)
                                                <option value="{{ $item->kdmatakuliah }}">
                                                    {{ $item->kodematakuliah }} {{ $item->matakuliah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                                            type="submit">UPDATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>
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
                    <td class="w-[50vw] text-left">
                        @foreach ($tema1 as $value)
                            &#x2022; {{ $value->tema }}
                            <br />
                        @endforeach

                        <!-- Modal toggle -->
                        <button data-modal-target="defaultModal1" data-modal-toggle="defaultModal1"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="defaultModal1" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <form class="py-3" action="{{ route('store.tema') }}" method="POST">
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
                                        <div class="hidden md:grid-cols-2 md:gap-6">
                                            <div class="flex flex-col z-0 w-full mb-6 group">
                                                <label for="unit" class="text-sm text-gray-500">
                                                    Kurikulum
                                                </label>
                                                <select id="inputState" name="unit" data-live-search="true"
                                                    class="form-control border">
                                                    @foreach ($ak_kurikulum as $unit)
                                                        <option value="{{ $unit->kdkurikulum }}">
                                                            {{ $unit->kurikulum }}
                                                            {{ $unit->tahun }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="hidden md:gap-6">
                                            <div class="relative z-0 w-[10vw] mb-6 group">
                                                <input type="text" name="semester" id="semester"
                                                    class=" block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                    placeholder=" " required value="1" />
                                                <label for="semester"
                                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Semester</label>
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
                        @foreach ($semester1_0 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach

                        <!-- Modal toggle -->
                        <button data-modal-target="modal-sem-1-0" data-modal-toggle="modal-sem-1-0"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="modal-sem-1-0" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah
                                        Semester
                                        1</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="1">
                                        <input type="hidden" name="ispilihan" value="0">
                                        <select class="w-[41vw]" id="mkselect1" name="mkselect[]"
                                            multiple="multiple">
                                            @foreach ($matakuliah as $item)
                                                <option value="{{ $item->kdmatakuliah }}">
                                                    {{ $item->kodematakuliah }} {{ $item->matakuliah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                                            type="submit">UPDATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </td>
                    <td class="w-[30vw]">
                        @foreach ($semester1_1 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach
                        <!-- Modal toggle -->
                        <button data-modal-target="modal-sem-1-1" data-modal-toggle="modal-sem-1-1"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="modal-sem-1-1" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah
                                        Semester
                                        1</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="1">
                                        <input type="hidden" name="ispilihan" value="1">
                                        <select class="w-[41vw]" id="mkselect1-1" name="mkselect[]"
                                            multiple="multiple">
                                            @foreach ($matakuliah as $item)
                                                <option value="{{ $item->kdmatakuliah }}">
                                                    {{ $item->kodematakuliah }} {{ $item->matakuliah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                                            type="submit">UPDATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="w-[30vw]">
                        @foreach ($semester1_2 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <br />
                        @endforeach
                        <!-- Modal toggle -->
                        <button data-modal-target="modal-sem-1-2" data-modal-toggle="modal-sem-1-2"
                            class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                        <!-- Main modal -->
                        <div id="modal-sem-1-2" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah
                                        Semester
                                        1</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="1">
                                        <input type="hidden" name="ispilihan" value="2">
                                        <select class="w-[41vw]" id="mkselect1-2" name="mkselect[]"
                                            multiple="multiple">
                                            @foreach ($matakuliah as $item)
                                                <option value="{{ $item->kdmatakuliah }}">
                                                    {{ $item->kodematakuliah }} {{ $item->matakuliah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                                            type="submit">UPDATE</button>
                                    </form>
                                </div>
                            </div>
                        </div>
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

@push('script')
    <script>
        $(document).ready(function() {
            $('#mkselect8').select2();
            $('#mkselect8-2').select2();
            $('#mkselect8-1').select2();
            $('#mkselect7').select2();
            $('#mkselect7-1').select2();
            $('#mkselect7-2').select2();
            $('#mkselect6').select2();
            $('#mkselect6-1').select2();
            $('#mkselect6-2').select2();
            $('#mkselect5').select2();
            $('#mkselect5-1').select2();
            $('#mkselect5-2').select2();
            $('#mkselect4').select2();
            $('#mkselect4-1').select2();
            $('#mkselect4-2').select2();
            $('#mkselect3').select2();
            $('#mkselect3-1').select2();
            $('#mkselect3-2').select2();
            $('#mkselect2').select2();
            $('#mkselect2-1').select2();
            $('#mkselect2-2').select2();
            $('#mkselect1').select2();
            $('#mkselect1-1').select2();
            $('#mkselect1-2').select2();
        });
    </script>
@endpush
