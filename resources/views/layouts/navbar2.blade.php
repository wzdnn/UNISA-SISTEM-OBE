<header class=" flex w-full items-center p-4 text-semibold text-gray-100 bg-white justify-between  border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    {{-- <button class="p-1 mr-4" @click="sidebarOpen = !sidebarOpen">
        <svg
            class="w-5 h-5 text-gray-300 stroke-current"
            fill="none"
            viewBox="0 0 24 24">
            <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M10.25 6.75L4.75 12L10.25 17.25"
            ></path>
            <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M19.25 12H5"
            ></path>
        </svg>
    </button> --}}
    <button class="flex items-center justify-center p-1.5 rounded bg-green-800 focus:outline-none focus:ring-1 focus:ring-green-00" @click="sidebarOpen = !sidebarOpen">
        <svg
            class="w-5 h-5 text-gray-300 stroke-current"
            fill="none"
            viewBox="0 0 24 24">
            <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M10.25 6.75L4.75 12L10.25 17.25"
            ></path>
            <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M19.25 12H5"
            ></path>
        </svg>
      </button>

    <a href="{{ route('welcome') }}" class="flex ml-2 md:mr-24">
        <img src="https://ppb.unisayogya.ac.id/wp-content/uploads/2017/08/cropped-logo-unisa-crop.png"
            class="h-8 mr-3" alt="Logo Unisa" />
        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-[#058C42]">SISTEM
            OBE UNISA</span>
    </a>
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
                            role="menuitem"
                            onclick="return confirm('Apakah Anda yakin ingin keluar?');">
                            Sign Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
