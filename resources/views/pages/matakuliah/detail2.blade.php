@extends('layouts.app')

@push('style')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@section('body')
<div class="flex items-center">
    <h1 class="font-bold text-2xl mb-0 text-blue-800">Detail Matakuliah</h1>
</div>

<div class="my-3">
    {{-- <h2 class="text-lg">Kode : {{ $mkSubBk->kdmatakuliah }}</h2>
    <h2 class="text-lg">Mata Kuliah : {{ $mkSubBk->matakuliah }}</h2> --}}

    <table class="w-[40vh] text-sm  text-gray-500 ">
        <thead class="text-lg text-gray-700 uppercase">
            <tr class="text-left">
                <th scope="col">
                    Kode 
                </th>
                <th scope="col">
                    :
                </th>
                <th scope="col">
                    {{ $mkSubBk->kdmatakuliah }}
                </th>
            </tr>
            <tr class="text-left">
                <th>
                    Matakuliah 
                </th>
                <th class="">
                    :
                </th>
                <th>
                    {{ $mkSubBk->matakuliah }}
                </th>
            </tr>
        </thead>
    </table> 
    <br/>   
    <hr/>
</div>

<div>
    <a href="{{ route('mk.subbk', ['id' => $mkSubBk->kdmatakuliah]) }}"><button
            class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 mb-3">Kelola Sub Bahan
            Kajian
        </button>
    </a>
    <hr />
    <br />
    <div class="my-3">
        <h2 class="font-bold text-2xl mb-0 text-blue-800">Sub BK</h2>
    
    </div>
    
    <table class="w-screen text-sm  text-gray-500 ">
        <thead class="text-xs text-gray-700 uppercase">
            <tr>
                <th scope="col" class="text-left">
    
                    @foreach ($mkSubBk->MKtoSub_bk as $item)
                    <a href="{{ route('subbk.cpmk', ['id' =>$mkSubBk->kdmatakuliah, 'sub' => $item->pivot->id]) }}">
                        <div class="p-3 hover:text-blue-300">
                            <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-2">
                                &#x2022; {{ $item->kode_subbk }} {{ $item->sub_bk }}
                            </button>
                        </div>
                    </a>
                    @endforeach
                </th>
            </tr>
        </thead>
    </table>
</div>

{{-- <h2 class="text-lg font-medium my-8">Sub BK</h2> --}}


@endsection

@push('script')
<script>
    $(document).ready(function() {
            $('#subbk').select2();
        });
</script>
@endpush