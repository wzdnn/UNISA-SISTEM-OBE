@extends('layouts.app')

@section('body')
<div class="flex items-center justify-between py-5 px-5 mx-10">
    <h1 class="font-bold text-2xl mb-0 text-blue-800">Visi dan Misi Universitas 'Aisyiyah Yogyakarta Tahun 2023</h1>
</div>
<hr />

<div class="relative py-3">
    <div id="accordion-color" data-accordion="collapse"
        data-active-classes="bg-blue-100 dark:bg-gray-800 text-blue-800 dark:text-white">
        <h2 id="accordion-color-heading-1">
            <button type="button"
                class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700  hover:bg-blue-100 dark:hover:bg-gray-800"
                data-accordion-target="#accordion-color-body-1" aria-expanded="true"
                aria-controls="accordion-color-body-1">
                <span>Visi</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5 5 1 1 5" />
                </svg>
            </button>
        </h2>
        <div id="accordion-color-body-1" class="hidden" aria-labelledby="accordion-color-heading-1">
            <div class="p-5 border border-b-0 border-gray-200 ">
                @foreach ( $vm as $visi )
                <p class="mb-2 font-bold text-gray-700 ">
                    &#x2022; {{ $visi->Visi }}
                </p>
                @endforeach
            </div>
        </div>
        <h2 id="accordion-color-heading-2">
            <button type="button"
                class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700  hover:bg-blue-100 dark:hover:bg-gray-800"
                data-accordion-target="#accordion-color-body-2" aria-expanded="false"
                aria-controls="accordion-color-body-2">
                <span>Misi</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5 5 1 1 5" />
                </svg>
            </button>
        </h2>
        <div id="accordion-color-body-2" class="hidden" aria-labelledby="accordion-color-heading-2">
            <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                @foreach ( $misi as $misi )
                <p class="mb-2 font-bold text-gray-700  text-justify">&#x2022; {{ $misi->Misi }}</p>
                @endforeach
            </div>
        </div>
        <h2 id="accordion-color-heading-3">
            <button type="button"
                class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-gray-200 focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700  hover:bg-blue-100 dark:hover:bg-gray-800"
                data-accordion-target="#accordion-color-body-3" aria-expanded="false"
                aria-controls="accordion-color-body-3">
                <span>Tujuan</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5 5 1 1 5" />
                </svg>
            </button>
        </h2>
        <div id="accordion-color-body-3" class="hidden" aria-labelledby="accordion-color-heading-3">
            <div class="p-5 border border-t-0 border-gray-200 dark:border-gray-700">
                <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                    @foreach ( $tujuan as $tujuan )
                    <p class="mb-2 font-bold text-gray-700  text-justify">&#x2022; {{ $tujuan->Tujuan }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection