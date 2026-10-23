@extends('layouts.app')

@section('content')
<section class="bg-charcoal pb-20 pt-28 md:pt-36">
    <div class="section-inner">
        <a href="{{ route('catalog.index', ['kategori' => $product->category?->slug]) }}" class="text-xs uppercase tracking-[.2em] text-gold">&larr; {{ $product->category?->name ?? 'Produk' }}</a>
        <div class="mt-8 grid gap-10 lg:grid-cols-[1.15fr_.85fr] lg:gap-16">
            <div>
                <figure class="overflow-hidden border border-white/10 bg-charcoal-100">
                    <img src="{{ $product->getThumbnailUrl('large') }}" alt="{{ $product->name }}" class="aspect-[4/3] w-full object-cover">
                </figure>
                @if($product->getMedia('images')->count() > 1)
                    <div class="mt-3 grid grid-cols-4 gap-3">
                        @foreach($product->getMedia('images') as $image)
                            <img src="{{ $image->getUrl('thumb') }}" alt="Galeri {{ $product->name }}" class="aspect-square w-full border border-white/10 object-cover" loading="lazy">
                        @endforeach
                    </div>
                @endif
            </div>
            <div>
                <p class="text-xs uppercase tracking-[.3em] text-gold">{{ $product->category?->name }}</p>
                <h1 class="mt-4 font-heading text-4xl font-bold leading-tight text-white md:text-5xl">{{ $product->name }}</h1>
                <p class="mt-6 text-base leading-8 text-white/65">{{ $product->description }}</p>
                @if($product->capacity)
                    <div class="mt-8 border-l-2 border-gold pl-5">
                        <p class="text-xs uppercase tracking-[.2em] text-gold">Kapasitas & ukuran</p>
                        <p class="mt-2 leading-7 text-white/75">{{ $product->capacity }}</p>
                    </div>
                @endif
                <div class="mt-8">
                    <x-whatsapp-cta class="btn-gold w-full justify-center text-sm uppercase tracking-widest md:w-auto" label="Pesan via WhatsApp" :message="$product->getWhatsappMessage()" />
                    <p class="mt-3 text-xs text-white/40">Cek ketersediaan dan diskusikan konfigurasi langsung dengan tim kami.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-wrap bg-charcoal-100">
    <div class="section-inner grid gap-12 lg:grid-cols-2">
        @if($product->specifications)
            <div>
                <p class="text-xs uppercase tracking-[.25em] text-gold">Rincian teknis</p>
                <h2 class="mt-3 font-heading text-3xl text-white">Spesifikasi</h2>
                <div class="mt-6 whitespace-pre-line border-l border-gold/40 pl-5 leading-8 text-white/65">{{ $product->specifications }}</div>
            </div>
        @endif
        @if($product->use_cases)
            <div>
                <p class="text-xs uppercase tracking-[.25em] text-gold">Fleksibel untuk berbagai kebutuhan</p>
                <h2 class="mt-3 font-heading text-3xl text-white">Cocok untuk acara</h2>
                <p class="mt-6 leading-8 text-white/65">{{ $product->use_cases }}</p>
            </div>
        @endif
    </div>
</section>

@if($relatedProducts->isNotEmpty())
<section class="section-wrap bg-charcoal">
    <div class="section-inner">
        <p class="text-xs uppercase tracking-[.25em] text-gold">Masih satu kategori</p>
        <h2 class="mt-3 font-heading text-3xl text-white">Perlengkapan terkait</h2>
        <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($relatedProducts as $related)
                <a href="{{ route('catalog.show', $related) }}" class="group border border-white/10 bg-charcoal-100 p-4 hover:border-gold/40">
                    <img src="{{ $related->getThumbnailUrl() }}" alt="{{ $related->name }}" class="aspect-[4/3] w-full object-cover" loading="lazy">
                    <p class="mt-4 font-heading text-lg text-white group-hover:text-gold">{{ $related->name }}</p>
                    <span class="mt-3 inline-block text-xs uppercase tracking-wider text-gold">Lihat detail &rarr;</span>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif
<div class="fixed inset-x-0 bottom-0 z-40 border-t border-gold/25 bg-charcoal/95 p-3 backdrop-blur md:hidden">
    <x-whatsapp-cta class="btn-gold w-full justify-center" label="Pesan via WhatsApp" :message="$product->getWhatsappMessage()" />
</div>
@endsection

@push('structured-data')
    @php
        $productSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $product->name,
            'description' => strip_tags($product->description),
            'image' => $product->getThumbnailUrl('large'),
            'category' => $product->category?->name,
            'brand' => ['@type' => 'Brand', 'name' => 'Aliman Pilar Production'],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($productSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>
@endpush
