@extends('layouts.app')

@section('body')
    <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0 text-gray-700">CPL-CPMK</h1>
        <div class="flex flex-row space-x-3">
            <a href="{{ route('list.cpmk') }}">
                <button
                    class="block text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">List CPMK
                </button>
            </a>
        </div>
    </div>

    <div class="flex flex-col">
        <form method="GET" class="rounded">
            {{-- @csrf --}}
            <select name="filter" id="" class="rounded">
                <option value="null">Kurikulum</option>
                @foreach ($kdkurikulum as $item)
                    <option value="{{ $item->kurikulum }}" @selected(request()->filter == $item->kurikulum)>{{ $item->kurikulum }}
                        {{ $item->tahun }}</option>
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
                <tr class="text-left">
                    <th scope="col" class="px-6 py-3 w-[50px]">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        CPL
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        CPMK
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Unit
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($CPMK->count() > 0)
                    @foreach ($CPMK as $key => $value)
                        <tr class="{{ $key % 2 == 0 ? 'bg-gray-100' : 'bg-gray-50' }} border-b">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 text-left">
                                {{ $value->kode_cpl }} {{ $value->cpl }}
                            </td>
                            <td class="px-6 py-4 text-left">
                                {{-- @foreach ($value->CPMKtoCPL as $cplcpmk)
                                    {{ $cplcpmk->kode_cpmk }} {{ $cplcpmk->cpmk }}<br />
                                @endforeach --}}
                                @foreach ($value->CpltoCpmk as $cplcpmk)
                                    &#x2022; {{ $cplcpmk->kode_cpmk }} {{ $cplcpmk->cpmk }}<br />
                                @endforeach
                            </td>
                            <td class="px-6 py-4 text-left">
                                {{ $value->kurikulum }}-{{ $value->tahun }}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="justify-center text-center" colspan="4">Data belum ada</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{ $CPMK->links() }}
        <hr />
    </div>

    <script>
        //on load
        $(function() {
            // MergeGridCells('#mytable', 1, false);
            MergeGridCells('#mytable', 4, false);

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
