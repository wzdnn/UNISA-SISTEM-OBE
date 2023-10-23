@extends('layouts.app')

@push('styles')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@section('body')
    <h1>Kelola Sub BK Matkul</h1>
    @include('include.flash-massage')
    <form action="" method="post">
        @csrf
        <select class="w-full" id="cpmk" name="cpmk[]" multiple="multiple">
            @foreach ($cpmk as $item)
                <option value="{{ $item->id }}" @selected(in_array($item->id, $cpmkSelected))>{{ $item->kode_cpmk }} {{ $item->cpmk }}</option>
            @endforeach
        </select>
        <button type="submit">UPDATE</button>
    </form>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#cpmk').select2();
    });
</script>
@endpush