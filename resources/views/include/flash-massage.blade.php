@if ($errors->any())
<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100" role="alert">
    <span class="font-medium">Error!</span> {{ $errors->first() }}
</div>
@endif

@if (session()->has('success'))
<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
    <span class="font-medium">Success!</span> {{ session()->get('success') }}
</div>
@endif

@if (!empty($warning))
<div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-100" role="alert">
    <span class="font-medium">Warning!</span>{{ $warning }}
</div>
@endif

@if (session()->has('failed'))
<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100" role="alert">
    <span class="font-medium">Error!</span> {{ session()->get('failed') }}
</div>
@endif