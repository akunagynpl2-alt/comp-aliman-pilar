@extends('layouts.app')

@section('content')
<article class="bg-charcoal">
    <section class="relative flex min-h-[70vh] items-end overflow-hidden pt-28">
        <img src="{{ $portfolio->getCoverUrl('large') }}" alt="Dokumentasi {{ $portfolio->title }}" class="absolute inset-0 h-full w-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/55 to-black/15"></div>
        <div class="section-inner relative z-10 pb-14 md:pb-20">
            <a href="{{ route('portfolio.index') }}" class="text-xs uppercase tracking-[.2em] text-gold">&larr; Portofolio</a>
            <p class="mt-8 text-xs uppercase tracking-[.25em] text-gold">{{ $portfolio->event_type }} · {{ $portfolio->location }}</p>
            <h1 class="mt-4 max-w-4xl font-heading text-4xl font-bold text-white md:text-6xl">{{ $portfolio->title }}</h1>
            <p class="mt-4 text-white/70">{{ $portfolio->client }}@if($portfolio->event_date) · {{ $portfolio->event_date->translatedFormat('d F Y') }}@endif</p>
            <div class="mt-7"><x-whatsapp-cta class="btn-gold" label="Rencanakan event serupa" :message="$portfolio->getWhatsappMessage()" /></div>
        </div>
    </section>
    <section class="section-wrap bg-charcoal-100">
        <div class="section-inner grid gap-12 lg:grid-cols-[1fr_280px]">
            <div>
                <p class="text-xs uppercase tracking-[.25em] text-gold">Cerita di balik acara</p>
                <div class="mt-5 whitespace-pre-line leading-8 text-white/65">{{ strip_tags($portfolio->content ?: $portfolio->description) }}</div>
                @if($portfolio->equipment_used)
                    <h2 class="mt-10 font-heading text-2xl text-white">Peralatan pendukung</h2>
                    <ul class="mt-4 space-y-2 text-white/65">
                        @foreach($portfolio->equipment_used as $equipment)
                            <li class="border-l border-gold/60 pl-4">{{ $equipment }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <aside class="h-fit border border-white/10 p-6">
                <p class="text-xs uppercase tracking-[.2em] text-gold">Ringkasan event</p>
                <dl class="mt-5 space-y-4 text-sm">
                    <div><dt class="text-white/40">Klien</dt><dd class="mt-1 text-white">{{ $portfolio->client }}</dd></div>
                    <div><dt class="text-white/40">Lokasi</dt><dd class="mt-1 text-white">{{ $portfolio->location }}</dd></div>
                    <div><dt class="text-white/40">Jenis acara</dt><dd class="mt-1 text-white">{{ $portfolio->event_type }}</dd></div>
                    @if($portfolio->event_date)<div><dt class="text-white/40">Tanggal</dt><dd class="mt-1 text-white">{{ $portfolio->event_date->translatedFormat('d F Y') }}</dd></div>@endif
                </dl>
            </aside>
        </div>
    </section>
    @if($portfolio->getMedia('images')->isNotEmpty())
        <section class="section-wrap bg-charcoal">
            <div class="section-inner">
                <h2 class="font-heading text-3xl text-white">Momen pilihan</h2>
                <div class="mt-7 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($portfolio->getMedia('images') as $image)
                        <img src="{{ $image->getUrl('large') }}" alt="Galeri {{ $portfolio->title }}" class="aspect-[4/3] w-full object-cover" loading="lazy">
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</article>
@endsection
