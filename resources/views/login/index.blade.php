<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <title>SISTEM OBE | UNIVERSITAS 'AISYIYAH YOGYAKARTA</title>
</head>

<body class="">

    {{-- <div class="px-5 py-5 w-full max-h-screen">
        @yield('body')
    </div> --}}

                <!-- component -->
                <!-- component -->
                {{-- <a href="#" class="app-logo">
                    <img width="70" class="" src="https://ppb.unisayogya.ac.id/wp-content/uploads/2017/08/cropped-logo-unisa-crop.png" />
                    SISTEM OBE UNISA
                </a> --}}
<!-- component -->
<!-- component -->
<div class="min-h-screen bg-gray-100 flex flex-col justify sm:py-12">
    <div class="p-10 xs:p-0 mx-auto md:w-full md:max-w-md">
        <h1 class="font-bold text-center text-2xl mb-5" src="https://ppb.unisayogya.ac.id/wp-content/uploads/2017/08/cropped-logo-unisa-crop.png">SISTEM OBE UNISA

      </h1>

      <div class="bg-white shadow w-full rounded-lg divide-y divide-gray-200">
        <div class="px-5 py-12">


            <form action="" method="POST">
               @csrf

               <label class="font-semibold text-sm text-gray-600 pb-1 block" >E-mail</label>
               <input type="email" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full form-control" value="{{ old('email') }}" name="email"/>
               <label class="font-semibold text-sm text-gray-600 pb-1 block">Password</label>
               <input type="password" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full form-control" placeholder="Password" name="password"/>
               <button name="submit" type="submit"  class="transition duration-200 dark:bg-gray-800 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800 text-white w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block">Log in
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
                </button>

               {{-- <button name="submit" type="button"  class="transition duration-200 bg-blue-500 hover:bg-blue-600 focus:bg-blue-700 focus:shadow-sm focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 text-white w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block">
                   <span class="inline-block mr-2">Login</span>
                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                   </svg>
               </button> --}}
            </form>
        </div>

        @if ($errors->any())
            <div class="px-5 py-12 bg-red-500">
                <div class="red-alert" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class=" text-white">
                        @foreach ($errors->all() as $item)

                        <span class="font-medium text-white">Perhatian!</span> {{ $item }}
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
  </div>




    {{-- <form action="" method="POST">
        @csrf
            </div>
                <input class="p-3 border-[1px] border-slate-500 rounded-sm w-80" placeholder="E-Mail" type="email" value="{{ old('email') }}" name="email" class="form-control"/>
            <div class="flex flex-col space-y-1">
                <input class="p-3 border-[1px] border-slate-500 rounded-sm w-80" placeholder="Password" type="password" name="password" class="form-control"/>
                <p class="font-bold text-[#0070ba]">Forgot password?</p>
            </div>
            <div class="flex flex-col space-y-5 w-full">
                <button name="submit" type="submit"  class="w-full bg-[#0070ba] rounded-3xl p-3 text-white font-bold transition duration-200 hover:bg-[#003087]">Log in</button>
                <div class="flex items-center justify-center border-t-[1px] border-t-slate-300 w-full relative">
                  <div class="-mt-1 font-bod bg-white px-5 absolute">Or</div>
                </div>
                <button class="w-full border-blue-900 hover:border-[#003087] hover:border-[2px] border-[1px] rounded-3xl p-3 text-[#0070ba] font-bold transition duration-200">Sign Up</button>
              </div>


              @if($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach($errors->all() as $item)
                              <li>
                                  {{ $item }}
                              </li>
                          @endforeach
                      </ul>
                  </div>

              @endif
    </form>
        <div class="flex space-x-1 p-20 text-sm">
            <p class="hover:underline cursor-pointer">German</p>
            <div class="border-r-[1px] border-r-slate-300"></div>
            <p class="font-bold hover:underline cursor-pointer">English</p>
        </div> --}}
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js"></script>


    @stack('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



</body>
