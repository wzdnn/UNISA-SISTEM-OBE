@extends('layouts.app')
<br>
@push('style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@section('body')
    <nav class="flex px-5 py-3 bg-white shadow-md mb-3" aria-label="Breadcrumb">
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
                    <a href="{{ route('detail.mk', ['id' => $id]) }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 ">Detail
                        {{ $mkSubBk->kodematakuliah }}</a>
                </div>
            </li>

            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="{{ route('subbk.cpmk', ['id' => $id, 'sub' => $sub]) }}"
                        class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400 hover:text-blue-600">Detail
                        {{ $subbk->subbk->kode_subbk }} {{ $subbk->subbk->sub_bk }}</a>
                </div>
            </li>

            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400 ">Detail
                        {{ $detailCpmk->kode_cpmk }} </span>
                </div>
            </li>

        </ol>
    </nav>

    <div class="flex flex-col space-y-2">
        <h1 class="font-bold text-2xl mb-0 text-blue-800">Detail CPMK</h1>
        <div class="flex flex-row space-x-3 font-bold">
            <p>{{ $detailCpmk->kode_cpmk }}</p>
            <p>:</p>
            <p> {{ $detailCpmk->cpmk }}</p>
        </div>
    </div>

    <br />
    <hr />

    <div class="py-2">
        <div class="my-3 mr-3">
            <div class="w-auto px-3 bg-white border border-gray-200 rounded shadow-lg justify-between">
                <div class="px-3 py-3">
                    <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Kelola Metode Pembelajaran</h1>
                    @include('include.flash-massage')

                    <form action="" method="post">
                        @csrf
                        <select class="w-auto" id="pembelajaranSelect" name="pembelajaranSelect[]" multiple="multiple">
                            @foreach ($pembelajaran as $item)
                                <option value="{{ $item->id }}" @selected(in_array($item->id, $id_pembelajaran))>
                                    {{ $item->metodepembelajaran }}
                                </option>
                            @endforeach
                        </select>
                        <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                            type="submit">UPDATE</button>
                    </form>

                </div>
                <div>
                    <h1 class="font-semibold px-6 py-4">Metode Pembelajaran</h1>
                    <table class="w-auto text-sm text-center ">
                        <tbody>
                            @if ($cpmk->count() > 0)
                                @foreach ($cpmk->pembelajaran as $row)
                                    <tr class="text-left">
                                        <td scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 font-bold">
                                            {{ $row->metodepembelajaran }}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="justify-center text-center" colspan="2">Data belum ada</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="">

    </div>
    <div class="">

    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#pembelajaranSelect').select2();
        });
    </script>
@endpush
