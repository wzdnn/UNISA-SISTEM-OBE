<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full bg-[#20CB90] sm:translate-x-0 overflow-y-auto" aria-label="Sidebar">


    <div class="px-6 text-center py-5">
    <a href="{{ route('welcome') }}" class="flex items-center ps-2.5 ">
         <span class="self-center text-xl font-semibold whitespace-nowrap text-[#fff]">Menu</span>
      </a>
    </div>
    <hr/>
    <hr/>

    <div class="h-full px-3 pt-3 pb-4 overflow-y-auto">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('welcome') }}"
                    class="flex items-center p-2 text-[#F4FAF8] hover:text-green-800 rounded-lg  hover:bg-green-300  group">
                    <span class="ml-3 text-md">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('index.VM') }}" class="flex items-center p-2 text-[#F4FAF8] hover:text-green-800 rounded-lg  hover:bg-green-300  group">

                    <span class="ml-3 text-md">Visi dan Misi</span>
                </a>
            </li>
            <li>
                <button type="button" id="dropdownDefaultButton"
                    class="flex items-center w-full p-2 text-base text-[#F4FAF8] hover:text-green-800 transition duration-75 rounded-lg group hover:bg-green-300 text-md"
                    aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                    <span class="flex-1 ml-3 text-left whitespace-nowrap">Bahan Penilaian Lulusan</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                    <ul id="dropdown-example" class="hidden pt-2">
                        <li class="rounded-t bg-green-900 m-0">
                            <a href="{{ route('pl.index') }}"
                                class="flex items-center w-full p-2 text-gray-200 hover:text-green-800 transition duration-75 rounded-t pl-11 group hover:bg-green-300 ">Profile Lulusan</a>
                        </li>
                        <li class=" bg-green-900 m-0">
                            <a href="{{ route('cplr.index') }}"
                                class="flex items-center w-full p-2 text-gray-200 hover:text-green-800 transition duration-75  pl-11 group hover:bg-green-300 ">Referensi Capaian Lulusan</a>
                        </li>
                        <li class="rounded-b bg-green-900 m-0">
                            <a href="{{ route('cpl.index') }}"
                                class="flex items-center w-full p-2 text-gray-200 hover:text-green-800 transition duration-75 rounded-b pl-11 group hover:bg-green-300 ">Capaian Pembelajaran Lulusan</a>
                        </li>
                    </ul>
            </li>
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-[#F4FAF8] hover:text-green-800 transition duration-75 rounded-lg group hover:bg-green-300  "
                    aria-controls="dropdown-list-user" data-collapse-toggle="dropdown-list-user">
                    <span class="flex-1 ml-3 text-left whitespace-nowrap">Bahan Kajian</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-list-user" class="hidden py-2">
                    <li class="rounded-t bg-green-900 m-0">
                        <a href="{{ route('bk.index') }}"
                            class="flex items-center w-full p-2 text-[#F4FAF8] hover:text-green-800 transition duration-75 rounded-t pl-11 group hover:bg-green-300  ">Bahan
                            Kajian</a>
                    </li >
                    <li  class="rounded-b bg-green-900 m-0">
                        <a href="{{ route('sub-bk.index') }}"
                            class="flex items-center w-full p-2 text-[#F4FAF8] hover:text-green-800 transition duration-75 rounded-b pl-11 group hover:bg-green-300  ">Sub-Bahan
                            Kajian</a>
                    </li>
                </ul>
            </li>
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-[#F4FAF8] hover:text-green-800 transition duration-75 rounded-lg group hover:bg-green-300"
                    aria-controls="dropdown-list-cpmk" data-collapse-toggle="dropdown-list-cpmk">
                    <span class="flex-1 ml-3 text-left whitespace-nowrap">CPMK</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-list-cpmk" class="hidden py-2">
                    <li class="rounded-t bg-green-900 m-0">
                        <a href="{{ route('list.cpmk') }}"
                            class="flex items-center w-full p-2 text-[#F4FAF8] hover:text-green-800 transition duration-75 rounded-t pl-11 group hover:bg-green-300 ">List CPMK</a>
                    </li>
                    <li class="rounded-b bg-green-900 m-0">
                        <a href="{{ route('peta.cpmk') }}"
                            class="flex items-center w-full p-2 text-[#F4FAF8] hover:text-green-800 transition duration-75 rounded-b pl-11 group hover:bg-green-300 ">Peta CPL-CPMK</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ route('index.mk') }}"
                    class="flex items-center p-2 text-[#F4FAF8] hover:text-green-800 dark:text-white dark:hover:text-gray-500 rounded-lg  hover:bg-green-300 active:bg-green-300 group">

                    <span class="flex-1 ml-3 whitespace-nowrap">Matakuliah</span>
                </a>
            </li>
            <li>
                <a href="{{ route('organisasi.mk') }}"
                    class="flex items-center p-2 text-[#F4FAF8] hover:text-green-800 dark:text-white dark:hover:text-gray-500 rounded-lg  hover:bg-green-300 active:bg-green-300  group">

                    <span class="flex-1 ml-3 whitespace-nowrap">Organisasi Matakuliah</span>
                </a>
            </li>
            <li>
                <a href="{{ route('index.metopen') }}"
                    class="flex items-center p-2 text-[#F4FAF8] hover:text-green-800 dark:text-white dark:hover:text-gray-500 rounded-lg  hover:bg-green-300  group">

                    <span class="flex-1 ml-3 whitespace-nowrap">Master Metode Penilaian</span>
                </a>
            </li>
        </ul>
        <br/>
        <hr/>
        <hr/>
        <ul class="space-y-2 py-3 font-medium">
            <li>
                <a href="{{ route('index.aspek') }}"
                class="flex items-center p-2 text-[#F4FAF8] hover:text-green-800 rounded-lg  hover:bg-green-300  group">
                    <span class="ml-3">Aspek</span>
                </a>
            </li>
            <li>
                <a href="{{ route('index.sumber') }}"
                    class="flex items-center p-2 text-[#F4FAF8] hover:text-green-800 rounded-lg  hover:bg-green-300  group">
                    <span class="ml-3">Sumber</span>
                </a>
            </li>
            <li>
                <a href="{{ route('index.basil') }}"
                    class="flex items-center p-2 text-[#F4FAF8] hover:text-green-800 rounded-lg  hover:bg-green-300  group">
                    <span class="ml-3">Basis Ilmu</span>
                </a>
            </li>
            <li>
                <a href="{{ route('index.bidil') }}"
                    class="flex items-center p-2 text-[#F4FAF8] hover:text-green-800 rounded-lg  hover:bg-green-300  group">
                    <span class="ml-3">Bidang Ilmu</span>
                </a>
            </li>
            <li>
                <a href="{{ route('metopen') }}"
                    class="flex items-center p-2 text-[#F4FAF8] hover:text-green-800 dark:text-white dark:hover:text-gray-500 rounded-lg  hover:bg-green-300  group">

                    <span class="ml-3">Metode Penilaian</span>
                </a>
            </li>
        </ul>
    </div>



</aside>
