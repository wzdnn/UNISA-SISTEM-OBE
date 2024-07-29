@extends('layouts.app')

<br />
@section('body')
    <div class=" bg-white rounded-sm">
        <div class="flex flex-col py-5 px-4">

            <h1 class="font-bold text-2xl mb-0 text-gray-700">
                {{ $matakuliah->matakuliah }}
            </h1>

            <h3 class="font-semibold text-xl mb-0 text-gray-700">{{ $matakuliah->namalengkap }},
                {{ $matakuliah->gelarbelakang }}
            </h3>

            <h3 class="font-medium text-xl mb-0 text-gray-700">Batas Nilai : {{ $matakuliah->batasNilai }} </h3>

            <h3 class="font-medium text-l mb-0 text-gray-700">Kode CPL :
                @foreach ($cpl as $c)
                    {{ $c->kode_cpl }},
                @endforeach
            </h3>

        </div>
    </div>
    <div class="flex flex-col mt-2">
        <form method="GET" class="rounded">
            @csrf
            <select name="filter" id="filter" class="rounded">
                <option value="null">Tahun Akademik</option>
                @foreach ($tahunAkademik as $item)
                    <option value="{{ $item->kdtahunakademik }}" @selected(request()->filter == $item->kdtahunakademik)>{{ $item->tahunakademik }}
                    </option>
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

    <table class="w-full overflow-x-scroll text-sm text-center  text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-white">
            <tr class="text-left">
                <th scope="col" class="px-6 py-3 w-[50px]">
                </th>
                <th scope="col" class="px-6 py-3">
                </th>
                <th scope="col" class="px-6 py-3 ">
                </th>
                <th scope="col" class="px-6 py-3 ">

                </th>
                @foreach ($tabel as $tbl)
                    <th scope="col" class="px-6 py-3 ">
                        {{ $tbl->kode_cpl }}
                    </th>
                @endforeach
            </tr>
            <tr class="text-left">
                <th scope="col" class="px-6 py-3 w-[50px]">
                </th>
                <th scope="col" class="px-6 py-3">
                </th>
                <th scope="col" class="px-6 py-3 ">
                </th>
                <th scope="col" class="px-6 py-3 ">

                </th>
                @foreach ($tabel as $tbl)
                    <th scope="col" class="px-6 py-3 ">
                        {{ $tbl->kode_cpmk }}
                    </th>
                @endforeach
            </tr>
            <tr class="text-left">
                <th scope="col" class="px-6 py-3 w-[50px]">
                    No.
                </th>
                <th scope="col" class="px-6 py-3">
                    Nim
                </th>
                <th scope="col" class="px-6 py-3 ">
                    Nama Mahasiswa
                </th>
                <th scope="col" class="px-6 py-3 ">
                    Nilai Akhir
                </th>
                @foreach ($tabel as $tbl)
                    <th scope="col" class="px-6 py-3 ">
                        {{ $tbl->metode_penilaian }}
                    </th>
                @endforeach
            </tr>
            <tr class="">
                <th scope="col" class="px-6 py-3">

                </th>
                <th scope="col" class="px-6 py-3">

                </th>
                <th scope="col" class="px-6 py-3">

                </th>
                <th scope="col" class="px-6 py-3">

                </th>
                @foreach ($tabel as $tbl)
                    <th scope="col" class="px-6 py-3 text-left items-center">
                        {{ $tbl->bobot }}%
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @php
                // dd(count($mahasiswa[0]));
            @endphp
            @foreach ($mahasiswa as $key => $value)
                @if ($value[0] == null)
                    <tr>
                        <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4">

                        </td>
                        <td class="px-6 py-4">

                        </td>
                        <td class="px-6 py-4">

                        </td>
                        <td class="px-6 py-4">

                        </td>
                    </tr>
                @break;
            @endif
            <tr
                class=" border-b text-left shadow {{ !$kelulusanpermahasiswa[$value[1]] ? 'bg-yellow-100' : 'bg-white' }}">
                <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                    {{ $loop->iteration }}
                </td>
                <td class="px-6 py-4">
                    {{ $value[2] }}
                </td>
                <td class="px-6 py-4">
                    {{ $value[3] }}
                </td>
                <td class="px-6 py-4">
                    {{ number_format($value[4], 2) }}
                </td>
                @foreach ($value[5] as $kunci => $nilai)
                    <td class="px-6 py-4">
                        <?php
                        $data = $persenplo
                            ->where('kdkrsnilai', $value[1])
                            ->where('kdcpmk', explode('_', $kunci)[1])
                            ->first();
                        if ($data != null) {
                            echo '<p style="color: ' . ($data->statuslulus ? 'black' : 'red') . '">' . number_format($nilai, 2) . '</p>';
                        }
                        ?>
                    </td>
                @endforeach
            </tr>
        @endforeach
        {{-- @else
            <tr>
                <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                    {{ $loop->iteration }}
                </td>
                <td class="px-6 py-4">

                </td>
                <td class="px-6 py-4">

                </td>
                <td class="px-6 py-4">

                </td>
                <td class="px-6 py-4">

                </td>
            </tr>
        @endif --}}
    </tbody>
</table>

<div class=" bg-white rounded-sm">
    <div class="flex flex-col py-5 px-4">


        <div class="font-semibold">
            <h3>Legend</h3>
            <h3>*Block Kuning : mahasiswa tidak lulus</h3>
            <h3>*Text Merah : CPMK yang tidak lulus</h3>
        </div>

        {{-- <h3 class="font-medium text-xl mb-0 text-gray-700">Total Mahasiswa Lulus : {{ $nilaiAkhir[4] }}% </h3>

        <h3 class="font-medium text-xl mb-0 text-gray-700">Total Mahasiswa Tidak Lulus : {{ $nilaiAkhir[5] }}%</h3> --}}

    </div>
    <div class="flex flex-col py-5 px-4">
        @foreach ($cpmkfinal as $cpmk)
            <h3 class="font-medium text-xl mb-0 text-gray-700">Total Mahasiswa Lulus CPMK {{ $cpmk['kode_cpmk'] }} =
                {{ $cpmk['lulus'] }} Orang | {{ number_format($cpmk['persentaselulus'], 2) }}%
            </h3>
            <h3 class="font-medium text-xl mb-0 text-gray-700">Total Mahasiswa Tidak Lulus CPMK
                {{ $cpmk['kode_cpmk'] }}
                =
                {{ $cpmk['tidaklulus'] }} Orang | {{ number_format($cpmk['persentasetidaklulus'], 2) }}%
            </h3>
            <br />
            <br />
        @endforeach
    </div>
</div>
@endsection
