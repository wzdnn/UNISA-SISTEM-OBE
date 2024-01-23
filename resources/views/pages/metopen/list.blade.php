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
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Detail -
                        {{ $list->metode_penilaian ?? '' }} | {{ $list->kode_cpmk ?? '' }} | {{ $list->matakuliah ?? '' }}
                    </span>
                </div>
            </li>
        </ol>
    </nav>


    <br />


    {{-- @if ($listNilai)
        <div class="flex flex-col py-5">
            <h1 class="font-bold text-2xl mb-0 ">{{ $listNilai }} | urutan</h1>
            <h3 class="font-medium text-xl mb-0 text-gray-500">{{ $listNilai }} </h3>
            <h3 class="font-semibold text-l mb-0">Bobot CPMK : {{ $listNilai }}%</h3>
        </div>
    @endif --}}
    <table class="w-full text-sm text-center  text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr class="text-left">
                <th scope="col" class="px-6 py-3 w-[50px]">
                    No.
                </th>
                <th scope="col" class="px-6 py-3 ">
                    Keterangan
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listNilai as $key => $value)
                <tr class="bg-white border-b text-left shadow hover:bg-gray-100">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ ($listNilai->currentPage() - 1) * $listNilai->perPage() + $key + 1 }}
                    </td>
                    <td class="px-6 py-4 ">
                        <a href="{{ route('index.penilaian', ['id' => $value->kjn]) }}" class="hover:bg-gray-100">
                            {{ $value->keterangan }}
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <button data-modal-target="popup-modal" id="btnTambah" data-modal-toggle="popup-modal"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            data-id-target="{{ $value->kjn }}" type="button">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            {{-- Isi Penilaian --}}
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
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-4">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg dark:bg-gray-700">
                                                <h1 class="font-bold text-2xl mb-0">Penilaian</h1>
                                                <!-- Modal body -->
                                                <form action="{{ route('copy.mhs', ['id' => $value->kjn]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="flex flex-col py-4">
                                                        <input type="hidden" name="kdmatakuliah_" id="kdmatakuliah_"
                                                            value="{{ $value->mkd }}">
                                                        <input type="hidden" name="kdjenisnilai_" id="kdjenisnilai_"
                                                            value="{{ $value->kjn }}">
                                                    </div>
                                                    <div class="flex flex-col z-0 w-full mb-6 group">
                                                        <label for="unit" class="text-sm text-gray-500">
                                                            Kelas
                                                        </label>

                                                        <select id="kelas_" name="kelas_" data-live-search="true"
                                                            class="form-control rounded">
                                                            <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="C">C</option>
                                                            <option value="K">K</option>
                                                        </select>
                                                    </div>
                                                    <div class="flex flex-col z-0 w-full mb-6 group">
                                                        <label for="unit" class="text-sm text-gray-500">
                                                            Tahun Akademik
                                                        </label>
                                                        <select id="kdtahunakademik_" name="kdtahunakademik_"
                                                            class="form-control rounded">
                                                            @foreach ($tahunAkademik as $tahunakademik)
                                                                <option value="{{ $tahunakademik->kdtahunakademik }}">
                                                                    {{ $tahunakademik->tahunakademik }}</option>
                                                            @endforeach
                                                        </select>
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
                        </div>
                        </div>
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
                const inputTarget = document.getElementById('kdjenisnilai_');
                inputTarget.value = e.getAttribute('data-id-target');
            })
        });
    </script>
@endpush
