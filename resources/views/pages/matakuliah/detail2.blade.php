@extends('layouts.app')

@section('body')
<div class="flex items-center justify-between py-5 px-5">
    <h1 class="font-bold text-2xl mb-0">Detail Matakuliah</h1>
</div>

<div class="px-5">
    <h2 class="text-lg">Kode : {{ $mkSubBk->kdmatakuliah }}</h2>
    <h2 class="text-lg">Mata Kuliah : {{ $mkSubBk->matakuliah }}</h2>
</div>

<a href="{{ route('mk.subbk', ['id' => $mkSubBk->kdmatakuliah]) }}">Kelola Sub BK</a>
<h2 class="text-lg font-medium my-8">Sub BK</h2>
@foreach ($mkSubBk->MKtoSub_bk as $item)
    <a href="{{ route('subbk.cpmk', ['id' =>$mkSubBk->kdmatakuliah, 'sub' => $item->pivot->id]) }}">
        <div class="p-3 hover:text-blue-300">
            {{ $item->kode_subbk }} {{ $item->sub_bk }}
        </div>
    </a>
@endforeach

@endsection