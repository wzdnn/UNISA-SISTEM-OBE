@extends('layouts.app')

@push('style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

<br>
@section('body')
    <nav class="flex px-5 py-3 bg-white shadow-md mb-3" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('index.metopen') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                    <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Metode Penilaian
                </a>
            </li>
    </nav>

    <div class="flex items-center justify-between py-5 px-5">
        <div class="flex items-center">
            <h1 class="font-bold text-2xl mb-0 text-gray-700 text-center">
                Metode Penilaian</h1>
        </div>
    </div>
    {{-- @extends('layouts.app')


@section('body')
    <div class="flex items-center justify-between py-5">
        <h1 class="font-bold text-2xl mb-0 text-gray-700">Metode Penilaian</h1> --}}

    <div class="flex flex-col">
        <form method="GET" class="rounded">
            {{-- @csrf --}}
            <select name="filter-kurikulum" id="" class="rounded">
                <option value="">Kurikulum</option>
                @foreach ($kdkurikulum as $item)
                    <option value="{{ $item->kdkurikulum }}" @selected(request()->input('filter-kurikulum') == $item->kdkurikulum)>{{ $item->kurikulum }}
                        {{ $item->tahun }}
                    </option>
                @endforeach
            </select>

            <input type="search" name="filter-matakuliah"
                class="w-full p-3 text-sm text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                placeholder="Search Matakuliah" value="{{ request()->input('filter-matakuliah') }}" />

            {{-- <input type="text" name="search" class=" rounded"> --}}
            <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1"
                type="submit">Filter</button>
        </form>

        @if (request()->search != null && request()->key != null)
            <div class="my-3">
                <h2 class="fs-5">Key : {{ request()->key }}, Search : {{ request()->search }}</h2>
            </div>
        @endif
    </div>

    <div class="relative py-3">
        <table class="w-full text-sm text-center text-gray-500" id="mytable" name="mytable" style="border: 1 !important">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr class="text-left">
                    <th scope="col" class="px-6 py-3 w-[50px]">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Matakuliah
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        CPMK
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Metode Penilaian
                    </th>
                    <th scope="col" class="px-3 py-1 ">
                        Bobot
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Action
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nilai
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($matakuliah->count() > 0)
                    @foreach ($matakuliah as $key => $value)
                        @if ($value->amcid > 0)
                            <tr class="{{ $key % 2 == 0 ? 'bg-gray-100' : 'bg-gray-50' }} border-b text-left">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{-- {{ ($matakuliah->currentPage() - 1) * $matakuliah->perPage() + $key + 1 }} --}}
                                    {{ $value->kdmatakuliah }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $value->kodematakuliah }} | {{ $value->matakuliah }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('metopen.cpmk', ['id' => $value->amcid]) }}"
                                        class="hover:text-blue-600">
                                        {{ $value->kode_cpmk }}
                                    </a> <br />
                                </td>
                                <td class="px-6 py-4 ">
                                    {{ $value->metode_penilaian }}
                                </td>
                                <td class="px-3 py-4 flex flex-row">
                                    <input type="text" id="bobot" name="bobot"
                                        class="block w-10 p-2 text-center text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500"
                                        disabled value="{{ $value->bobot }}%">


                                    <button data-modal-target="popup-modal" id="btnTambah" data-modal-toggle="popup-modal"
                                        class="ml-2 hover:text-blue-600" data-id-target="{{ $value->gmcid }}"
                                        type="button">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>

                                    {{-- Model Start --}}
                                    {{-- @include('include.flash-massage') --}}
                                    <div>
                                        <div id="popup-modal" tabindex="-1"
                                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-auto max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow ">
                                                    <button type="button"
                                                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                                                        data-modal-hide="popup-modal">
                                                        <svg class="w-3 h-3" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                    <div class="p-3 text-center justify-center items-center">

                                                        <form action="" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id_gabung" id="input-id">
                                                            <div class="flex flex-col py-4">
                                                                <label for="bobot"
                                                                    class="block mb-2 text-sm font-medium py-1 text-gray-900 ">Bobot
                                                                    Nilai</label>
                                                                <input type="text" id="bobot" name="bobot"
                                                                    aria-describedby="bobot-explanation"
                                                                    class="bg-gray-50 border text-center border-gray-300 text-gray-900 text-sm rounded-lg  focus:ring-blue-500 focus:border-blue-500 block  "
                                                                    placeholder="">
                                                            </div>

                                                            <button data-modal-hide="popup-modal" type="submit"
                                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-2 py-2 text-center">
                                                                Submit
                                                            </button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Model End --}}
                                </td>
                                @if ($value->gmcid > 0)
                                    <td class=" px-6 py-4 ">
                                        {{-- <a href="{{ route('tugas.metopen', ['id' => $value->gmcid]) }}">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </a> --}}

                                        <!-- Modal toggle -->
                                        <button data-modal-target="authentic-modal" id="tgsTambah"
                                            data-id-target="{{ $value->gmcid }}" data-modal-toggle="{{ $value->gmcid }}"
                                            class="px-2 text-md font-semibold p-1 hover:text-blue-600" type="button">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>

                                        <!-- Main modal -->
                                        <div id="{{ $value->gmcid }}" tabindex="-1" aria-hidden="true"
                                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                                                    <!-- Modal body -->
                                                    <div class="p-4 md:p-5">
                                                        <h1 class="font-bold text-2xl mb-0 ">
                                                            {{ $value->metode_penilaian }} </h1>
                                                        <h3 class="font-medium text-xl mb-0 text-gray-500">
                                                            {{ $value->kode_cpmk }} </h3>
                                                        <h3 class="font-semibold text-md text-justify">{{ $value->cpmk }}
                                                        </h3>
                                                        <h3 class="font-semibold text-l mb-0">Bobot CPMK :
                                                            {{ $value->bobot }}%

                                                        </h3>

                                                        <form class="space-y-4" action="{{ route('tugas.keterangan') }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="tgsinput_id" id="tgsinput_id"
                                                                value="{{ $value->gmcid }}">
                                                            {{-- <input type="hidden" name="kdmatakuliah" id="kdmatakuliah"
                                                                value="{{ $value->kdmatakuliah }}"> --}}

                                                            <div>
                                                                <label for="keterangan"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                                                                <input type="text" name="keterangan" id="keterangan"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                                            </div>

                                                            <div>
                                                                <label for="keterangan"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun
                                                                    Akademik</label>
                                                                <select id="tahunakademik" name="tahunakademik"
                                                                    class="form-control">
                                                                    @foreach ($tahunAkademik as $tahunakademik)
                                                                        <option
                                                                            value="{{ $tahunakademik->kdtahunakademik }}">
                                                                            {{ $tahunakademik->tahunakademik }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="grid md:grid-cols-2 md:gap-6">
                                                                <div class="relative z-0 w-full mb-6 group">
                                                                    <label for="idlensa"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Id
                                                                        Lensa</label>
                                                                    <input type="text" name="idlensa" id="idlensa"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                                                </div>
                                                                <div class="flex flex-col z-0 w-full mb-6 group">
                                                                    <label for="idtipelensa"
                                                                        class="text-sm text-gray-500">
                                                                        Tipe Tugas
                                                                    </label>
                                                                    <select id="idtipelensa" name="idtipelensa"
                                                                        class="form-control">
                                                                        @foreach ($tipeLensa as $tl)
                                                                            <option value="{{ $tl->id }}">
                                                                                {{ $tl->tipelensa }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <button type="submit"
                                                                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="{{ route('list.metopen', ['id' => $value->gmcid]) }}"
                                            class="hover:text-blue-600">
                                            <i class="fa fa-list" aria-hidden="true"></i>
                                        </a>


                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('matkul.nilai', ['id' => $value->kdmatakuliah]) }}"
                                            class="hover:text-blue-600">
                                            <i class="fa fa-folder" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                @endif

                            </tr>
                        @else
                            <tr class="{{ $key % 2 == 0 ? 'bg-gray-100' : 'bg-gray-50' }} border-b text-left">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{-- {{ ($matakuliah->currentPage() - 1) * $matakuliah->perPage() + $key + 1 }} --}}
                                    {{ $value->kdmatakuliah }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $value->kodematakuliah }} | {{ $value->matakuliah }}
                                </td>
                                <td class="px-6 py-4">

                                </td>
                                <td class="px-6 py-4">

                                </td>
                                <td class="px-3 py-4 flex flex-row">

                                </td>
                                <td class=" px-6 py-4">

                                </td>
                                <td class=" px-6 py-4">

                                </td>
                            </tr>
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td class="justify-center text-center" colspan="6">Data belum ada</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{ $matakuliah->withQueryString()->links() ?? '' }}
        <hr />
    </div>
    <script>
        //on load
        $(function() {
            // MergeGridCells('#mytable', 1, false);
            MergeGridCells('#mytable', 2, false);
            MergeGridCells('#mytable', 1, false);

        });

        function MergeGridCells(table_id, dimension_col, is_alternate_color) {
            let i = 0;
            // first_instance holds the first instance of identical td
            // first_instance menyimpan kata yang sama
            let first_instance = null;
            // how many identical td?
            // berapa baris yang sama?
            let rowspan = 1;
            let first_text = '';
            // iterate through rows
            // loop untuk setiap baris
            $(table_id + ' > tbody  > tr').each(function() {

                // find the td of the correct column (determined by the dimension_col set above)
                // ambil teks (sesuai dengan kolom ke-dimension_col)
                let dimension_td = $(this).find('td:nth-child(' + dimension_col + ')');
                let text = btoa(dimension_td[0].innerHTML.trim());

                if (first_instance == null) {
                    // must be the first row
                    // baris pertama
                    first_instance = dimension_td;
                    first_text = text;
                    i++;
                    painting(is_alternate_color, first_instance, i);
                } else if (text == first_text) {
                    // the current td is identical to the previous
                    // baris ini sama dengan baris sebelumnya
                    // remove the current td
                    // delete baris ini
                    dimension_td.remove();
                    ++rowspan;
                    // increment the rowspan attribute of the first instance
                    // baris ini di merge dengan sebelumnya dengan cara menaikkan rowspan baris pertama yang sama sampai dengan baris ini
                    first_instance.attr('rowspan', rowspan);
                    painting(is_alternate_color, first_instance, i);
                } else {
                    // this cell is different from the last, stop previous rowspan
                    // baris ini berbeda dengan yang sebelumnya, hentikan proses merger sebelumnya
                    first_instance = dimension_td;
                    first_text = text;
                    rowspan = 1;
                    i++;
                    painting(is_alternate_color, first_instance, i);
                }

            });
        }

        function painting(is_alternate_color, instance, i) {
            if (is_alternate_color)
                instance.attr('style', 'background-color: ' + ((i % 2 == 0) ? '#FFFFB6' : '#ff9da4'));
        }
    </script>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#metopenselect').select2();
            $('#idtipelensa').select2();
        });

        const btnTambah = document.querySelectorAll("#btnTambah");
        btnTambah.forEach(e => {
            e.addEventListener("click", () => {
                console.log(e.getAttribute('data-id-target'));
                const inputTarget = document.getElementById('input-id');
                inputTarget.value = e.getAttribute('data-id-target');
            })
        });

        const tgsTambah = document.querySelectorAll("#tgsTambah");
        tgsTambah.forEach(e => {
            e.addEventListener("click", () => {
                console.log(e.getAttribute('data-id-target'))
                const targetInput = document.getElementById('tgsinput_id');
                targetInput.value = e.getAttribute('data-id-target');
            })
        })
    </script>
@endpush
