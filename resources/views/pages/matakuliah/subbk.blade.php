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
        <select class="w-full" id="subbk" name="subbk[]" multiple="multiple">
            @foreach ($subbk as $item)
                <option value="{{ $item->id }}" @selected(in_array($item->id, $subbkSelect))>{{ $item->kode_subbk }} {{ $item->sub_bk }}</option>
            @endforeach
        </select>
        <button type="submit">UPDATE</button>
    </form>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#subbk').select2();
    });
</script>
@endpush