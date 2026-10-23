@extends('layouts.app')

@section('content')
<article class="bg-charcoal">
    <header class="section-inner max-w-4xl pb-12 pt-32 md:pt-40">
        <a href="{{ route('blog.index') }}" class="text-xs uppercase tracking-[.2em] text-gold">&larr; Semua artikel</a>
        <p class="mt-8 text-xs uppercase tracking-[.2em] text-gold">{{ $blogPost->blogCategory?->name ?? 'Artikel' }} · {{ optional($blogPost->published_at)->translatedFormat('d F Y') }}</p>
        <h1 class="mt-4 font-heading text-4xl font-bold leading-tight text-white md:text-6xl">{{ $blogPost->title }}</h1>
        <p class="mt-5 text-lg leading-8 text-white/60">{{ $blogPost->excerpt }}</p>
    </header>
    <div class="section-inner max-w-5xl">
        <img src="{{ $blogPost->getFeaturedImageUrl('large') }}" alt="{{ $blogPost->title }}" class="max-h-[620px] w-full object-cover">
    </div>
    <div class="section-inner grid max-w-5xl gap-12 py-14 lg:grid-cols-[1fr_250px]">
        <div class="whitespace-pre-line leading-8 text-white/70">{{ strip_tags($blogPost->content) }}</div>
        <aside class="h-fit border border-gold/20 bg-charcoal-100 p-6">
            <p class="text-xs uppercase tracking-[.2em] text-gold">Sedang merencanakan acara?</p>
            <p class="mt-3 text-sm leading-6 text-white/60">Diskusikan kebutuhan perlengkapan dengan tim kami.</p>
            <div class="mt-5"><x-whatsapp-cta class="btn-gold w-full justify-center text-xs" label="Konsultasi WhatsApp" message="Halo Aliman Pilar Production, saya membaca artikel {{ $blogPost->title }} dan ingin berkonsultasi tentang kebutuhan event." /></div>
        </aside>
    </div>
</article>
@if($related->isNotEmpty())
    <section class="section-wrap bg-charcoal-100">
        <div class="section-inner">
            <h2 class="font-heading text-3xl text-white">Artikel terkait</h2>
            <div class="mt-6 grid gap-5 md:grid-cols-3">
                @foreach($related as $post)
                    <a href="{{ route('blog.show', $post) }}" class="border border-white/10 p-5 hover:border-gold/40">
                        <p class="font-heading text-xl text-white">{{ $post->title }}</p>
                        <p class="mt-3 line-clamp-3 text-sm text-white/55">{{ $post->excerpt }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif
@endsection
