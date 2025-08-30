@props(['post'])

{{-- CSS ini diambil dan disederhanakan dari welcomes.blade.php --}}
{{-- Tujuannya agar preview di modal semirip mungkin dengan aslinya --}}
<style>
    .preview-card-pembangunan {
      border: 1px solid #dadd59;
      border-radius: 12px;
      box-shadow: 0 1px 8px rgb(31 43 75 / 0.1);
      padding-bottom: 1rem;
      overflow: hidden;
      background-color: #fff;
      margin: 1rem auto;
      max-width: 400px;
      font-family: sans-serif;
    }
    .preview-card-pembangunan .card-img-top {
      object-fit: cover;
      height: 200px;
      border-radius: 12px 12px 0 0;
      width: 100%;
    }
    .preview-card-pembangunan .card-body {
      padding-left: 1rem;
      padding-right: 1rem;
      padding-top: 0.6rem;
    }
    .preview-card-pembangunan .card-title {
      font-size: 1.1rem;
      font-weight: 600;
      color: #5866ef;
      margin-bottom: 0.25rem;
    }
    .preview-card-pembangunan .card-text {
      font-size: 0.9rem;
      color: #444;
      font-weight: 500;
      line-height: 1.5;
    }
</style>

@if ($post)
    <div class="preview-card-pembangunan">
        {{-- Gunakan getFirstMediaUrl untuk mengambil foto utama --}}
        <img src="{{ $post->getFirstMediaUrl('fitur_image') }}" alt="{{ $post->title }}" class="card-img-top">
        <div class="card-body">
            <h3 class="card-title">{{ $post->title }}</h3>
            <div class="card-text">{!! $post->content !!}</div>
        </div>
    </div>
@else
    <p class="text-center text-gray-500">Data post tidak ditemukan untuk ditampilkan.</p>
@endif