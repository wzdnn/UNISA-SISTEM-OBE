@extends('layouts.app')

@section('body')
    <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0">Mapping CPMK</h1>
    </div>
    <hr />
    @if ($errors->any())
        <p style="color: red">{{ $errors->first() }}</p>
    @endif
    <form class="py-3" action="{{ route('mapping.cpmk') }}" method="POST">
        @csrf
        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-6 group">
                <select id="inputState" name="kdcpl[]" class="form-control">
                    @foreach ($ak_kurikulum_cpl as $cpl)
                        <option value="{{ $cpl->id }}">{{ $cpl->kode_cpl }}
                            {{ $cpl->cpl }}</option>
                    @endforeach
                </select>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <select id="inputState" name="kdcpmk[]" multiple data-live-search="true" class="form-control">
                    @foreach ($ak_kurikulum_cpmk as $cpmk)
                        <option value="{{ $cpmk->id }}">{{ $cpmk->kode_cpmk }}
                            {{ $cpmk->cpmk }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="py-3">
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
        </div>
    </form>
@endsection
