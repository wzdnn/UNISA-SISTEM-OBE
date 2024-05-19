@extends('layouts.app')

<br />
@section('body')
    <nav class="flex px-5 py-3 bg-white border shadow-md rounded-lg mb-3 mr-3" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('index.metopen') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                    <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Penilaian
                </a>
            </li>
            <li aria-current="page">

                <a href="{{ route('list.metopen', ['id' => $kelas->gmcid]) }}" class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span
                        class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400 hover:text-blue-600">Detail
                        -
                        {{ $kelas->metode_penilaian ?? '' }} | {{ $kelas->kode_cpmk ?? '' }} |
                        {{ $kelas->matakuliah ?? '' }}
                    </span>
                </a>

            </li>
            <li>
                <div class="flex items-center">

                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">
                        {{ $kelas->keterangan ?? '' }}</span>
                </div>
            </li>
        </ol>
    </nav>


    <br />

    <div class=" bg-white">
        <div class="flex flex-col py-5 px-4">

            <h1 class="font-bold text-2xl mb-0 text-gray-700">{{ $kelas->matakuliah ?? '' }} | {{ $kelas->kelas ?? '' }}
            </h1>
            <h3 class="font-medium text-xl mb-0 text-gray-700">{{ $kelas->keterangan ?? '' }} </h3>
            <h3 class="font-semibold text-l mb-0 text-gray-700">{{ $kelas->kode_cpmk ?? '' }} | {{ $kelas->cpmk ?? '' }}
            </h3>
            <h3 class="font-semibold text-l mb-0 text-gray-700">Bobot CPMK : {{ $kelas->bobot ?? '' }}% </h3>
            <h3 class="font-semibold text-l mb-0 text-gray-700">Batas Nilai : {{ $kelas->batas_nilai ?? '' }} </h3>
        </div>

        <div class="flex justify-between space-x-1">
            <div class="flex space-x-1">
                <a href="{{ route('export.nilai', ['id' => $id, 'kdtahunakademik' => $kdtahunakademik]) }}">
                    <button
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center ml-3 px-2 py-2 text-center ">Cetak
                        Excel</button>

                </a>

                <div>

                    <form action="{{ route('import.nilai', ['id' => $id, 'kdtahunakademik' => $kdtahunakademik]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="rounded-lg px-2 ">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center ml-3 px-2 py-2 text-center">Submit
                            Excel</button>
                    </form>
                </div>
            </div>

            <div class="px-3">
                <form action="{{ route('rubik.post', ['id' => $id, 'kdtahunakademik' => $kdtahunakademik]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="rounded-lg px-2" accept="application/pdf" />
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center ml-3 px-2 py-2 text-center">
                        Submit Rubrik
                    </button>
                </form>
            </div>
        </div>

        <table class="w-full text-sm text-center text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr class="text-left">
                    <th scope="col" class="px-6 py-3">File Rubrik</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rubik as $item)
                    <tr class="text-left">
                        <td class="pl-4">{{ $item->file }}</td>
                        <td class="pl-2"><a href="{{ asset('storage/rubik') . '/' . $item->folder . '/' . $item->file }}"
                                target="__blank">
                                <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center ml-3 px-2 py-2 text-center">View</button></a>

                            <a
                                href="{{ route('rubik.delete', ['id' => $id, 'kdtahunakademik' => $kdtahunakademik, 'file_id' => $item->id]) }}"><button
                                    type="submit"
                                    class="text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center ml-3 px-2 py-2 text-center">Delete</button></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>

    <table class="w-full text-sm text-center  text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
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
                    Nilai
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penilaian as $key => $value)
                <tr class="bg-white border-b text-left shadow">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{-- {{ ($penilaian->currentPage() - 1) * $penilaian->perPage() + $key + 1 }} --}}
                        {{ $loop->iteration }}
                        {{-- {{ $value->kdpen }} --}}
                    </td>
                    <td class="px-6 py-4">
                        {{ $value->nim }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $value->namalengkap }}
                    </td>
                    <td class="px-6 py-4 flex flex-row">

                        <input type="text" id="nilai" name="nilai"
                            class="block w-10 p-2 text-center text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500"
                            disabled value="{{ $value->apnilai }}">

                        <button data-modal-target="popup-modal" id="btnTambah" data-modal-toggle="popup-modal"
                            class="ml-2" data-id-target="{{ $value->kdpen }}" type="button">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
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
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-3 text-center justify-center items-center">

                                            <form action="" method="POST">
                                                @csrf
                                                <input type="hidden" name="kdpenilaian" id="input-id">
                                                <div class="flex flex-col py-4">
                                                    <label for="nilai"
                                                        class="block mb-2 text-sm font-medium py-1 text-gray-900 ">Nilai</label>
                                                    <input type="text" id="nilai" name="nilai"
                                                        aria-describedby="nilai-explanation"
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
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection

@push('script')
    <script>
        const btnTambah = document.querySelectorAll("#btnTambah");
        btnTambah.forEach(e => {
            e.addEventListener("click", () => {
                console.log(e.getAttribute('data-id-target'));
                const inputTarget = document.getElementById('input-id');
                inputTarget.value = e.getAttribute('data-id-target');
            })
        });
    </script>
@endpush
