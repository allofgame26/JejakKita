@php
    $img = $program?->getFirstMediaUrl() ?? null;
@endphp
@if($img)
    <div class="flex justify-center mb-2">
        <img src="{{ $img }}" alt="Gambar Program" class="rounded-lg shadow max-h-56 object-cover">
    </div>
@endif
