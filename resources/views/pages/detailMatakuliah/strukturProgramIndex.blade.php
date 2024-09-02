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
                <a href="{{ route('sp.index') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                    <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Struktur Program
                </a>
            </li>


        </ol>
    </nav>

    <div class="bg-white rounded px-4 py-2">

        <div class="flex justify-between px-2 pt-5">
            {{-- Filter Tahun Akademik --}}
            <div class="flex flex-col">
                <form method="GET" class="rounded">
                    <select name="filter-tahun" id="" class="rounded">
                        <option value="null">Tahun Akademik</option>
                        @foreach ($tahunAkademik as $item)
                            <option value="{{ $item->kdtahunakademik }}" @selected(request()->filter == $item->kdtahunakademik)>
                                {{ $item->tahunakademik }}
                            </option>
                        @endforeach
                    </select>

                    <select name="filter-kurikulum" id="" class="rounded">
                        <option value="null">Kurikulum</option>
                        @foreach ($kurikulum as $item)
                            <option value="{{ $item->kdkurikulum }}" @selected(request()->filter == $item->kdkurikulum)>
                                {{ $item->kurikulum }} {{ $item->tahun }}
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
        </div>
        <div class="flex justify-start px-2 pt-5">
            <a href="{{ route('sp.create') }}">
                <button
                    class="flex items-center bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1">Tambah
                    Struktur Program</button>
            </a>
        </div>
    </div>

    <div class="my-1 w-full mx-auto rounded">
        <table class="w-full text-sm rounded text-gray-500" id="mytable" name="mytable" style="border: 1 !important">
            <thead class="text-xs text-gray-700 uppercase bg-white">
                <tr class="text-left">
                    <th scope="col" class="px-6 py-3 ">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Kode Matakuliah
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Matakuliah
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Sks
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Teori(KT)
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Jumlah Pertemuan
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Tutorial
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Jumlah Pertemuan
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Seminar(S)
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Jumlah Pertemuan
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Praktikum(P)
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Jumlah Pertemuan
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Praktik(Pr)
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Jumlah Pertemuan
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Belajar Mandiri (BL)
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Jumlah Pertemuan
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Skill Lab (SL)
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Jumlah Pertemuan
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Studio(st)
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Jumlah Pertemuan
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        NIDN/NIDK Dosen Utama
                    </th>
                    <th scope="col" class="px-6 py-3 w-auto">
                        Dosen Utama
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        NIDN/NIDK Dosen Pelaporan
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Dosen Pelaporan PDDIKTI *
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Keterangan
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        TahunAkademik
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Kurikulum
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($strukturprogram->count() > 0)
                    @foreach ($strukturprogram as $key => $s)
                        <tr class=" border-b text-left {{ $key % 2 == 0 ? 'bg-gray-100' : 'bg-gray-50' }}">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $s->kodematakuliah }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $s->matakuliah }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $s->sks }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $s->teori }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $s->pertemuan_kt }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $s->tutorial }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $s->pertemuan_kp }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $s->seminar }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $s->pertemuan_s }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $s->praktikum }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $s->pertemuan_p }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $s->praktik }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $s->pertemuan_pr }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $s->belajar_mandiri }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $s->pertemuan_bm }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $s->skill_lab }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $s->pertemuan_sl }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $s->studio }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $s->pertemuan_studio }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @foreach ($s->struktur_utama as $su)
                                    <p>
                                        &#8226; {{ $su->person_utama[0]->utama_dosen[0]->nidn }}
                                    </p>
                                    </br>
                                @endforeach

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @foreach ($s->struktur_utama as $su)
                                    <p>
                                        &#8226; {{ $su->namalengkap }} {{ $su->gelarbelakang }}
                                    </p>
                                    </br>
                                @endforeach
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @foreach ($s->struktur_pelaporan as $sp)
                                    <p> &#8226; {{ $sp->person_pelaporan[0]->pelaporan_dosen[0]->nidn }}</p> </br>
                                @endforeach
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @foreach ($s->struktur_pelaporan as $sp)
                                    <p>
                                        &#8226; {{ $sp->namalengkap }} {{ $sp->gelarbelakang }}
                                    </p>
                                    </br>
                                @endforeach
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $s->ket }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $s->tahunakademik }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $s->kurikulum }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-row space-x-1">

                                    <a href="{{ route('sp.delete', ['id' => $s->kdstrukturprogram]) }}"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data?');">
                                        <button
                                            class="bg-red-600 hover:bg-red-800 text-white rounded px-2 text-md font-semibold p-1">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </a>

                                    <a href="{{ route('sp.edit', ['id' => $s->kdstrukturprogram]) }}">
                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1">
                                            <i class="fa-solid fa-edit"></i>
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="justify-center text-center" colspan="20">Data belum ada</td>
                    </tr>
                @endif

            </tbody>
        </table>
        {{ $strukturprogram->links() }}
        </hr>
    </div>
@endsection
