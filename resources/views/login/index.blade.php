<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    @stack('style')

    <title>SISTEM OBE | UNIVERSITAS 'AISYIYAH YOGYAKARTA</title>
</head>

<body class="">

    {{-- <div class="px-5 py-5 w-full max-h-screen">
        @yield('body')
    </div> --}}

                <!-- component -->
                <!-- component -->
<div class="min-h-screen flex justify-center items-center bg-white">
    <div class="p-10 border-[1px] -mt-10 border-slate-200 rounded-md flex flex-col items-center space-y-3">
        <div class="py-8">

            <form action="" method="POST">
                @csrf
                        <img width="70" class="-mt-10" src="https://ppb.unisayogya.ac.id/wp-content/uploads/2017/08/cropped-logo-unisa-crop.png" />
                    </div>
                        <input class="p-3 border-[1px] border-slate-500 rounded-sm w-80" placeholder="E-Mail" type="email" value="{{ old('email') }}" name="email" class="form-control"/>
                    <div class="flex flex-col space-y-1">
                        <input class="p-3 border-[1px] border-slate-500 rounded-sm w-80" placeholder="Password" type="password" name="password" class="form-control"/>
                        {{-- <p class="font-bold text-[#0070ba]">Forgot password?</p> --}}
                    </div>
                    <div class="flex flex-col space-y-5 w-full">
                        <button name="submit" type="submit"  class="w-full bg-[#0070ba] rounded-3xl p-3 text-white font-bold transition duration-200 hover:bg-[#003087]">Log in</button>
                        <div class="flex items-center justify-center border-t-[1px] border-t-slate-300 w-full relative">
                          <div class="-mt-1 font-bod bg-white px-5 absolute">Or</div>
                        </div>
                        <button class="w-full border-blue-900 hover:border-[#003087] hover:border-[2px] border-[1px] rounded-3xl p-3 text-[#0070ba] font-bold transition duration-200">Sign Up</button>
                      </div>


            </form>
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
            <div class="flex space-x-1 p-20 text-sm">
                <p class="hover:underline cursor-pointer">German</p>
                <div class="border-r-[1px] border-r-slate-300"></div>
                <p class="font-bold hover:underline cursor-pointer">English</p>
              </div>

    </div>

    <div class="absolute bottom-0 w-full p-3 bg-[#F7F9FA] flex justify-center items-center space-x-3 text-[14px] font-medium text-[#666]">
      <a href="https://www.paypal.com/us/smarthelp/contact-us" target="_blank" class="hover:underline underline-offset-1 cursor-pointer">Contact Us</a>
      <a href="https://www.paypal.com/de/webapps/mpp/ua/privacy-full" target="_blank" class="hover:underline underline-offset-1 cursor-pointer">Privacy</a>
      <a href="https://www.paypal.com/de/webapps/mpp/ua/legalhub-full" target="_blank" class="hover:underline underline-offset-1 cursor-pointer">Legal</a>
      <a href="https://www.paypal.com/de/webapps/mpp/ua/upcoming-policies-full" target="_blank" class="hover:underline underline-offset-1 cursor-pointer">Policy </a>
      <a href="https://www.paypal.com/de/webapps/mpp/country-worldwide" target="_blank" class="hover:underline underline-offset-1 cursor-pointer">Worldwide </a>
    </div>
  </div>


<svg class="absolute bottom-0 left-0 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,0L40,42.7C80,85,160,171,240,197.3C320,224,400,192,480,154.7C560,117,640,75,720,74.7C800,75,880,117,960,154.7C1040,192,1120,224,1200,213.3C1280,203,1360,149,1400,122.7L1440,96L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js"></script>


    @stack('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



</body>
