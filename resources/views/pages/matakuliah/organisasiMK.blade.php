@extends('layouts.app')

@push('style')
    <style>
        .select2.select2-container {
            width: 100% !important;
        }

        .select2.select2-container .select2-selection {
            border: 1px solid #ccc;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            height: 34px;
            margin-bottom: 15px;
            outline: none !important;
            transition: all .15s ease-in-out;
        }

        .select2.select2-container .select2-selection .select2-selection__rendered {
            color: #333;
            line-height: 32px;
            padding-right: 33px;
        }

        .select2.select2-container .select2-selection .select2-selection__arrow {
            background: #f8f8f8;
            border-left: 1px solid #ccc;
            -webkit-border-radius: 0 3px 3px 0;
            -moz-border-radius: 0 3px 3px 0;
            border-radius: 0 3px 3px 0;
            height: 32px;
            width: 33px;
        }

        .select2.select2-container.select2-container--open .select2-selection.select2-selection--single {
            background: #f8f8f8;
        }

        .select2.select2-container.select2-container--open .select2-selection.select2-selection--single .select2-selection__arrow {
            -webkit-border-radius: 0 3px 0 0;
            -moz-border-radius: 0 3px 0 0;
            border-radius: 0 3px 0 0;
        }

        .select2.select2-container.select2-container--open .select2-selection.select2-selection--multiple {
            border: 1px solid #34495e;
        }

        .select2.select2-container .select2-selection--multiple {
            height: auto;
            min-height: 34px;
        }

        .select2.select2-container .select2-selection--multiple .select2-search--inline .select2-search__field {
            margin-top: 0;
            height: 32px;
        }

        .select2.select2-container .select2-selection--multiple .select2-selection__rendered {
            display: block;
            padding: 0 4px;
            line-height: 29px;
        }

        .select2.select2-container .select2-selection--multiple .select2-selection__choice {
            background-color: #f8f8f8;
            border: 1px solid #ccc;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            margin: 4px 4px 0 0;
            padding: 0 6px 0 22px;
            height: 24px;
            line-height: 24px;
            font-size: 12px;
            position: relative;
        }

        .select2.select2-container .select2-selection--multiple .select2-selection__choice .select2-selection__choice__remove {
            position: absolute;
            top: 0;
            left: 0;
            height: 22px;
            width: 22px;
            margin: 0;
            text-align: center;
            color: #e74c3c;
            font-weight: bold;
            font-size: 16px;
        }

        .select2-container .select2-dropdown {
            background: transparent;
            border: none;
            margin-top: -5px;
        }

        .select2-container .select2-dropdown .select2-search {
            padding: 0;
        }

        .select2-container .select2-dropdown .select2-search input {
            outline: none !important;
            border: 1px solid #34495e !important;
            border-bottom: none !important;
            padding: 4px 6px !important;
        }

        .select2-container .select2-dropdown .select2-results {
            padding: 0;
        }

        .select2-container .select2-dropdown .select2-results ul {
            background: #fff;
            border: 1px solid #34495e;
        }

        .select2-container .select2-dropdown .select2-results ul .select2-results__option--highlighted[aria-selected] {
            background-color: #3498db;
        }
    </style>
@endpush

@section('body')
    <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0 text-gray-700">Organisasi Matakuliah</h1>

        <!-- Modal toggle -->
        <button data-modal-target="copy-modal" data-modal-toggle="copy-modal"
            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
            Salin Matakuliah
        </button>

        <!-- Main modal -->
        <div id="copy-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Salin Matakuliah
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="copy-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <!-- Modal content -->
                    <div class="relative bg-white px-5 py-5 rounded-lg shadow">
                        <form class="py-3" action="{{ route('copy.mk') }}" method="POST">
                            @csrf

                            <div class="md:grid-cols-2 md:gap-6">
                                <div class="flex flex-col z-0 w-full mb-6 group">
                                    <label for="unit" class="text-sm text-gray-500">
                                        Kurikulum Universitas
                                    </label>
                                    <select id="unitUniv" name="unitUniv" data-live-search="true"
                                        class="form-control border">
                                        @foreach ($kurikulumUniv as $unitUniv)
                                            <option value="{{ $unitUniv->kdkurikulum }}">{{ $unitUniv->kurikulum }}
                                                {{ $unitUniv->tahun }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="flex flex-col z-0 w-full mb-6 group">
                                    <label for="unitProdi" class="text-sm text-gray-500">
                                        Kurikulum Prodi
                                    </label>
                                    <select id="unitProdi" name="unitProdi" data-live-search="true"
                                        class="form-control border">
                                        @foreach ($ak_kurikulum as $unitProdi)
                                            <option value="{{ $unitProdi->kdkurikulum }}">{{ $unitProdi->kurikulum }}
                                                {{ $unitProdi->tahun }}
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
        </div>
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
                    <td class="w-full text-left">
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
                            <a href="{{ route('reset.mk', ['id' => $value->kdmatakuliah]) }}">
                                <button class="rounded p-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </a>
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
                                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Pemetaan Matakuliah
                                        Semester
                                        8</h1>
                                    <form class="py-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="semester" value="8">
                                        <input type="hidden" name="ispilihan" value="0">
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
                            <a href="{{ route('reset.mk', ['id' => $value->kdmatakuliah]) }}">
                                <button class="rounded p-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </a>
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
                    <td class="w-[35vw]">
                        @foreach ($semester8_2 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <a href="{{ route('reset.mk', ['id' => $value->kdmatakuliah]) }}">
                                <button class="rounded p-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </a>
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
                        @foreach ($semester_8_sks as $value8)
                            {{ $value8->sks_non_pilihan }}
                        @endforeach
                    </td>
                    <td class="px-6 py-4 ">
                        @foreach ($semester_8_sks as $value8)
                            {{ $value8->sks_pilihan }}
                        @endforeach
                    </td>
                    <td class=" px-6 py-4">
                        @foreach ($semester_8_sks as $value8)
                            {{ $value8->jumlah_mk_non_pilihan }}
                        @endforeach
                    </td>
                    <td class=" px-6 py-4">
                        @foreach ($semester_8_sks as $value8)
                            {{ $value8->jumlah_mk_pilihan }}
                        @endforeach
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
                            <a href="{{ route('reset.mk', ['id' => $value->kdmatakuliah]) }}">
                                <button class="rounded p-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </a>
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
                                        <input type="hidden" name="ispilihan" value="0">
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
                            <a href="{{ route('reset.mk', ['id' => $value->kdmatakuliah]) }}">
                                <button class="rounded p-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </a>
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
                            <a href="{{ route('reset.mk', ['id' => $value->kdmatakuliah]) }}">
                                <button class="rounded p-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </a>
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
                        @foreach ($semester_7_sks as $value7)
                            {{ $value7->sks_non_pilihan }}
                        @endforeach
                    </td>
                    <td class="px-6 py-4 ">
                        @foreach ($semester_7_sks as $value7)
                            {{ $value7->sks_pilihan }}
                        @endforeach
                    </td>
                    <td class=" px-6 py-4">
                        @foreach ($semester_7_sks as $value7)
                            {{ $value7->jumlah_mk_non_pilihan }}
                        @endforeach
                    </td>
                    <td class=" px-6 py-4">
                        @foreach ($semester_7_sks as $value7)
                            {{ $value7->jumlah_mk_pilihan }}
                        @endforeach
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
                            <a href="{{ route('reset.mk', ['id' => $value->kdmatakuliah]) }}">
                                <button class="rounded p-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </a>
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
                            <a href="{{ route('reset.mk', ['id' => $value->kdmatakuliah]) }}">
                                <button class="rounded p-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </a>
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
                            <a href="{{ route('reset.mk', ['id' => $value->kdmatakuliah]) }}">
                                <button class="rounded p-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </a>
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
                        @foreach ($semester_6_sks as $value6)
                            {{ $value6->sks_non_pilihan }}
                        @endforeach
                    </td>
                    <td class="px-6 py-4 ">
                        @foreach ($semester_6_sks as $value6)
                            {{ $value6->sks_pilihan }}
                        @endforeach
                    </td>
                    <td class=" px-6 py-4">
                        @foreach ($semester_6_sks as $value6)
                            {{ $value6->jumlah_mk_non_pilihan }}
                        @endforeach
                    </td>
                    <td class=" px-6 py-4">
                        @foreach ($semester_6_sks as $value6)
                            {{ $value6->jumlah_mk_pilihan }}
                        @endforeach
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
                            <a href="{{ route('reset.mk', ['id' => $value->kdmatakuliah]) }}">
                                <button class="rounded p-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </a>
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
                            <a href="{{ route('reset.mk', ['id' => $value->kdmatakuliah]) }}">
                                <button class="rounded p-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </a>
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
                            <a href="{{ route('reset.mk', ['id' => $value->kdmatakuliah]) }}">
                                <button class="rounded p-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </a>
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
                        @foreach ($semester_5_sks as $value5)
                            {{ $value5->sks_non_pilihan }}
                        @endforeach
                    </td>
                    <td class="px-6 py-4 ">
                        @foreach ($semester_5_sks as $value5)
                            {{ $value5->sks_pilihan }}
                        @endforeach
                    </td>
                    <td class=" px-6 py-4">
                        @foreach ($semester_5_sks as $value5)
                            {{ $value5->jumlah_mk_non_pilihan }}
                        @endforeach
                    </td>
                    <td class=" px-6 py-4">
                        @foreach ($semester_5_sks as $value5)
                            {{ $value5->jumlah_mk_pilihan }}
                        @endforeach
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
                            <a href="{{ route('reset.mk', ['id' => $value->kdmatakuliah]) }}">
                                <button class="rounded p-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </a>
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
                            <a href="{{ route('reset.mk', ['id' => $value->kdmatakuliah]) }}">
                                <button class="rounded p-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </a>
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
                            <a href="{{ route('reset.mk', ['id' => $value->kdmatakuliah]) }}">
                                <button class="rounded p-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </a>
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
                        @foreach ($semester_4_sks as $value4)
                            {{ $value4->sks_non_pilihan }}
                        @endforeach
                    </td>
                    <td class="px-6 py-4 ">
                        @foreach ($semester_4_sks as $value4)
                            {{ $value4->sks_pilihan }}
                        @endforeach
                    </td>
                    <td class=" px-6 py-4t">
                        @foreach ($semester_4_sks as $value4)
                            {{ $value4->jumlah_mk_non_pilihan }}
                        @endforeach
                    </td>
                    <td class=" px-6 py-4t">
                        @foreach ($semester_4_sks as $value4)
                            {{ $value4->jumlah_mk_pilihan }}
                        @endforeach
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
                            <a href="{{ route('reset.mk', ['id' => $value->kdmatakuliah]) }}">
                                <button class="rounded p-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </a>
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
                            <a href="{{ route('reset.mk', ['id' => $value->kdmatakuliah]) }}">
                                <button class="rounded p-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </a>
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
                            <a href="{{ route('reset.mk', ['id' => $value->kdmatakuliah]) }}">
                                <button class="rounded p-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </a>
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
                        @foreach ($semester_3_sks as $value3)
                            {{ $value3->sks_non_pilihan }}
                        @endforeach
                    </td>
                    <td class="px-6 py-4 ">
                        @foreach ($semester_3_sks as $value3)
                            {{ $value3->sks_pilihan }}
                        @endforeach
                    </td>
                    <td class=" px-6 py-4">
                        @foreach ($semester_3_sks as $value3)
                            {{ $value3->jumlah_mk_non_pilihan }}
                        @endforeach
                    </td>
                    <td class=" px-6 py-4">
                        @foreach ($semester_3_sks as $value3)
                            {{ $value3->jumlah_mk_pilihan }}
                        @endforeach
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
                            <a href="{{ route('reset.mk', ['id' => $value->kdmatakuliah]) }}">
                                <button class="rounded p-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </a>
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
                                        <select class="w-[41vw]" id="mkselect2" name="mkselect[]"
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
                        @foreach ($semester2_1 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <a href="{{ route('reset.mk', ['id' => $value->kdmatakuliah]) }}">
                                <button class="rounded p-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </a>
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
                                        <select class="w-[41vw]" id="mkselect2-2" name="mkselect[]"
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
                        @foreach ($semester2_2 as $value)
                            &#x2022; {{ $value->kodematakuliah }}-{{ $value->matakuliah }}
                            <a href="{{ route('reset.mk', ['id' => $value->kdmatakuliah]) }}">
                                <button class="rounded p-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </a>
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
                                        <select class="w-[41vw]" id="mkselect2-2" name="mkselect[]"
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
                        @foreach ($semester_2_sks as $value2)
                            {{ $value2->sks_non_pilihan }}
                        @endforeach
                    </td>
                    <td class="px-6 py-4 ">
                        @foreach ($semester_2_sks as $value2)
                            {{ $value2->sks_pilihan }}
                        @endforeach
                    </td>
                    <td class=" px-6 py-4 text-left">
                        @foreach ($semester_2_sks as $value2)
                            {{ $value2->jumlah_mk_non_pilihan }}
                        @endforeach
                    </td>
                    <td class=" px-6 py-4 text-left">
                        @foreach ($semester_2_sks as $value2)
                            {{ $value2->jumlah_mk_pilihan }}
                        @endforeach
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
                            <a href="{{ route('reset.mk', ['id' => $value->kdmatakuliah]) }}">
                                <button class="rounded p-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </a>
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
                            <a href="{{ route('reset.mk', ['id' => $value->kdmatakuliah]) }}">
                                <button class="rounded p-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </a>
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
                            <a href="{{ route('reset.mk', ['id' => $value->kdmatakuliah]) }}">
                                <button class="rounded p-1"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </a>
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
                        @foreach ($semester_1_sks as $value1)
                            {{ $value1->sks_non_pilihan }}
                        @endforeach
                    </td>
                    <td class="px-6 py-4 ">
                        @foreach ($semester_1_sks as $value1)
                            {{ $value1->sks_pilihan }}
                        @endforeach
                    </td>
                    <td class=" px-6 py-4">

                        @foreach ($semester_1_sks as $value1)
                            {{ $value1->jumlah_mk_non_pilihan }}
                        @endforeach

                    </td>
                    <td class=" px-6 py-4">

                        @foreach ($semester_1_sks as $value1)
                            {{ $value1->jumlah_mk_pilihan }}
                        @endforeach

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
            $('#unitProdi').select2();
            $('#unitUniv').select2();
        });
    </script>
@endpush
