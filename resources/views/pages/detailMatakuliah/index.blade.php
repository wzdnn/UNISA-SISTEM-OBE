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
                    <p class="ml-1 text-sm font-medium text-gray-700 md:ml-2 ">Detail
                        Matakuliah</p>
                </div>
            </li>

        </ol>
    </nav>



    <div class="text-center">
        <h1 class="font-bold text-2xl mb-0 text-dark-700">Tambah Detail Pada Matakuliah
            {{ $matakuliah->matakuliah }}</h1>
    </div>

    <div class="my-3 mx-auto max-w-4xl">
        <div class=" px-3 bg-white border border-gray-200 rounded-lg shadow-lg justify-between">
            <div class="px-3 py-3 mt-3">

                <div class="flex flex-col">
                    <form method="GET" class="rounded">
                        @csrf
                        <select name="filter" id="">
                            @foreach ($filter['filter'] as $item)
                                <option value="{{ $item }}" @selected($item == $filter['latest'])>{{ $item }}
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

                <form action="{{ route('detail.store', ['id' => $matakuliah->kdmatakuliah]) }}" method="POST">
                    @csrf

                    <input type="hidden" name="filter-form" value="<?= $request->get('filter') ?>">



                    <div>
                        <div class="grid">
                            <div class="relative z-0 px-3 py-3">
                                <label for="akses_media" class="block mb-2 text-lg font-bold text-gray-900 uppercase">Akses
                                    Media</label>
                                <input type="text" name="akses_media" id="akses_media"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder=" " value="{{ $akses->linkakses ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="grid">
                            <div class="relative z-0 px-3">
                                <label for=""
                                    class="block mb-2 text-sm font-bold text-gray-900 uppercase">Pengalaman
                                    Belajar Mahasiswa</label>
                            </div>
                            <div class="relative z-0 px-3">
                                <label for=""
                                    class="block mb-2 text-sm font-medium text-gray-900 uppercase">Sinkron</label>
                                <select class="w-auto" id="pengalamanSelectSinkron" name="pengalamanSelectSinkron[]"
                                    multiple="multiple">
                                    @foreach ($mkPengalaman as $item)
                                        <option value="{{ $item->id }}" @selected(in_array($item->id, $id_pengalamanSinkron))>
                                            {{ $item->pengalaman_mahasiswa }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="relative z-0 px-3 py-1">
                                <label for=""
                                    class="block mb-2 py-1 text-sm font-medium text-gray-900 uppercase">Asinkron</label>

                                <select class="w-auto" id="pengalamanSelectAsinkron" name="pengalamanSelectAsinkron[]"
                                    multiple="multiple">
                                    @foreach ($mkPengalaman as $item)
                                        <option value="{{ $item->id }}" @selected(in_array($item->id, $id_pengalamanAsinkron))>
                                            {{ $item->pengalaman_mahasiswa }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="px-3 py-3 font-bold text-lg">Tambah Referensi Pada Matakuliah</h3>
                        <div class="bg-gray-50 rounded-lg">
                            <div class="px-3 py-3">
                                <h3 class="font-medium text-lg mb-3">Utama</h3>

                                <label for="referensi_utama"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Referensi
                                    Utama</label>
                                <button type="button"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 mb-3 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                    id="btnTambahReferensi"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                <div class="targetReferensiUtama"></div>
                            </div>
                            <div class="px-3 py-3">
                                <h3 class="font-medium text-lg mb-3">Tambahan</h3>

                                <label for="referensi_tambahan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Referensi
                                    Tambahan</label>
                                <button type="button"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 mb-3 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                    id="btnTambahReferensiTambahan"><i class="fa fa-plus"
                                        aria-hidden="true"></i></button>
                                <div class="targetReferensiTambahan "></div>
                            </div>
                            <div class="px-3 py-3">
                                <h3 class="font-medium text-lg mb-3">Luaran</h3>
                                <label for="referensi_luaran"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Referensi
                                    Tambahan</label>
                                <button type="button"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 mb-3 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                    id="btnTambahReferensiLuaran"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                <div class="targetReferensiLuaran"></div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center mt-3">
                        <button
                            class="flex items-center bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-sm font-semibold p-2"
                            type="submit">
                            SUBMIT
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const btnTambahReferensi = document.getElementById('btnTambahReferensi')
        const targetReferensiUtama = document.querySelector('.targetReferensiUtama')
        const btnCancel = document.getElementById('cancel')

        function ml(tagName, props, nest) {
            var el = document.createElement(tagName);
            if (props) {
                for (var name in props) {
                    if (name.indexOf("on") === 0) {
                        el.addEventListener(name.substr(2).toLowerCase(), props[name], false)
                    } else {
                        el.setAttribute(name, props[name]);
                    }
                }
            }
            if (!nest) {
                return el;
            }
            return nester(el, nest)
        }

        function nester(el, n) {
            if (typeof n === "string") {
                var t = document.createTextNode(n);
                el.appendChild(t);
            } else if (n instanceof Array) {
                for (var i = 0; i < n.length; i++) {
                    if (typeof n[i] === "string") {
                        var t = document.createTextNode(n[i]);
                        el.appendChild(t);
                    } else if (n[i] instanceof Node) {
                        el.appendChild(n[i]);
                    }
                }
            } else if (n instanceof Node) {
                el.appendChild(n)
            }
            return el;
        }

        // utama
        btnTambahReferensi.addEventListener('click', () => {
            let container = ml('div', {
                class: 'form-input'
            }, [
                ml('input', {
                    type: 'text',
                    class: 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5',
                    placeholder: 'Referensi Utama',
                    name: 'referensi_utama[]'
                }, ),
            ])

            const btnDelete = document.createElement('button')
            btnDelete.setAttribute('type', 'button')
            btnDelete.setAttribute('class',
                'text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1 mt-3 mb-3 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800'
            )
            btnDelete.innerHTML = '<i class="fa fa-trash" aria-hidden="true"></i>'
            btnDelete.addEventListener('click', () => {
                btnDelete.parentElement.remove()
            })

            container.append(btnDelete)
            targetReferensiUtama.append(container)
        })

        // tambahan
        const btnTambahReferensiTambahan = document.getElementById('btnTambahReferensiTambahan')
        const targetReferensiTambahan = document.querySelector('.targetReferensiTambahan')
        btnTambahReferensiTambahan.addEventListener('click', () => {
            let container = ml('div', {
                class: 'form-input'
            }, [
                ml('input', {
                    type: 'text',
                    class: 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5',
                    placeholder: 'Referensi Tambahan',
                    name: 'referensi_tambahan[]'
                }, ),
            ])

            const btnDelete = document.createElement('button')
            btnDelete.setAttribute('type', 'button')
            btnDelete.setAttribute('class',
                'text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1 mt-3 mb-3 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800'
            )
            btnDelete.innerHTML = '<i class="fa fa-trash" aria-hidden="true"></i>'
            btnDelete.addEventListener('click', () => {
                btnDelete.parentElement.remove()
            })

            container.append(btnDelete)
            targetReferensiTambahan.append(container)
        })


        // Luaran
        const btnTambahReferensiLuaran = document.getElementById('btnTambahReferensiLuaran')
        const targetReferensiLuaran = document.querySelector('.targetReferensiLuaran')
        btnTambahReferensiLuaran.addEventListener('click', () => {
            let container = ml('div', {
                class: 'form-input'
            }, [
                ml('input', {
                    type: 'text',
                    class: 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5',
                    placeholder: 'Referensi Luaran',
                    name: 'referensi_luaran[]'
                }, ),
            ])

            const btnDelete = document.createElement('button')
            btnDelete.setAttribute('type', 'button')
            btnDelete.setAttribute('class',
                'text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1 mt-3 mb-3 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800'
            )
            btnDelete.innerHTML = '<i class="fa fa-trash" aria-hidden="true"></i>'
            btnDelete.addEventListener('click', () => {
                btnDelete.parentElement.remove()
            })

            container.append(btnDelete)
            targetReferensiLuaran.append(container)
        })
    </script>

    {{-- select2 --}}
    <script>
        $(document).ready(function() {
            $('#pengalamanSelectSinkron').select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#pengalamanSelectAsinkron').select2();
        });
    </script>
@endpush
