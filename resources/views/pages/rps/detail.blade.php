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
                    <a href="{{ route('rps.index', ['id' => $matakuliah->kdmatakuliah]) }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 ">RPS -
                        INDEX</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 ">RPS -
                        {{ $matakuliah->matakuliah }} - {{ $tahunAkademik->tahunakademik }} -
                        DETAIL</a>
                </div>
            </li>
        </ol>
    </nav>

    <div class="flex items-center justify-between py-5 px-5">
        <div class="flex items-center">
            <h1 class="font-bold text-2xl mb-0 text-gray-700 text-center">
                RPS - {{ $tahunAkademik->tahunakademik }} - DETAIL </h1>
        </div>
    </div>

    <div class="relative">
        <div class="px-5 ">
            <a href="{{ route('rps.preview', ['id' => $matakuliah->kdmatakuliah, 'semester' => $tahunAkademik->kdtahunakademik]) }}"
                target="_blank">
                <button
                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Preview
                    RPS <i class="fa fa-eye ml-2" aria-hidden="true"></i></button>

            </a>
        </div>
    </div>

    <div class="flex items-center justify-between py-5 px-5">
        <div class="flex items-center">
            <h1 class="font-bold text-2xl mb-0 text-gray-700 text-center">
                File Pendukung RPS</h1>
        </div>
    </div>

    <div class="flex justify-start space-x-1">


        <div class="px-3">
            <form
                action="{{ route('rps.upload', ['id' => $matakuliah->kdmatakuliah, 'semester' => $tahunAkademik->kdtahunakademik]) }}"
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
                <th scope="col" class="px-6 py-3">File</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rubik as $item)
                <tr class="text-left">
                    <td class="pl-4">{{ $item->file }}</td>
                    <td class="pl-2"><a href="{{ asset('storage/rps-rubrik') . '/' . $item->file }}" target="_blank">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center ml-3 px-2 py-2 text-center">View</button></a>

                        <a
                            href="{{ route('rps.delete', ['id' => $matakuliah->kdmatakuliah, 'semester' => $tahunAkademik->kdtahunakademik, 'kdfile' => $item->kdfile]) }}"><button
                                type="submit"
                                class="text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center ml-3 px-2 py-2 text-center">Delete</button></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
