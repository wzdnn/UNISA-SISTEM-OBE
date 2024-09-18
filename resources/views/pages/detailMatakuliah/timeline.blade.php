@extends('layouts.app')

@push('style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

<br>

@section('body')
    <nav class="flex px-5 py-3 bg-white border shadow-md rounded-lg mb-3 mr-3" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('index.mk') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                    <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Matakuliah
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="{{ route('detail.mk', ['id' => $matakuliah->kdmatakuliah]) }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 ">Detail
                        {{ $matakuliah->kodematakuliah }} {{ $matakuliah->matakuliah }}</a>
                </div>
            </li>

            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="{{ route('timeline.index', ['id' => $matakuliah->kdmatakuliah]) }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 ">Timeline Matakuliah</a>
                </div>
            </li>
        </ol>
    </nav>


    <div class="bg-white rounded px-4 py-2">
        <div>
            <h1 class="font-semibold text-xl uppercase">Timeline Pembelajaran Mingguan</h1>
            <h1 class="font-semibold text-xl">Matakuliah : {{ $matakuliah->matakuliah }}</h1>
        </div>
        <div class="flex items-end justify-end mb-2">
            <a href="{{ route('timeline.create', ['id' => $matakuliah->kdmatakuliah]) }}">
                <button
                    class="flex items-center bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1">Tambah
                    Timeline</button>
            </a>
        </div>
    </div>


    <div class="my-1 w-full mx-auto rounded">
        <table class="w-full text-sm rounded text-gray-500" id="mytable" name="mytable" style="border: 1 !important">
            <thead class="text-xs text-gray-700 uppercase bg-white">
                <tr class="">
                    <th scope="col" class="px-6 py-3 text-center">
                        Minggu Ke- (Pertemuan ke-)
                    </th>
                    <th scope="col" class="px-6 py-3 text-left">
                        Keterangan
                    </th>
                    <th scope="col" class="px-6 py-3 text-left">
                        CPMK
                    </th>
                    <th scope="col" class="px-6 py-3 text-left">
                        Materi
                    </th>
                    <th scope="col" class="px-6 py-3 text-left">
                        Metode Pembelajaran
                    </th>
                    <th scope="col" class="px-6 py-3 text-left">
                        Dosen
                    </th>
                    <th scope="col" class="px-6 py-3 text-left">
                        Bentuk Pembelajaran
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($timeline as $key => $t)
                    <tr class="{{ $key % 2 == 0 ? 'bg-gray-100' : 'bg-gray-50' }} border-b text-left font-bold">
                        <td class="px-6 py-4 text-center">
                            {{ $t->mingguke }}
                        </td>
                        <td class="px-6 py-4 text-left">
                            {{ $t->keterangan }}
                        </td>
                        <td class="px-6 py-4 text-left">
                            {{ $t->kode_cpmk }}
                        </td>
                        <td class="px-6 py-4 text-left">
                            {{ $t->kode_subbk }} {{ $t->materi_pembelajaran }}
                        </td>
                        <td class="px-6 py-4 text-left">
                            {{ $t->metodepembelajaran }}
                        </td>
                        <td class="flex text-left whitespace-nowrap px-6 py-4">
                            @foreach ($timelineWithDosenKelas->where('kdtimeline', $t->kdtimeline) as $dosenKelas)
                                {{ $dosenKelas->gelardepan }} {{ $dosenKelas->namalengkap }}
                                {{ $dosenKelas->gelarbelakang }} - ({{ $dosenKelas->kelas }}) <br />
                            @endforeach
                        </td>
                        <td class="px-6 py-4">
                            {{ $t->jeniskuliah }}
                        </td>
                        <td class="px-6 py-4">
                            <a
                                href="{{ route('timeline.edit', ['id' => $matakuliah->kdmatakuliah, 'kdtimeline' => $t->kdtimeline]) }}">
                                <button
                                    class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1"><i
                                        class="fa-regular fa-pen-to-square"></i></button>
                            </a>
                            <a href="{{ route('timeline.delete', ['id' => $t->kdtimeline]) }}"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data?');">
                                <button
                                    class="bg-red-600 hover:bg-red-800 text-white rounded px-2 text-md font-semibold p-1"><i
                                        class="fa-solid fa-trash"></i></button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    <script>
        //on load
        $(function() {
            MergeGridCells('#mytable', 1, false);
            // MergeGridCells('#mytable', 1, false);
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
