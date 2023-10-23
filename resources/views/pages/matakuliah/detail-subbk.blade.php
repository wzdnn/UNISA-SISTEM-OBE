@extends('layouts.app')

@section('body')
<div class="flex flex-col">
    <h1 class="font-bold text-2xl mb-0 text-blue-800">Detail Sub BK Matakuliah</h1>
    <table class="w-[50vh] text-sm  text-gray-500 ">
        <thead class="text-lg text-gray-700 uppercase">
            <tr class="text-left">
                <th scope="col">
                    Sub BK
                </th>
                <th scope="col">
                    :  
                </th>
                <th scope="col">
                    {{ $subbk->subbk->kode_subbk }} {{ $subbk->subbk->sub_bk }}
                </th>
            </tr>
        </thead>
    </table>
    <br />
    <hr />
</div>
    
<div class="py-3">
    <form action="" method="post" class="mb-5">
        @csrf
        <table class="w-screen text-sm  text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase">
            </thead>
        </table>
        <div class="">
            <p>Pokok Bahasan</p>
            <input type="text" name="pokok-bahasan" value="{{ old('pokok-bahasan') ?? $subbk->pokok_bahasan }}">
            <p>Kuliah</p>
            <input type="text" id="" name="kuliah" value="{{ old('kuliah') ?? $subbk->kuliah }}">
            <p>tutorial</p>
            <input type="text" id="" name="tutorial" value="{{ old('tutorial') ?? $subbk->tutorial }}">
            <p>seminar</p>
            <input type="text" id="" name="seminar" value="{{ old('seminar') ?? $subbk->seminar }}">
            <p>prak</p>
            <input type="text" id="" name="praktikum" value="{{ old('praktikum') ?? $subbk->praktikum }}">
        </div>
    
        <button type="submit">UPDATE</button>
    </form>
    



    {{-- <h2 class="mt-3">CPMKS</h2> --}}
    {{-- <a href="{{ route('subbk.cpmk.kelola', ['id' => $id, 'sub' => $sub]) }}" class="mb-5">Kelola CPMK</a>
    @foreach ($subbk->cpmks as $item)
    <p>{{ $item->kode_cpmk }} {{ $item->cpmk }}</p>
    @endforeach --}}
</div>
    
<div>
    <div class="my-3">
        <h2 class="font-bold text-2xl  text-blue-800">CPMKS</h2>
        <hr/>
        <br/>
        <a href="{{ route('subbk.cpmk.kelola', ['id' => $id, 'sub' => $sub]) }}" class="mb-5"><button
                class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 mb-3">Kelola CPMK
            </button>
        </a>
        <hr/>
    </div>
    <table class="w-screen text-sm  text-gray-500 ">
        <thead class="text-xs text-gray-700 uppercase">
            <tr>
                <th></th>
                <th scope="col" class="text-left">
                    @foreach ($subbk->cpmks as $item)
                        <div class="p-3 hover:text-blue-300">
                            <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-2">
                                &#x2022; {{ $item->kode_cpmk }} {{ $item->cpmk }}
                            </button>
                        </div>
                    @endforeach
                </th>
            </tr>
        </thead>
    </table>
</div>
    
@endsection