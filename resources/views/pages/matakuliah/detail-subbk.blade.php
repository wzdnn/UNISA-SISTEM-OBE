@extends('layouts.app')

@section('body')
    <h1 class="text-xl">Detail Sub BK Matakuliah</h1>
    <p class="font-bold">Sub BK : {{ $subbk->subbk->kode_subbk }} {{ $subbk->subbk->sub_bk }}</p>

    <form action="" method="post" class="mb-5">
        @csrf
        <div class="">
            <p>Pkok Bahasan</p>
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

    <h2 class="mt-3">CPMKS</h2>
    <a href="{{ route('subbk.cpmk.kelola', ['id' => $id, 'sub' => $sub]) }}" class="mb-5">Kelola CPMK</a>
    @foreach ($subbk->cpmks as $item)
        <p>{{ $item->kode_cpmk }} {{ $item->cpmk }}</p>
    @endforeach
    
@endsection