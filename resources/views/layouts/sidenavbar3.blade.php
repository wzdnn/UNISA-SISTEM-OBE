<aside class="flex-shrink-0 w-64 flex flex-col border-r transition-all duration-300 bg-white" :class="{ '-ml-64': !sidebarOpen }">
    <nav class="flex-1 flex flex-col bg-[#00A650]">
      <div class="px-6 pt-4 ">
          <div class="flex items-center justify-between">
              <a href="{{ route('welcome') }}" class="bg-green-200 p-1.5 rounded flex items-center justify-cecnter">
                  <svg
                      class="w-5 h-5 text-green-500 stroke-current"
                      viewBox="0 0 24 24"
                      fill="none">
                      <path
                      d="M12 4.75L19.25 9L12 13.25L4.75 9L12 4.75Z"
                      stroke="currentColor"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      ></path>
                      <path
                      d="M9.25 12L4.75 15L12 19.25L19.25 15L14.6722 12"
                      stroke="currentColor"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      ></path>
                  </svg>
              </a>
              <p class="font-medium text-white ">MENU</p>
          </div>
      </div>
      <div class="px-6 pt-4">
          <hr class="border-green-300" />
      </div>
      <div class="px-6 pt-4">
          <ul class="flex flex-col space-y-2 font-normal">
              <li class="relative text-green-100 hover:text-green-800 focus-within:text-white">
                <div
                  class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none"
                >
                  <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1.5"
                      d="M4.75 6.75C4.75 5.64543 5.64543 4.75 6.75 4.75H17.25C18.3546 4.75 19.25 5.64543 19.25 6.75V17.25C19.25 18.3546 18.3546 19.25 17.25 19.25H6.75C5.64543 19.25 4.75 18.3546 4.75 17.25V6.75Z"
                    ></path>
                    <path
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1.5"
                      d="M9.75 8.75V19"
                    ></path>
                    <path
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1.5"
                      d="M5 8.25H19"
                    ></path>
                  </svg>
                </div>
                <a
                  href="{{ route('welcome') }}"
                  class="inline-block w-full py-2 pl-8 pr-4 text-md rounded hover:bg-green-300 focus:outline-none focus:ring-1 focus:ring-green-500 focus:bg-green-300"
                  >Dashboard</a>
              </li>
              <li class="relative text-green-100 hover:text-green-800 focus-within:text-white">
                <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
                  <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path
                      d="M12 4.75L19.25 9L12 13.25L4.75 9L12 4.75Z"
                      stroke="currentColor"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    ></path>
                    <path
                      d="M9.25 12L4.75 15L12 19.25L19.25 15L14.6722 12"
                      stroke="currentColor"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    ></path>
                  </svg>
                </div>
                    <a href="{{ route('index.VM') }}" class="inline-block w-full py-2 pl-8 pr-4 text-md rounded hover:bg-green-300 focus:outline-none focus:ring-1 focus:ring-green-500 focus:bg-green-300">
                        <span class="text-md">Visi dan Misi</span>
                    </a>
              </li>
              {{-- Bahan Penilaian Lulusan --}}
              <li class="">
                  <div class="relative flex justify-between text-green-100 hover:text-white focus-within:text-white">
                    <div class="flex items-center w-full">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
                          <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24">
                          <path
                              stroke="currentColor"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.5"
                              d="M7.75 19.25H16.25C17.3546 19.25 18.25 18.3546 18.25 17.25V9L14 4.75H7.75C6.64543 4.75 5.75 5.64543 5.75 6.75V17.25C5.75 18.3546 6.64543 19.25 7.75 19.25Z"
                          ></path>
                          <path
                              stroke="currentColor"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.5"
                              d="M18 9.25H13.75V5"
                          ></path>
                          <path
                              stroke="currentColor"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.5"
                              d="M9.75 15.25H14.25"
                          ></path>
                          <path
                              stroke="currentColor"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.5"
                              d="M9.75 12.25H14.25"
                          ></path>
                          </svg>
                      </div>
                      <a
                          href="#"
                          id="dropdownDefaultButton"
                          aria-controls="dropdown-example" data-collapse-toggle="dropdown-example"
                          class="inline-block w-full py-2 pl-8 pr-4 text-sm rounded hover:bg-green-300 focus:outline-none focus:ring-1 focus:ring-green-500 focus:bg-green-300"
                          >Bahan Penilaian Lulusan</a
                      >
                      </div>
                      <button class="absolute right-0 flex items-center p-1" tabindex="-1" id="dropdownDefaultButton" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                      <svg class="w-7 h-7 stroke-current" fill="none" viewBox="0 0 24 24">
                          <path
                          stroke="currentColor"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="1.5"
                          d="M15.25 10.75L12 14.25L8.75 10.75"
                          ></path>
                      </svg>
                      </button>
                  </div>
                  <div class="pl-4">
                    <ul class="hidden flex-col py-0 pl-2 border-l border-green-300 ml-1 " id="dropdown-example" >
                        <li>
                            <a href="{{ route('pl.index') }}"
                                class="inline-block w-full px-4 py-2 text-sm rounded text-[#F4FAF8] hover:bg-green-300 hover:green-800 focus:outline-none focus:ring-1 focus:ring-green-500 hover:text-green-800 ">Profile Lulusan</a>
                        </li>
                        <li>
                            <a href="{{ route('cplr.index') }}"
                                class="inline-block w-full px-4 py-2 text-sm rounded text-[#F4FAF8] hover:bg-green-300 hover:green-800 focus:outline-none focus:ring-1 focus:ring-green-500 hover:text-green-800 ">Referensi Capaian Lulusan</a>
                        </li>
                        <li>
                            <a href="{{ route('cpl.index') }}"
                                class="inline-block w-full px-4 py-2 text-sm rounded text-[#F4FAF8] hover:bg-green-300 hover:green-800 focus:outline-none focus:ring-1 focus:ring-green-500 hover:text-green-800 ">Capaian Pembelajaran Lulusan</a>
                        </li>
                    </ul>
                  </div>
              </li>
              {{-- <li class="relative text-green-100 hover:text-green-800 focus-within:text-white">
                <div
                  class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none"
                >
                  <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1.5"
                      d="M4.75 6.75C4.75 5.64543 5.64543 4.75 6.75 4.75H17.25C18.3546 4.75 19.25 5.64543 19.25 6.75V17.25C19.25 18.3546 18.3546 19.25 17.25 19.25H6.75C5.64543 19.25 4.75 18.3546 4.75 17.25V6.75Z"
                    ></path>
                    <path
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1.5"
                      d="M9.75 8.75V19"
                    ></path>
                    <path
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1.5"
                      d="M5 8.25H19"
                    ></path>
                  </svg>
                </div>
                  <button type="button" id="dropdownDefaultButton"
                      class="inline-block w-full py-2 pl-8 pr-4 text-sm rounded hover:bg-green-300 focus:outline-none focus:ring-1 focus:ring-green-500 focus:bg-green-300"
                      aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                      <span class="flex-1 text-left whitespace-nowrap">Bahan Penilaian Lulusan</span>
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 4 4 4-4" />
                      </svg>
                  </button>
                      <ul id="dropdown-example" class="hidden flex-col py-1 pl-4 border-l border-green-300 ml-2">
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
              </li> --}}
              {{-- Bahan Kajian --}}
              <li class="">
                <div class="relative flex justify-between text-green-100 hover:text-white focus-within:text-white">
                  <div class="flex items-center w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
                        <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M7.75 19.25H16.25C17.3546 19.25 18.25 18.3546 18.25 17.25V9L14 4.75H7.75C6.64543 4.75 5.75 5.64543 5.75 6.75V17.25C5.75 18.3546 6.64543 19.25 7.75 19.25Z"
                        ></path>
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M18 9.25H13.75V5"
                        ></path>
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M9.75 15.25H14.25"
                        ></path>
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M9.75 12.25H14.25"
                        ></path>
                        </svg>
                    </div>
                    <a
                        href="#"
                        id="dropdownBahanKajian"
                        aria-controls="d" data-collapse-toggle="d"
                        class="inline-block w-full py-2 pl-8 pr-4 text-md rounded hover:bg-green-300 focus:outline-none focus:ring-1 focus:ring-green-500 focus:bg-green-300"
                        >Bahan Kajian</a
                    >
                    </div>
                    <button class="absolute right-0 flex items-center p-1" tabindex="-1" id="dropdownBahanKajian" aria-controls="d" data-collapse-toggle="d">
                    <svg class="w-7 h-7 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M15.25 10.75L12 14.25L8.75 10.75"
                        ></path>
                    </svg>
                    </button>
                </div>
                <div class=" pl-4">
                  <ul class="hidden flex-col py-0 pl-2 border-l border-green-300 ml-1 " id="d" >
                      <li>
                          <a href="{{ route('bk.index') }}"
                              class="inline-block w-full px-4 py-2 text-sm rounded text-[#F4FAF8] hover:bg-green-300 hover:green-800 focus:outline-none focus:ring-1 focus:ring-green-500 hover:text-green-800 ">Bahan Kajian</a>
                      </li>
                      <li>
                          <a href="{{ route('sub-bk.index') }}"
                              class="inline-block w-full px-4 py-2 text-sm rounded text-[#F4FAF8] hover:bg-green-300 hover:green-800 focus:outline-none focus:ring-1 focus:ring-green-500 hover:text-green-800 ">Sub-Bahan Kajian</a>
                      </li>
                  </ul>
                </div>
              </li>
              {{-- <li>

                  <button type="button"
                      class="flex items-center w-full p-2 text-base text-[#F4FAF8] hover:text-green-800 transition duration-75 rounded-lg group hover:bg-green-300  "
                      aria-controls="dropdown-bahan-kajian" data-collapse-toggle="dropdown-bahan-kajian">
                      <span class="flex-1 ml-3 text-left whitespace-nowrap">Bahan Kajian</span>
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 4 4 4-4" />
                      </svg>
                  </button>
                  <div class="pt-2 pl-4">
                      <ul id="dropdown-bahan-kajian" class="hidden flex-col py-1 pl-4 border-l border-green-300 ml-2">
                          <li class="rounded-t m-0">
                              <a href="{{ route('bk.index') }}"
                                  class="inline-block w-full px-4 py-2 text-xs rounded text-[#F4FAF8] hover:bg-green-300 hover:green-800 focus:outline-none focus:ring-1 focus:ring-gray-500 hover:text-green-800">Bahan
                                  Kajian</a>
                          </li >
                          <li  class="rounded-b m-0">
                              <a href="{{ route('sub-bk.index') }}"
                                  class="inline-block w-full px-4 py-2 text-xs rounded text-[#F4FAF8] hover:bg-green-300 hover:green-800 focus:outline-none focus:ring-1 focus:ring-gray-500 hover:text-green-800">Sub-Bahan
                                  Kajian</a>
                          </li>
                        </ul>
                  </div>
              </li> --}}
              {{-- CPMK --}}
              <li class="">
                <div class="relative flex justify-between text-green-100 hover:text-white focus-within:text-white">
                  <div class="flex items-center w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none" >
                        <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M7.75 19.25H16.25C17.3546 19.25 18.25 18.3546 18.25 17.25V9L14 4.75H7.75C6.64543 4.75 5.75 5.64543 5.75 6.75V17.25C5.75 18.3546 6.64543 19.25 7.75 19.25Z"
                        ></path>
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M18 9.25H13.75V5"
                        ></path>
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M9.75 15.25H14.25"
                        ></path>
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M9.75 12.25H14.25"
                        ></path>
                        </svg>
                    </div>
                    <a
                      aria-controls="dropdown-list-cpmk" data-collapse-toggle="dropdown-list-cpmk"
                        href="#"
                        id="dropdown-list"
                        class="inline-block w-full py-2 pl-8 pr-4 text-md rounded hover:bg-green-300 focus:outline-none focus:ring-1 focus:ring-green-500 focus:bg-green-300"
                        >CPMK</a>
                    </div>
                    <button class="absolute right-0 flex items-center p-1" tabindex="-1" id="dropdown-list" aria-controls="dropdown-list-cpmk" data-collapse-toggle="dropdown-example">
                    <svg class="w-7 h-7 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M15.25 10.75L12 14.25L8.75 10.75"
                        ></path>
                    </svg>
                    </button>
                </div>
                <div class="pt-2 pl-4">
                  <ul class="hidden flex-col py-0 pl-2 border-l border-green-300 ml-1 " id="dropdown-list-cpmk" >
                      <li>
                          <a href="{{ route('list.cpmk') }}"
                              class="inline-block w-full px-4 py-2 text-sm rounded text-[#F4FAF8] hover:bg-green-300 hover:green-800 focus:outline-none focus:ring-1 focus:ring-green-500 hover:text-green-800 ">List CPMK</a>
                      </li>
                      <li>
                          <a href="{{ route('peta.cpmk') }}"
                              class="inline-block w-full px-4 py-2 text-sm rounded text-[#F4FAF8] hover:bg-green-300 hover:green-800 focus:outline-none focus:ring-1 focus:ring-green-500 hover:text-green-800 ">Peta CPL-CPMK</a>
                      </li>
                  </ul>
                </div>
              </li>
              {{-- <li>
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
              </li> --}}
              {{-- Matakuliah --}}
              <li class="relative text-green-100 hover:text-green-800 focus-within:text-white">
                  <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
                    <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24">
                      <circle
                        cx="12"
                        cy="12"
                        r="7.25"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                      ></circle>
                      <circle
                        cx="12"
                        cy="12"
                        r="3.25"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                      ></circle>
                      <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M7 17L9.5 14.5"
                      ></path>
                      <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M17 17L14.5 14.5"
                      ></path>
                      <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M9.5 9.5L7 7"
                      ></path>
                      <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M14.5 9.5L17 7"
                      ></path>
                    </svg>
                  </div>
                  <a href="{{ route('index.mk') }}"
                      class="inline-block w-full py-2 pl-8 pr-4 text-md rounded hover:bg-green-300 focus:outline-none focus:ring-1 focus:ring-green-500 focus:bg-green-300">
                      <span class="flex-1 whitespace-nowrap">Matakuliah</span>
                  </a>
              </li>
              {{-- Organisasi Matakuliah --}}
              <li class="relative text-green-100 hover:text-green-800 focus-within:text-white">
                <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
                  <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1.5"
                      d="M4.75 5.75C4.75 5.19772 5.19772 4.75 5.75 4.75H9.25C9.80228 4.75 10.25 5.19772 10.25 5.75V9.25C10.25 9.80228 9.80228 10.25 9.25 10.25H5.75C5.19772 10.25 4.75 9.80228 4.75 9.25V5.75Z"
                    ></path>
                    <path
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1.5"
                      d="M4.75 14.75C4.75 14.1977 5.19772 13.75 5.75 13.75H9.25C9.80228 13.75 10.25 14.1977 10.25 14.75V18.25C10.25 18.8023 9.80228 19.25 9.25 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V14.75Z"
                    ></path>
                    <path
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1.5"
                      d="M13.75 5.75C13.75 5.19772 14.1977 4.75 14.75 4.75H18.25C18.8023 4.75 19.25 5.19772 19.25 5.75V9.25C19.25 9.80228 18.8023 10.25 18.25 10.25H14.75C14.1977 10.25 13.75 9.80228 13.75 9.25V5.75Z"
                    ></path>
                    <path
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1.5"
                      d="M13.75 14.75C13.75 14.1977 14.1977 13.75 14.75 13.75H18.25C18.8023 13.75 19.25 14.1977 19.25 14.75V18.25C19.25 18.8023 18.8023 19.25 18.25 19.25H14.75C14.1977 19.25 13.75 18.8023 13.75 18.25V14.75Z"
                    ></path>
                  </svg>
                </div>
                  <a href="{{ route('organisasi.mk') }}"
                      class="inline-block w-full py-2 pl-8 pr-4 text-md rounded hover:bg-green-300 focus:outline-none focus:ring-1 focus:ring-green-500 focus:bg-green-300">

                      <span class="flex-1 whitespace-nowrap">Organisasi Matakuliah</span>
                  </a>
              </li>
              {{-- Master Metode Penilaian --}}
              <li class="relative text-green-100 hover:text-green-800 focus-within:text-white">
                <div
                class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
                <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24">
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M4.75 5.75C4.75 5.19772 5.19772 4.75 5.75 4.75H9.25C9.80228 4.75 10.25 5.19772 10.25 5.75V9.25C10.25 9.80228 9.80228 10.25 9.25 10.25H5.75C5.19772 10.25 4.75 9.80228 4.75 9.25V5.75Z"
                  ></path>
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M4.75 14.75C4.75 14.1977 5.19772 13.75 5.75 13.75H9.25C9.80228 13.75 10.25 14.1977 10.25 14.75V18.25C10.25 18.8023 9.80228 19.25 9.25 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V14.75Z"
                  ></path>
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M13.75 5.75C13.75 5.19772 14.1977 4.75 14.75 4.75H18.25C18.8023 4.75 19.25 5.19772 19.25 5.75V9.25C19.25 9.80228 18.8023 10.25 18.25 10.25H14.75C14.1977 10.25 13.75 9.80228 13.75 9.25V5.75Z"
                  ></path>
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M13.75 14.75C13.75 14.1977 14.1977 13.75 14.75 13.75H18.25C18.8023 13.75 19.25 14.1977 19.25 14.75V18.25C19.25 18.8023 18.8023 19.25 18.25 19.25H14.75C14.1977 19.25 13.75 18.8023 13.75 18.25V14.75Z"
                  ></path>
                </svg>
              </div>
                <a href="{{ route('index.metopen') }}"
                      class="inline-block w-full py-2 pl-8 pr-4 text-sm rounded hover:bg-green-300 focus:outline-none focus:ring-1 focus:ring-green-500 focus:bg-green-300">

                      <span class="flex-1 whitespace-nowrap">Master Metode Penilaian</span>
                  </a>
              </li>
          </ul>
      </div>
      <div class="px-6 pt-4">
        <hr class="border-green-300" />
      </div>
      <div class="px-6 pt-1">
        <ul class="relative text-green-100 hover:text-green-800 focus-within:text-white">
            <li class="relative text-green-100 hover:text-green-800 focus-within:text-white">
              <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
                <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24">
                  <circle
                    cx="12"
                    cy="12"
                    r="7.25"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                  ></circle>
                  <circle
                    cx="12"
                    cy="12"
                    r="3.25"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                  ></circle>
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M7 17L9.5 14.5"
                  ></path>
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M17 17L14.5 14.5"
                  ></path>
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M9.5 9.5L7 7"
                  ></path>
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M14.5 9.5L17 7"
                  ></path>
                </svg>
              </div>
              <a href="{{ route('index.aspek') }}"
                  class="inline-block w-full py-2 pl-8 pr-4 text-md rounded hover:bg-green-300 focus:outline-none focus:ring-1 focus:ring-green-500 focus:bg-green-300">
                  <span class="flex-1 whitespace-nowrap">Aspek</span>
              </a>
            </li>
            {{-- <li>
                <a href="{{ route('index.aspek') }}"
                class="flex items-center p-2 text-[#F4FAF8] hover:text-green-800 rounded-lg  hover:bg-green-300  group">
                    <span class="ml-3">Aspek</span>
                </a>
            </li> --}}
            <li class="relative text-green-100 hover:text-green-800 focus-within:text-white">
              <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
                <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24">
                  <circle
                    cx="12"
                    cy="12"
                    r="7.25"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                  ></circle>
                  <circle
                    cx="12"
                    cy="12"
                    r="3.25"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                  ></circle>
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M7 17L9.5 14.5"
                  ></path>
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M17 17L14.5 14.5"
                  ></path>
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M9.5 9.5L7 7"
                  ></path>
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M14.5 9.5L17 7"
                  ></path>
                </svg>
              </div>
              <a href="{{ route('index.sumber') }}"
                  class="inline-block w-full py-2 pl-8 pr-4 text-md rounded hover:bg-green-300 focus:outline-none focus:ring-1 focus:ring-green-500 focus:bg-green-300">
                  <span class="flex-1 whitespace-nowrap">Sumber</span>
              </a>
            </li>
            {{-- <li>
                <a href="{{ route('index.sumber') }}"
                    class="flex items-center p-2 text-[#F4FAF8] hover:text-green-800 rounded-lg  hover:bg-green-300  group">
                    <span class="ml-3">Sumber</span>
                </a>
            </li> --}}
            <li class="relative text-green-100 hover:text-green-800 focus-within:text-white">
              <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
                <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24">
                  <circle
                    cx="12"
                    cy="12"
                    r="7.25"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                  ></circle>
                  <circle
                    cx="12"
                    cy="12"
                    r="3.25"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                  ></circle>
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M7 17L9.5 14.5"
                  ></path>
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M17 17L14.5 14.5"
                  ></path>
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M9.5 9.5L7 7"
                  ></path>
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M14.5 9.5L17 7"
                  ></path>
                </svg>
              </div>
              <a href="{{ route('index.basil') }}"
                  class="inline-block w-full py-2 pl-8 pr-4 text-md rounded hover:bg-green-300 focus:outline-none focus:ring-1 focus:ring-green-500 focus:bg-green-300">
                  <span class="flex-1 whitespace-nowrap">Basis Ilmu</span>
              </a>
            </li>
            {{-- <li>
                <a href="{{ route('index.basil') }}"
                    class="flex items-center p-2 text-[#F4FAF8] hover:text-green-800 rounded-lg  hover:bg-green-300  group">
                    <span class="ml-3">Basis Ilmu</span>
                </a>
            </li> --}}
            <li class="relative text-green-100 hover:text-green-800 focus-within:text-white">
              <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
                <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24">
                  <circle
                    cx="12"
                    cy="12"
                    r="7.25"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                  ></circle>
                  <circle
                    cx="12"
                    cy="12"
                    r="3.25"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                  ></circle>
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M7 17L9.5 14.5"
                  ></path>
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M17 17L14.5 14.5"
                  ></path>
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M9.5 9.5L7 7"
                  ></path>
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M14.5 9.5L17 7"
                  ></path>
                </svg>
              </div>
              <a href="{{ route('index.bidil') }}"
                  class="inline-block w-full py-2 pl-8 pr-4 text-md rounded hover:bg-green-300 focus:outline-none focus:ring-1 focus:ring-green-500 focus:bg-green-300">
                  <span class="flex-1 whitespace-nowrap">Bidang Ilmu</span>
              </a>
            </li>
            {{-- <li>
                <a href="{{ route('index.bidil') }}"
                    class="flex items-center p-2 text-[#F4FAF8] hover:text-green-800 rounded-lg  hover:bg-green-300  group">
                    <span class="ml-3">Bidang Ilmu</span>
                </a>
            </li> --}}
            <li class="relative text-green-100 hover:text-green-800 focus-within:text-white">
              <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
                <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24">
                  <circle
                    cx="12"
                    cy="12"
                    r="7.25"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                  ></circle>
                  <circle
                    cx="12"
                    cy="12"
                    r="3.25"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                  ></circle>
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M7 17L9.5 14.5"
                  ></path>
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M17 17L14.5 14.5"
                  ></path>
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M9.5 9.5L7 7"
                  ></path>
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M14.5 9.5L17 7"
                  ></path>
                </svg>
              </div>
              <a href="{{ route('metopen') }}"
                  class="inline-block w-full py-2 pl-8 pr-4 text-md rounded hover:bg-green-300 focus:outline-none focus:ring-1 focus:ring-green-500 focus:bg-green-300">
                  <span class="flex-1 whitespace-nowrap">Metode Penilaian</span>
              </a>
            </li>
            {{-- <li>
                <a href="{{ route('metopen') }}"
                    class="flex items-center p-2 text-[#F4FAF8] hover:text-green-800 dark:text-white dark:hover:text-gray-500 rounded-lg  hover:bg-green-300  group">

                    <span class="ml-3">Metode Penilaian</span>
                </a>
            </li> --}}
        </ul>
      </div>
    </nav>
  </aside>
