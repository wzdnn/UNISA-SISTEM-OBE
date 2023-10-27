<nav class="flex flex-col w-screen md:relative md:top-0 md:w-full bg-white shadow-md dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                <button
                    class="text-gray-500  hover:bg-gray-500 hover:text-white focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-gray-800 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800"
                    type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation"
                    aria-controls="drawer-navigation">
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a href="{{ route('welcome') }}" class="flex ml-2 md:mr-24">
                    <img src="https://ppb.unisayogya.ac.id/wp-content/uploads/2017/08/cropped-logo-unisa-crop.png"
                        class="h-8 mr-3" alt="Logo Unisa" />
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">SISTEM
                        OBE UNISA</span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ml-3">
                    <div>
                        <button type="button"
                            class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full"
                                src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="user photo">
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 dark:text-white dark:hover:text-gray-500 " role="none">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-sm font-medium text-gray-900  dark:hover:text-gray-500 truncate dark:text-gray-300" role="none">
                                {{ Auth::user()->email }}

                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Profile</a>
                            </li>
                            <li>
                                <a href="logout"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Sign Out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>


<!-- drawer component -->
<div id="drawer-navigation"
    class="fixed top-0 left-0 z-40 w-64 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white dark:bg-gray-800"
    tabindex="-1" aria-labelledby="drawer-navigation-label">
    <h5 id="drawer-navigation-label" class="text-base font-semibold text-gray-500 uppercase dark:text-white">Menu
    </h5>
    <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation"
        class="text-gray-400  bg-transparent hover:bg-gray-200 hover:text-gray-900 dark:text-white  rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
    <div class="py-4 overflow-y-auto">
        <br/>
        <hr/>
        <ul class="space-y-2 font-medium">
            {{-- <li>
                <a href="{{ route('welcome') }}"
                    class="flex items-center p-2 text-gray-900 dark:text-white dark:hover:text-gray-500 rounded-lg  hover:bg-gray-100  group">

                    <span class="ml-3">Dashboard</span>
                </a>
            </li> --}}
            <li>
                <a href="{{ route('index.VM') }}"
                    class="flex items-center p-2 text-gray-900 dark:text-white dark:hover:text-gray-500 rounded-lg  hover:bg-gray-100  group">

                    <span class="ml-3">Visi dan Misi</span>
                </a>
            </li>
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-gray-900 dark:text-white dark:hover:text-gray-500 transition duration-75 rounded-lg group hover:bg-gray-100"
                    aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">

                    <span class="flex-1 ml-3 text-left whitespace-nowrap">Bahan Penilaian Lulusan</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-example" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('pl.index') }}"
                            class="flex items-center w-full p-2 text-gray-900 dark:text-white dark:hover:text-gray-500 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 ">Profile
                            Lulusan</a>
                    </li>
                    <li>
                        <a href="{{ route('cplr.index') }}"
                            class="flex items-center w-full p-2 text-gray-900 dark:text-white dark:hover:text-gray-500 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 ">Referensi
                            Capaian Lulusan</a>
                    </li>
                    <li>
                        <a href="{{ route('cpl.index') }}"
                            class="flex items-center w-full p-2 text-gray-900 dark:text-white dark:hover:text-gray-500 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 ">Capaian
                            Pembelajaran
                            Lulusan</a>
                    </li>
                </ul>
            </li>
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-gray-900 dark:text-white dark:hover:text-gray-500 transition duration-75 rounded-lg group hover:bg-gray-100  "
                    aria-controls="dropdown-list-user" data-collapse-toggle="dropdown-list-user">

                    <span class="flex-1 ml-3 text-left whitespace-nowrap">Bahan Kajian</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-list-user" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('bk.index') }}"
                            class="flex items-center w-full p-2 text-gray-900 dark:text-white dark:hover:text-gray-500 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100  ">Bahan
                            Kajian</a>
                    </li>
                    <li>
                        <a href="{{ route('subbk.index') }}"
                            class="flex items-center w-full p-2 text-gray-900 dark:text-white dark:hover:text-gray-500 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100  ">Sub-Bahan
                            Kajian</a>
                    </li>
                </ul>
            </li>
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-gray-900 dark:text-white dark:hover:text-gray-500 transition duration-75 rounded-lg group hover:bg-gray-100"
                    aria-controls="dropdown-list-cpmk" data-collapse-toggle="dropdown-list-cpmk">

                    <span class="flex-1 ml-3 text-left whitespace-nowrap">CPMK</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-list-cpmk" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('list.cpmk') }}"
                            class="flex items-center w-full p-2 text-gray-900 dark:text-white dark:hover:text-gray-500 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 ">List
                            CPMK</a>
                    </li>
                    <li>
                        <a href="{{ route('peta.cpmk') }}"
                            class="flex items-center w-full p-2 text-gray-900 dark:text-white dark:hover:text-gray-500 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 ">Peta
                            CPL-CPMK</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ route('index.mk') }}"
                    class="flex items-center p-2 text-gray-900 dark:text-white dark:hover:text-gray-500 rounded-lg  hover:bg-gray-100  group">

                    <span class="flex-1 ml-3 whitespace-nowrap">Matakuliah</span>
                </a>
            </li>
        </ul>
        <br />
        <hr />
        <hr />
        @if(Auth::user()->role == 'superAdmin')
        <ul class="space-y-2 py-3 font-medium">
            <li>
                <a href="{{ route('index.aspek') }}"
                    class="flex items-center p-2 text-gray-900 dark:text-white dark:hover:text-gray-500 rounded-lg  hover:bg-gray-100  group">

                    <span class="ml-3">Aspek</span>
                </a>
            </li>
            <li>
                <a href="{{ route('index.sumber') }}"
                    class="flex items-center p-2 text-gray-900 dark:text-white dark:hover:text-gray-500 rounded-lg  hover:bg-gray-100  group">

                    <span class="ml-3">Sumber</span>
                </a>
            </li>
            <li>
                <a href="{{ route('index.basil') }}"
                    class="flex items-center p-2 text-gray-900 dark:text-white dark:hover:text-gray-500 rounded-lg  hover:bg-gray-100  group">

                    <span class="ml-3">Basis Ilmu</span>
                </a>
            </li>
            <li>
                <a href="{{ route('index.bidil') }}"
                    class="flex items-center p-2 text-gray-900 dark:text-white dark:hover:text-gray-500 rounded-lg  hover:bg-gray-100  group">

                    <span class="ml-3">Bidang Ilmu</span>
                </a>
            </li>
        </ul>

        @endif
    </div>
</div>
