@extends('layouts.app')

@push('style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

<br>

@section('body')
    @include('include.flash-massage')
    <!-- Breadcrumb -->
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

            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Tambah Timeline
                        {{ $matakuliah->kodematakuliah }} {{ $matakuliah->matakuliah }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="text-center py-2">
        <h1 class="font-bold text-2xl mb-0">Tambah Timeline Pembelajaran Mingguan</h1>
    </div>

    <div class="my-3 mx-auto max-w-4xl">
        <div class="px-3 bg-white border border-gray-200 rounded shadow-lg justify-between">
            <form class="py-3" action="{{ route('timeline.store', ['id' => $matakuliah->kdmatakuliah]) }}" method="POST">
                @csrf
                <div class="grid md:grid-cols-2 md:gap-6 my-2">
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="mingguke" id="mingguke"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " value="{{ old('mingguke') }}" />
                        <label for="mingguke"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Minggu
                            ke- (Pertemuan ke-)</label>

                    </div>
                    <div class="flex flex-col z-0 w-full mb-6 group">
                        <label for="cpmk" class="text-sm text-gray-500">CPMK</label>
                        <select id="kdcpmk" name="kdcpmk" class="form-control">
                            <option selected>Silahkan Pilih CPMK</option>
                            @foreach ($cpmk as $c)
                                <option value="{{ $c->id }}">{{ $c->kode_cpmk }} {{ $c->cpmk }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="flex flex-col z-0 w-full mb-6 group">
                        <label for="metode_pembelajaran" class="text-sm text-gray-500">Metode Pembelajaran</label>
                        <select id="kdmetopem" name="kdmetopem" class="form-control">
                            <!-- Options will be dynamically loaded here -->
                        </select>
                    </div>
                    <div class="flex flex-col z-0 w-full mb-6 group">
                        <label for="sub_cpmk" class="text-sm text-gray-500">Sub CPMK</label>
                        <select id="kdsubcpmk" name="kdsubcpmk" class="form-control">
                            <!-- Options will be dynamically loaded here -->
                        </select>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="flex flex-col z-0 w-full mb-6 group">
                        <label for="materi" class="text-sm text-gray-500">Materi</label>
                        <select id="kdmateri" name="kdmateri" class="form-control">
                            @foreach ($materi as $m)
                                <option value="{{ $m->kdmateri }}">{{ $m->kode_subbk }} {{ $m->materi_pembelajaran }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class=" flex flex-col z-0 w-full mb-6 group">
                        <label for="tahunakademik" class="text-sm text-gray-500">
                            Tahun Akademik
                        </label>
                        <select id="tahunakademik" name="tahunakademik" class="form-control">
                            @foreach ($tahunAkademik as $ta)
                                <option value="{{ $ta->kdtahunakademik }}">{{ $ta->tahunakademik }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                </div>

                <div class="grid md:grid-cols-2 md:gap-6">

                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="keterangan" id="keterangan"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " value="{{ old('keterangan') }}" />
                        <label for="keterangan"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Keterangan</label>
                    </div>

                    <div class="flex flex-col z-0 w-full mb-6 group">
                        <label for="jeniskuliah" class="text-sm text-gray-500">
                            Bentuk Pembelajaran
                        </label>
                        <select id="kdjeniskuliah" name="kdjeniskuliah" class="form-control">
                            @foreach ($jeniskuliah as $jeniskuliahs)
                                <option value="{{ $jeniskuliahs->kdjeniskuliah }}"> {{ $jeniskuliahs->jeniskuliah }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <input type="text" hidden value="{{ $matakuliah->kdmatakuliah }}" name="kdmatakuliah"
                        id="kdmatakuliah" />

                </div>
                <hr />
                <div>
                    <div class="px-3 py-3">
                        <label for="dosenkelas"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tambah Dosen
                        </label>
                        <button type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 mb-3 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            id="btnTambahDosen"><i class="fa fa-plus" aria-hidden="true"></i></button>
                        <div class="targetDosen"></div>
                    </div>
                </div>

                <div class="flex justify-center">
                    <button type="submit"
                        class="flex items-center justify-center mx-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5">
                        <span class="mr-2 font-medium">Submit</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        let kelasData = @json($kelas);
        let dosenData = @json($dosen);

        const btnTambahDosen = document.getElementById('btnTambahDosen')
        const targetDosen = document.querySelector('.targetDosen')

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

        // Function to populate the select options
        function populateSelectOptions(data, defaultOption, type) {
            const options = [ml('option', {
                value: ''
            }, defaultOption)]; // Add a default option

            data.forEach(item => {
                if (type === 'kelas') {
                    options.push(ml('option', {
                        value: item.kdkelas
                    }, item.kelas));
                } else if (type === 'dosen') {
                    let dosenName = `${item.gelardepan || ''} ${item.namalengkap} ${item.gelarbelakang || ''}`
                        .trim();
                    options.push(ml('option', {
                        value: item.kdper
                    }, dosenName));
                }
            });

            return options;
        }

        // Add a new input field dynamically with searchable Dosen select
        btnTambahDosen.addEventListener('click', () => {
            let container = ml('div', {
                class: 'form-input'
            }, [
                // Dosen Label and Select
                ml('div', {
                    class: 'mb-3'
                }, [
                    ml('label', {
                        for: 'dosen-select',
                        class: 'block mb-2 text-sm font-medium text-gray-900 dark:text-white'
                    }, 'Dosen'), // Dosen Label
                    ml('select', {
                        class: 'dosen-select bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5',
                        name: 'dosen[]',
                        id: 'dosen-select'
                    }, populateSelectOptions(dosenData, 'Select Dosen', 'dosen'))
                ]),

                // Kelas Label and Select
                ml('div', {
                    class: 'mb-3'
                }, [
                    ml('label', {
                        for: 'kelas-select',
                        class: 'block mb-2 text-sm font-medium text-gray-900 dark:text-white'
                    }, 'Kelas'), // Kelas Label
                    ml('select', {
                        class: 'kelas-select bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5',
                        name: 'kelas[]',
                        id: 'kelas-select'
                    }, populateSelectOptions(kelasData, 'Select Kelas', 'kelas'))
                ])
            ]);

            const btnDelete = document.createElement('button');
            btnDelete.setAttribute('type', 'button');
            btnDelete.setAttribute('class',
                'text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1 mt-3 mb-3 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800'
            );
            btnDelete.innerHTML = '<i class="fa fa-trash" aria-hidden="true"></i>';
            btnDelete.addEventListener('click', () => {
                btnDelete.parentElement.remove();
            });

            container.append(btnDelete);
            targetDosen.append(container);

            // Initialize Select2 for the Dosen dropdown
            $('.dosen-select').select2({
                placeholder: 'Silahkan Pilih Dosen',
                allowClear: true
            });
            $('.kelas-select').select2({
                placeholder: 'Silahkan Pilih Kelas',
                allowClear: true
            });
        });
        console.log(kelasData);
        console.log(dosenData);
    </script>

    <script>
        $(document).ready(function() {
            $('#kdmateri').select2();
            $('#kdcpmk').select2();
            $('#kdjeniskuliah').select2();
            $('#kdperson').select2();
            $('#kdmetopem').select2();
            $('#kdsubcpmk').select2();
            $('#tahunakademik').select2();

            $('#kdcpmk').on("select2:select", function() {
                var cpmk_id = $(this).val();

                $.ajax({
                    url: '{{ url('/get-metodepembelajaran') }}/' + cpmk_id,
                    type: 'GET',
                    success: function(data) {
                        console.log(data); // For debugging

                        var metodePembelajaranDropdown = $('#kdmetopem');
                        metodePembelajaranDropdown.empty(); // Clear existing options

                        var uniqueOptions = new Set(); // To track unique options

                        $.each(data, function(key, value) {
                            if (!uniqueOptions.has(value
                                    .kdmetodepembelajaran
                                )) { // Check if option is unique
                                metodePembelajaranDropdown.append(
                                    '<option value="' +
                                    value.kdmetodepembelajaran + '">' +
                                    value.metodepembelajaran +
                                    '</option>');
                                uniqueOptions.add(value
                                    .kdmetodepembelajaran); // Mark option as added
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ', status, error);
                    }
                });

                $.ajax({
                    url: '{{ url('/get-subcpmk') }}/' + cpmk_id,
                    type: 'GET',
                    success: function(data) {
                        console.log(data); // For debugging

                        var subCpmkDropodown = $('#kdsubcpmk');
                        subCpmkDropodown.empty(); // Clear existing options

                        var uniqueOptions = new Set(); // To track unique options

                        $.each(data, function(key, value) {
                            if (!uniqueOptions.has(value
                                    .kdsubcpmk)) { // Check if option is unique
                                subCpmkDropodown.append(
                                    '<option value="' + value.kdsubcpmk + '">' +
                                    value.sub_cpmk + '</option>');
                                uniqueOptions.add(value
                                    .kdsubcpmk); // Mark option as added
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ', status, error);
                    }
                });
            });
        });
    </script>
@endpush
