@extends('layouts.app')

@section('content')
<section class="bg-charcoal py-28 md:py-36">
    <div class="section-inner">
        <p class="text-xs uppercase tracking-[.3em] text-gold">Catatan produksi</p>
        <h1 class="mt-4 font-heading text-4xl font-bold text-white md:text-6xl">Ide baik membuat<br><span class="text-gold-gradient">acara lebih berarti.</span></h1>
        <form method="GET" class="mt-8 grid gap-3 sm:grid-cols-[1fr_260px_auto]">
            <label class="sr-only" for="article-search">Cari artikel</label>
            <input id="article-search" type="search" name="cari" value="{{ request('cari') }}" class="form-dark" placeholder="Cari inspirasi dan tips event">
            <label class="sr-only" for="article-category">Kategori artikel</label>
            <select id="article-category" name="kategori" class="form-dark">
                <option value="">Semua topik</option>
                @foreach($categories as $category)
                    <option value="{{ $category->slug }}" @selected(request('kategori') === $category->slug)>{{ $category->name }}</option>
                @endforeach
            </select>
            <button class="btn-gold justify-center" type="submit">Cari</button>
        </form>
    </div>
</section>
<section class="section-wrap bg-charcoal-100">
    <div class="section-inner">
        @if($posts->isNotEmpty())
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($posts as $post)
                    <article class="group overflow-hidden border border-white/10 bg-charcoal">
                        <a href="{{ route('blog.show', $post) }}" class="block overflow-hidden">
                            <img src="{{ $post->getFeaturedImageUrl() }}" alt="{{ $post->title }}" class="aspect-[4/3] w-full object-cover transition duration-700 group-hover:scale-105" loading="lazy">
                        </a>
                        <div class="p-6">
                            <p class="text-xs uppercase tracking-[.2em] text-gold">{{ $post->blogCategory?->name ?? 'Artikel' }} · {{ optional($post->published_at)->translatedFormat('d F Y') }}</p>
                            <h2 class="mt-3 font-heading text-2xl text-white group-hover:text-gold"><a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a></h2>
                            <p class="mt-3 text-sm leading-6 text-white/55">{{ $post->excerpt }}</p>
                            <a href="{{ route('blog.show', $post) }}" class="mt-5 inline-block text-xs uppercase tracking-widest text-gold">Baca artikel &rarr;</a>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="mt-10">{{ $posts->links() }}</div>
        @else
            <p class="border border-white/10 p-10 text-center text-white/60">Artikel pilihan sedang disiapkan.</p>
        @endif
    </div>
</section>
@endsection
