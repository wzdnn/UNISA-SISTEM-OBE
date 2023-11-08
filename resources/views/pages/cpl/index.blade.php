@extends('layouts.app')

@section('body')
    <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0 text-gray-700">CPL</h1>
        @if (Auth::user()->role == 'admin')
            <a href="{{ route('cpl.create') }}">
                <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1">Tambah CPL
                </button>
            </a>
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
                        Profile Lulusan
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Kode CPL
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        CPL
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Deskripsi CPL
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Aspek
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        CPLR
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
                @if ($akKurikulumCpl->count() > 0)
                    @foreach ($akKurikulumCpl as $key => $akKurikulumCpls)
                        <tr class="bg-white border-b text-left">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{-- {{ $loop->iteration }} --}}
                                {{ ($akKurikulumCpl->currentPage() - 1) * $akKurikulumCpl->perPage() + $key + 1 }}
                            </td>
                            <td class="px-6 py-4 text-left">
                                @foreach ($akKurikulumCpls->CpltoPl as $cplpl)
                                    <p data-tooltip-target="pl" type="text">{{ $cplpl->kode_pl }}
                                        {{-- <div id="pl" role="tooltip"
                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        {{ $cplpl->kode_pl }}
                                        {{ $cplpl->deskripsi_profile }}
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div> --}}
                                    </p>
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumCpls->kode_cpl }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumCpls->cpl }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $akKurikulumCpls->deskripsi_cpl }}
                            </td>
                            <td class=" px-6 py-4 ">
                                {{ $akKurikulumCpls->aspek }}
                            </td>
                            <td class="px-6 py-4 ">
                                @foreach ($akKurikulumCpls->CpltoCplr as $cplcplr)
                                    &#x2022;{{ $cplcplr->kode_cplr }}-{{ $cplcplr->cplr }}<br />
                                @endforeach
                            </td>
                            <td class=" px-6 py-4 text-left">
                                {{ $akKurikulumCpls->kurikulum }} - {{ $akKurikulumCpls->tahun }}
                            </td>
                            @if (Auth::user()->role == 'admin')
                                <td class="px-6 py-4">
                                    <a href="{{ route('edit.cpl', ['id' => $akKurikulumCpls->id]) }}">
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1"><i
                                                class="fa-regular fa-pen-to-square"></i></button>
                                    </a>
                                    <a href="{{ route('cpl.delete', ['id' => $akKurikulumCpls->id]) }}">
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
                        <td class="justify-center text-center" colspan="9">CPL belum ada</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{ $akKurikulumCpl->links() }}
        <hr />
    </div>
    <script>
        //on load
        $(function() {
            // MergeGridCells('#mytable', 1, false);
            MergeGridCells('#mytable', 1, false);
            MergeGridCells('#mytable', 8, false);

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
