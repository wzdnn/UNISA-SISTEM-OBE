<nav
    class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 sm:ml-64 shadow-sm">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                <button
                    class="text-gray-500  hover:bg-gray-500 hover:text-white focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-gray-800 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800"
                    type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation"
                    aria-controls="drawer-navigation">
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a href="{{ route('welcome') }}" class="flex ml-2 md:mr-24">
                    <img src="https://ppb.unisayogya.ac.id/wp-content/uploads/2017/08/cropped-logo-unisa-crop.png"
                        class="h-8 mr-3" alt="Logo Unisa" />
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-[#058C42]">SISTEM
                        OBE UNISA</span>
                </a>
            </div>

            <div class="flex items-center">
                <div class="flex items-center ml-3">
                    <div class="">
                        <button type="button"
                            class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full"
                                src="https://ppb.unisayogya.ac.id/wp-content/uploads/2017/08/cropped-logo-unisa-crop.png"
                                alt="user photo">
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 dark:text-white " role="none">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-sm font-medium text-gray-900  truncate dark:text-gray-300" role="none">
                                {{ Auth::user()->email }}
                            </p>
                            <p class="text-sm font-medium text-gray-900  truncate dark:text-gray-300" role="none">
                                {{ auth()->user()->load('namaKdUnit')->namaKdUnit->unitkerja }}
                            </p>
                            <p class="text-sm font-medium text-gray-900  truncate dark:text-gray-300" role="none">
                                {{ Auth::user()->role }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            {{-- <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Profile</a>
                            </li> --}}
                            <li>
                                <a href="/logout"
                                    class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:text-red-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Sign Out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
