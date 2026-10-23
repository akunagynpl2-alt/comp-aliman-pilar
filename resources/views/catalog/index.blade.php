@extends('layouts.app')

@section('content')
<section class="relative overflow-hidden border-b border-gold/15 bg-charcoal py-24 md:py-32">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,rgba(255,215,0,.08),transparent_55%)]"></div>
    <div class="section-inner relative">
        <p class="mb-5 text-xs uppercase tracking-[.35em] text-gold">Produk perlengkapan</p>
        <h1 class="max-w-4xl font-heading text-4xl font-bold leading-tight text-white md:text-6xl">Perlengkapan tepat,<br><span class="text-gold-gradient">acara lebih mantap.</span></h1>
        <p class="mt-6 max-w-2xl leading-7 text-white/60">Jelajahi pilihan peralatan event kami. Konsultasikan kebutuhan, ketersediaan, dan konfigurasi langsung bersama tim melalui WhatsApp.</p>
    </div>
</section>

<section class="section-wrap bg-charcoal-100">
    <div class="section-inner">
        <form method="GET" action="{{ route('catalog.index') }}" class="mb-10 grid gap-3 border border-white/10 bg-black/30 p-4 md:grid-cols-[1fr_260px_auto]">
            <label class="sr-only" for="catalog-search">Cari perlengkapan</label>
            <input id="catalog-search" class="form-dark" type="search" name="cari" value="{{ request('cari') }}" placeholder="Cari nama, kapasitas, atau kebutuhan...">
            <label class="sr-only" for="catalog-category">Pilih kategori</label>
            <select id="catalog-category" class="form-dark" name="kategori">
                <option value="">Semua kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->slug }}" @selected(request('kategori') === $category->slug)>{{ $category->name }}</option>
                @endforeach
            </select>
            <button class="btn-gold justify-center" type="submit">Terapkan</button>
        </form>

        <div class="mb-8 flex items-end justify-between gap-4">
            <div>
                <p class="text-xs uppercase tracking-[.25em] text-gold">{{ $selectedCategory?->name ?? 'Pilihan untuk setiap acara' }}</p>
                <h2 class="mt-2 font-heading text-2xl text-white md:text-3xl">Temukan kebutuhan Anda</h2>
            </div>
            <p class="text-sm text-white/45">{{ $products->total() }} perlengkapan</p>
        </div>

        @if($products->isNotEmpty())
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($products as $product)
                    <article class="group overflow-hidden border border-white/10 bg-black/35 transition hover:border-gold/40">
                        <a href="{{ route('catalog.show', $product) }}" class="relative block aspect-[4/3] overflow-hidden bg-charcoal">
                            <img src="{{ $product->getThumbnailUrl() }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-105" loading="lazy">
                            @if($product->is_featured)
                                <span class="absolute left-4 top-4 text-sm text-gold" aria-label="Produk unggulan">★★★</span>
                            @endif
                        </a>
                        <div class="p-5">
                            <p class="text-xs uppercase tracking-[.2em] text-gold">{{ $product->category?->name }}</p>
                            <h3 class="mt-2 font-heading text-xl text-white"><a href="{{ route('catalog.show', $product) }}" class="hover:text-gold">{{ $product->name }}</a></h3>
                            <p class="mt-3 line-clamp-3 text-sm leading-6 text-white/55">{{ $product->description }}</p>
                            @if($product->capacity)
                                <p class="mt-4 border-l border-gold/60 pl-3 text-xs leading-5 text-white/65">{{ $product->capacity }}</p>
                            @endif
                            <div class="mt-5 flex flex-wrap items-center gap-3">
                                <x-whatsapp-cta class="btn-gold text-xs" label="Tanyakan Ketersediaan" :message="$product->getWhatsappMessage()" />
                                <a href="{{ route('catalog.show', $product) }}" class="text-xs uppercase tracking-wider text-white/55 hover:text-gold">Lihat detail &rarr;</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="mt-10">{{ $products->links() }}</div>
        @else
            <div class="border border-white/10 px-6 py-16 text-center">
                <h3 class="font-heading text-2xl text-white">Belum ada perlengkapan yang cocok</h3>
                <p class="mt-3 text-sm text-white/55">Ubah kata pencarian atau pilih kategori lain.</p>
                <a href="{{ route('catalog.index') }}" class="btn-outline-gold mt-6">Tampilkan semua</a>
            </div>
        @endif
    </div>
</section>
@endsection
