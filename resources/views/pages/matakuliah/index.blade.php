@extends('layouts.app')

@section('body')
    <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0 text-gray-700">Matakuliah</h1>
        @if (Auth::user()->role == 'admin')
            <a href="{{ route('create.mk') }}">
                <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1">Tambah
                    Matakuliah
                </button>
            </a>
        @endif
    </div>
    <hr />

    <div class="relative py-3">

        <table class="w-full text-sm text-center  text-gray-500" id="mytable" name="mytable" style="border: 1 !important">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr class="text-left">
                    <th scope="col" class="px-6 py-3 w-[50px]">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        SUB BK
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        CPMK
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Pokok Bahasan
                    </th>
                    <th scope="col" class="w-5 ">
                        K
                    </th>
                    <th scope="col" class="w-5 ">
                        T
                    </th>
                    <th scope="col" class="w-5 ">
                        S
                    </th>
                    <th scope="col" class="w-5 ">
                        Pm
                    </th>
                    <th scope="col" class="w-5 ">
                        SL
                    </th>
                    <th scope="col" class="w-5 ">
                        FL
                    </th>
                    <th scope="col" class="w-5 ">
                        P
                    </th>
                    <th scope="col" class="px-3 py-1 ">
                        Matakuliah
                    </th>
                    <th scope="col" class="w-10 ">
                        Unit
                    </th>

                    <th scope="col" class="px-6 py-3 ">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($matakuliah->count() > 0)
                    @foreach ($matakuliah as $key => $value)
                        {{-- Sub BK --}}

                        <?php
                        $cpmk_sbk = [];
                        foreach ($value->GetAllidSubBK as $item0) {
                            if (count($item0->cpmks) > 0) {
                                foreach ($item0->cpmks as $item) {
                                    $arr = $item->toArray();
                                    $cpmk_sbk[$arr['pivot']['id_gabung_subbk']][] = $arr['kode_cpmk'];
                                }
                            }
                        }
                        $subbkexist = isset($value->MKtoSBKread);
                        ?>

                        @if ($value->MKtoSBKread->count() > 0)
                            @foreach ($value->MKtoSBKread as $mksbk)
                                <tr class="bg-white border-b text-left">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ ($matakuliah->currentPage() - 1) * $matakuliah->perPage() + $key + 1 }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <p>{{ $mksbk->kode_subbk }} {{ $mksbk->sub_bk }}</p>
                                    </td>

                                    <td class="px-6 py-4">

                                        <?php
                                        if (isset($cpmk_sbk) && array_key_exists($mksbk->pivot->id, $cpmk_sbk)) {
                                            foreach ($cpmk_sbk[$mksbk->pivot->id] as $item) {
                                                echo '&#8226; ', $item;
                                                echo '</br>';
                                            }
                                        }
                                        ?>

                                        {{-- @foreach ($value->GetAllidSubBK as $mksbks)
                                            @foreach ($mksbks->cpmks as $items)
                                                &#x2022; {{ $items->kode_cpmk }}
                                            @endforeach
                                            <hr />
                                        @endforeach --}}


                                    </td>
                                    <td class="px-6 py-4">

                                        {{ $mksbk->pivot->pokok_bahasan }} <br />

                                    </td>
                                    <td class="w-5 ">

                                        {{ $mksbk->pivot->kuliah }} <br />

                                    </td>
                                    <td class="w-5">

                                        {{ $mksbk->pivot->tutorial }} <br />

                                    </td>
                                    <td class="w-5">

                                        {{ $mksbk->pivot->seminar }} <br />

                                    </td>
                                    <td class="w-5">

                                        {{ $mksbk->pivot->praktikum }} <br />

                                    </td>
                                    <td class="w-5">

                                        {{ $mksbk->pivot->skill_lab }} <br />

                                    </td>
                                    <td class="w-5">

                                        {{ $mksbk->pivot->field_lab }} <br />

                                    </td>
                                    <td class="w-5">

                                        {{ $mksbk->pivot->praktik }} <br />

                                    </td>
                                    <td class="px-3 py-1">
                                        {{ $value->kodematakuliah }} | {{ $value->matakuliah }}
                                    </td>
                                    <td class=" w-10">
                                        {{ $value->kurikulum }} {{ $value->tahun }}
                                    </td>
                                    <td class=" px-6 py-4">
                                        <a href="{{ route('detail.mk', ['id' => $value->kdmatakuliah]) }}">
                                            <button type="button"
                                                class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 "><i
                                                    class="fa-solid fa-circle-info"></i></button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="bg-white border-b text-left">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ ($matakuliah->currentPage() - 1) * $matakuliah->perPage() + $key + 1 }}
                                </td>
                                <td class="px-6 py-4">

                                </td>

                                <td class="px-6 py-4">

                                </td>
                                <td class="px-6 py-4">


                                </td>
                                <td class="w-5 ">


                                </td>
                                <td class="w-5">


                                </td>
                                <td class="w-5">


                                </td>
                                <td class="w-5">


                                </td>
                                <td class="w-5">


                                </td>
                                <td class="w-5">


                                </td>
                                <td class="w-5">

                                </td>
                                <td class="px-3 py-1">
                                    {{ $value->kodematakuliah }} | {{ $value->matakuliah }}
                                </td>
                                <td class=" w-10">
                                    {{ $value->kurikulum }} {{ $value->tahun }}
                                </td>
                                <td class=" px-6 py-4">
                                    <a href="{{ route('detail.mk', ['id' => $value->kdmatakuliah]) }}">
                                        <button type="button"
                                            class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 "><i
                                                class="fa-solid fa-circle-info"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td class="justify-center text-center" colspan="14">Data belum ada</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{ $matakuliah->links() }}
        <hr />
    </div>
    <script>
        //on load
        $(function() {
            // MergeGridCells('#mytable', 1, false);
            MergeGridCells('#mytable', 14, false);
            MergeGridCells('#mytable', 13, false);
            MergeGridCells('#mytable', 12, false);
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
