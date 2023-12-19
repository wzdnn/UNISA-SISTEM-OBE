@extends('layouts.app')


@section('body')
    <div class="flex items-center justify-between py-5">
        <h1 class="font-bold text-2xl mb-0 text-gray-700">Master Metode Penilaian</h1>

    </div>
    <div class="flex flex-col">
        <form method="GET" class="rounded">
            {{-- @csrf --}}
            <select name="filter" id="" class="rounded">
                <option value="null">null</option>
                @foreach ($kdkurikulum as $item)
                    <option value="{{ $item->kurikulum }}" @selected(request()->filter == $item->kurikulum)>{{ $item->kurikulum }}</option>
                @endforeach
            </select>
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
                </tr>
            </thead>
            <tbody>

                @if ($matakuliah->count() > 0)
                    @foreach ($matakuliah as $key => $value)
                        @if ($value->GetAllidSubBK->count() > 0)
                            @foreach ($value->GetAllidSubBK as $mksbk)
                                @foreach ($mksbk->cpmks as $cpmk)
                                    @foreach ($cpmk->metopens as $cpmks)
                                        @if ($cpmks->CPMKtoMTP->count() > 0)
                                            @foreach ($cpmks->CPMKtoMTP as $metopens)
                                                <tr class="bg-white border-b text-left">
                                                    <td scope="row"
                                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                        {{ ($matakuliah->currentPage() - 1) * $matakuliah->perPage() + $key + 1 }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $value->kodematakuliah }} | {{ $value->matakuliah }}
                                                    </td>
                                                    <td class="px-6 py-4">

                                                        <a href="{{ route('metopen.cpmk', ['id' => $cpmk->id]) }}">
                                                            {{ $cpmk->kode_cpmk }}
                                                        </a> <br />

                                                    </td>
                                                    <td class="px-6 py-4">

                                                        {{ $metopens->metode_penilaian }}


                                                    </td>
                                                    <td class="px-3 py-1">

                                                        {{-- @include('include.flash-massage') --}}
                                                        <div>
                                                            <button data-modal-target="popup-modal"
                                                                data-modal-toggle="popup-modal"
                                                                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-1.5 py-1.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                                type="button">
                                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                            </button>

                                                            <div id="popup-modal" tabindex="-1"
                                                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                <div class="relative p-4 w-full max-w-md max-h-full">
                                                                    <div
                                                                        class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                                        <button type="button"
                                                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                            data-modal-hide="popup-modal">
                                                                            <svg class="w-3 h-3" aria-hidden="true"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                fill="none" viewBox="0 0 14 14">
                                                                                <path stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                            </svg>
                                                                            <span class="sr-only">Close modal</span>
                                                                        </button>
                                                                        <div
                                                                            class="p-4 md:p-5 text-center justify-center items-center">

                                                                            <form action="" method="POST">
                                                                                @csrf

                                                                                <div class="flex flex-col px-2 py-4">
                                                                                    <label for="bobot"
                                                                                        class="block mb-2 text-sm font-medium py-1 text-gray-900 dark:text-white">Bobot
                                                                                        Nilai</label>
                                                                                    <input type="number" id="bobot"
                                                                                        name="bobot"
                                                                                        aria-describedby="bobot-explanation"
                                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                                        placeholder=""
                                                                                        value="{{ old('bobot') }}">
                                                                                </div>

                                                                                <button data-modal-hide="popup-modal"
                                                                                    type="submit"
                                                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-2 py-2 text-center">
                                                                                    Submit
                                                                                </button>
                                                                            </form>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td class=" px-6 py-4">

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="bg-white border-b text-left">
                                                <td scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                    {{ ($matakuliah->currentPage() - 1) * $matakuliah->perPage() + $key + 1 }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $value->kodematakuliah }} | {{ $value->matakuliah }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="{{ route('metopen.cpmk', ['id' => $cpmk->id]) }}">
                                                        {{ $cpmk->kode_cpmk }}
                                                    </a> <br />
                                                </td>
                                                <td class="px-6 py-4">

                                                </td>
                                                <td class="px-3 py-1">

                                                </td>
                                                <td class=" px-6 py-4">

                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                        @else
                            <tr class="bg-white border-b text-left">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ ($matakuliah->currentPage() - 1) * $matakuliah->perPage() + $key + 1 }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $value->kodematakuliah }} | {{ $value->matakuliah }}
                                </td>
                                <td class="px-6 py-4">

                                </td>
                                <td class="px-6 py-4">

                                </td>
                                <td class="px-3 py-1">

                                </td>
                                <td class=" px-6 py-4">

                                </td>
                            </tr>
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td class="justify-center text-center" colspan="7">Data belum ada</td>
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
            // MergeGridCells('#mytable', 4, false);
            MergeGridCells('#mytable', 3, false);
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
        });
    </script>
@endpush
