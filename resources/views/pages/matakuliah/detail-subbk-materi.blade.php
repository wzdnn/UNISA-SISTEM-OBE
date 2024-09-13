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
                    <a href="{{ route('detail.mk', ['id' => $mkSubBk->kdmatakuliah]) }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 ">Detail
                        {{ $mkSubBk->kodematakuliah }} {{ $mkSubBk->matakuliah }}</a>
                </div>
            </li>

            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="{{ route('subbk.cpmk', ['id' => $detail->kdmatakuliah, 'sub' => $detail->id]) }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 ">Detail
                        {{ $detail->subbk->kode_subbk }} {{ $detail->subbk->sub_bk }}</a>
                </div>
            </li>

            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2 ">Detail
                        {{ $subbk->materi_pembelajaran }}<span>
                </div>
            </li>

        </ol>
    </nav>




    <div class="py-2">
        @include('include.flash-massage')
        <div class="my-3 mr-3">
            <div class="w-auto px-3 bg-white border border-gray-200 rounded shadow-sm justify-between mb-3">
                <div class="flex flex-col space-y-2 py-2">
                    <h1 class="font-bold text-2xl mb-0 text-blue-800">Detail Materi Sub BK</h1>
                    <div class="flex flex-row space-x-3 font-bold">
                        <p>Sub BK</p>
                        <p>:</p>
                        <p>{{ $detail->subbk->kode_subbk }} {{ $detail->subbk->sub_bk }}</p>
                    </div>
                </div>
                <div class="flex py-2">
                    <h2 class="font-bold text-md">
                        Total Menit Terakumulasi Dalam Materi ini: <span id="total_materi"></span>
                    </h2>
                </div>
                <div class="flex py-2">
                    <h2 class="font-bold text-md">
                        Total Menit Terakumulasi Dalam Satu Matakuliah: <span
                            id="total_terakumulasi">{{ $totalAccumulatedTime }}</span> /
                        {{ $total_waktu }}
                    </h2>
                </div>

            </div>


            <div class="w-auto px-3 bg-white border border-gray-200 rounded shadow-lg justify-between">
                <form action="" method="post" class="mb-5">
                    @csrf
                    <table class="w-screen text-sm  text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase">
                        </thead>
                    </table>

                    <div class="py-3 mt-4">
                        <div class="relative z-0  mb-6 group">
                            <input type="text" name="materi_pembelajaran" id="materi_pembelajaran"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ $subbk->materi_pembelajaran }}" />
                            <label for="materi_pembelajaran"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Materi
                                Pembelajaran</label>
                        </div>
                        <div class="relative z-0  mb-6 group">
                            <input type="number" name="kuliah" id="kuliah"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ $subbk->kuliah }}" />
                            <label for="kuliah"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Kuliah(menit)</label>
                        </div>
                        <div class="relative z-0  mb-6 group">
                            <input type="number" name="tutorial" id="tutorial"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ old('tutorial') ?? $subbk->tutorial }}" />
                            <label for="tutorial"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tutorial(menit)</label>
                        </div>
                        <div class="relative z-0  mb-6 group">
                            <input type="number" name="seminar" id="seminar"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ old('seminar') ?? $subbk->seminar }}" />
                            <label for="seminar"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Seminar(menit)</label>
                        </div>
                        <div class="relative z-0  mb-6 group">
                            <input type="text" name="praktikum" id="praktikum"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ old('praktikum') ?? $subbk->praktikum }}" />
                            <label for="praktikum"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Praktikum(menit)</label>
                        </div>
                        <div class="relative z-0  mb-6 group">
                            <input type="text" name="skill_lab" id="skill_lab"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ old('skill_lab') ?? $subbk->skill_lab }}" />
                            <label for="skill_lab"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Skill
                                Lab(menit)</label>
                        </div>
                        <div class="relative z-0  mb-6 group">
                            <input type="text" name="field_lab" id="field_lab"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ old('field_lab') ?? $subbk->field_lab }}" />
                            <label for="field_lab"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Field
                                Lab(menit)</label>
                        </div>
                        <div class="relative z-0  mb-6 group">
                            <input type="text" name="praktik" id="praktik"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ old('praktik') ?? $subbk->praktik }}" />
                            <label for="praktik"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Praktik(menit)</label>
                        </div>
                        <div class="relative z-0  mb-6 group">
                            <input type="text" name="penugasan" id="penugasan"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ old('penugasan') ?? $subbk->penugasan }}" />
                            <label for="penugasan"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Penugasan(menit)</label>
                        </div>
                        <div class="relative z-0  mb-6 group">
                            <input type="text" name="belajar_mandiri" id="belajar_mandiri"
                                class="block py-2.5 px-0  text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ old('belajar_mandiri') ?? $subbk->belajar_mandiri }}" />
                            <label for="belajar_mandiri"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Belajar
                                Mandiri(menit)</label>
                        </div>
                    </div>

                    <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-2"
                        type="submit">UPDATE</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // Ambil nilai total waktu yang diperbolehkan dan total akumulasi waktu dari backend
        const totalWaktu = {{ $total_waktu }};
        const totalAccumulatedTime = {{ $totalAccumulatedTime }};

        // Fungsi untuk menghitung total waktu input
        function hitungAkumulasiWaktu() {
            // Ambil nilai dari setiap input field
            const kuliah = parseInt(document.getElementById('kuliah').value) || 0;
            const tutorial = parseInt(document.getElementById('tutorial').value) || 0;
            const seminar = parseInt(document.getElementById('seminar').value) || 0;
            const praktikum = parseInt(document.getElementById('praktikum').value) || 0;
            const skillLab = parseInt(document.getElementById('skill_lab').value) || 0;
            const fieldLab = parseInt(document.getElementById('field_lab').value) || 0;
            const praktik = parseInt(document.getElementById('praktik').value) || 0;
            const penugasan = parseInt(document.getElementById('penugasan').value) || 0;
            const belajarMandiri = parseInt(document.getElementById('belajar_mandiri').value) || 0;

            // Hitung total akumulasi dari semua input field
            const totalInput = kuliah + tutorial + seminar + praktikum + skillLab + fieldLab + praktik + penugasan +
                belajarMandiri;

            // Update nilai total terakumulasi dari backend (dari controller)
            const totalAkhir = totalAccumulatedTime; // Menambah input baru dengan total akumulasi sebelumnya
            const totalTerakumulasiElement = document.getElementById('total_terakumulasi');
            const totalMateriElement = document.getElementById('total_materi');

            // Update total input materi yang diakumulasi dari form
            totalMateriElement.innerText = totalInput;

            // Tampilkan hasil akumulasi di elemen yang diinginkan
            totalTerakumulasiElement.innerText = totalAkhir;

            // Cek apakah total akumulasi melebihi total waktu yang diperbolehkan
            if (totalAkhir > totalWaktu) {
                totalTerakumulasiElement.style.color = 'red'; // Ubah warna menjadi merah
            } else {
                totalTerakumulasiElement.style.color = 'black'; // Kembalikan ke warna hitam
            }
        }

        // Tambahkan event listener ke setiap input untuk memantau perubahan
        document.getElementById('kuliah').addEventListener('input', hitungAkumulasiWaktu);
        document.getElementById('tutorial').addEventListener('input', hitungAkumulasiWaktu);
        document.getElementById('seminar').addEventListener('input', hitungAkumulasiWaktu);
        document.getElementById('praktikum').addEventListener('input', hitungAkumulasiWaktu);
        document.getElementById('skill_lab').addEventListener('input', hitungAkumulasiWaktu);
        document.getElementById('field_lab').addEventListener('input', hitungAkumulasiWaktu);
        document.getElementById('praktik').addEventListener('input', hitungAkumulasiWaktu);
        document.getElementById('penugasan').addEventListener('input', hitungAkumulasiWaktu);
        document.getElementById('belajar_mandiri').addEventListener('input', hitungAkumulasiWaktu);

        // Panggil fungsi saat halaman pertama kali dimuat
        hitungAkumulasiWaktu();
    </script>
@endpush
