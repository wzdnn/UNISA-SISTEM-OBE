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
                <a href="{{ route('bk.index') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                    <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Bahan Kajian
                </a>
            </li>
    </nav>
    <div class="flex items-center justify-between py-5 px-5">
        <div class="flex items-center">
            <h1 class="font-bold text-2xl mb-0 text-gray-700 text-center">Bahan Kajian</h1>
        </div>
        <div class="flex items-center">
            @if (Auth::user()->role == 'admin')
                <a href="{{ route('bk.create') }}">
                    <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 inline-block mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Tambah Bahan Kajian</button>
                </a>
            @endif
        </div>
    </div>
    {{--
@section('body') --}}
    {{-- <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0 text-gray-700">Bahan Kajian</h1>
        @if (Auth::user()->role == 'admin')
            <a href="{{ route('bk.create') }}">
                <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1">Tambah Bahan
                    Kajian</button>
            </a>
        @endif
    </div> --}}
    <div class="flex flex-col">
        <form method="GET" class="rounded">
            {{-- @csrf --}}
            <select name="filter" id="" class="rounded">
                <option value="null">Kurikulum</option>
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
    <hr />

    <div class="relative py-3">
        <table id="mytable" class="w-full text-sm text-center  text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 w-[0px]">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Kode BK
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Bahan Kajian
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Basis Ilmu
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Bidang Ilmu
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Unit
                    </th>
                    @if (Auth::user()->role == 'admin')
                        <th scope="col" class="px-6 py-3 ">
                            Action
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @if ($akKurikulumBk->count() > 0)
                    @foreach ($akKurikulumBk as $key => $akKurikulumBks)
                        <tr class="{{ $key % 2 == 0 ? 'bg-gray-100' : 'bg-gray-50' }} border-b">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ ($akKurikulumBk->currentPage() - 1) * $akKurikulumBk->perPage() + $key + 1 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumBks->kode_bk }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumBks->bahan_kajian }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumBks->ak_basil }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumBks->ak_bidil }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumBks->kurikulum }} {{ $akKurikulumBks->tahun }}
                            </td>
                            @if (Auth::user()->role == 'admin')
                                <td class="px-6 py-4">
                                    <a href="{{ route('edit.bk', ['id' => $akKurikulumBks->id]) }}">
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1"><i
                                                class="fa-regular fa-pen-to-square"></i></button>
                                    </a>
                                    <a href="{{ route('delete.bk', ['id' => $akKurikulumBks->id]) }}">
                                        <button
                                            class="bg-red-600 hover:bg-red-800 text-white rounded px-2 text-md font-semibold p-1"><i
                                                class="fa-solid fa-trash"></i></button>
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="justify-center text-center" colspan="7">Bahan Kajian belum ada</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{ $akKurikulumBk->withQueryString()->links() ?? '' }}
        <hr />
    </div>
    <script>
        //on load
        $(function() {
            // MergeGridCells('#mytable', 1, false);
            MergeGridCells('#mytable', 1, false);
            MergeGridCells('#mytable', 6, false);

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
