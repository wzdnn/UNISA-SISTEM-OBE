@extends('layouts.app')

@push('style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@section('body')
    <!-- Breadcrumb -->
    <nav class="flex px-5 py-3 bg-white border shadow-md rounded-lg mb-3" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('index.metopen') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                    <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Master Metode Penelitian
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Kelola Metode Penilaian
                    </span>
                </div>
            </li>
        </ol>
    </nav>
    <div class="px-3 py-3">
        <h1 class="font-bold text-2xl mb-4 text-blue-800 uppercase">Kelola Metode Penilaian</h1>
        @include('include.flash-massage')
        <form action="" method="post">
            @csrf

            <select class="w-[41vw]" id="metopenSelect" name="metopenSelect[]" multiple="multiple">
                @foreach ($metopen as $item)
                    <option value="{{ $item->id }}" @selected(in_array($item->id, $metopenSelect))>
                        {{ $item->metode_penilaian }}
                    </option>
                @endforeach
            </select>

            <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 my-3"
                type="submit">UPDATE</button>
        </form>
    </div>



    {{-- <table class="w-screen text-sm text-gray-500">
        <thead class="text-xs text-gray-700 uppercase">
            <tr>
                <th scope="col" class="text-left">
                    @foreach ($mtp as $key => $value)
                        @foreach ($value->GetAllidSubBK as $mksbk)
                            @foreach ($mksbk->cpmks as $cpmk)
                                @foreach ($cpmk->metopens as $cpmks)
                                    @foreach ($cpmks->CPMKtoMTP as $metopens)
                                        <a href="">
                                            <div class="p-3 hover:text-blue-300">
                                                <p class="font-semibold p-2">
                                                    &#x2022; {{ $metopens->metode_penilaian }}
                                                </p>
                                            </div>
                                        </a>
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                </th>
            </tr>
        </thead>
    </table> --}}
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#metopenSelect').select2();
        });
    </script>
@endpush
