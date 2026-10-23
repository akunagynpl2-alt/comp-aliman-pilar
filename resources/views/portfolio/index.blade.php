@extends('layouts.app')

@section('content')
<section class="bg-charcoal py-28 md:py-36">
    <div class="section-inner">
        <p class="text-xs uppercase tracking-[.3em] text-gold">Jejak kolaborasi</p>
        <h1 class="mt-4 max-w-3xl font-heading text-4xl font-bold text-white md:text-6xl">Pilar yang hadir<br><span class="text-gold-gradient">di balik banyak cerita.</span></h1>
        <p class="mt-6 max-w-2xl leading-7 text-white/60">Dokumentasi pilihan dari event yang kami dukung bersama klien dan mitra.</p>
        <form method="GET" class="mt-8 flex flex-col gap-3 sm:flex-row">
            <label class="sr-only" for="event-type">Jenis acara</label>
            <select id="event-type" name="jenis" class="form-dark max-w-sm">
                <option value="">Semua jenis acara</option>
                @foreach($eventTypes as $eventType)
                    <option value="{{ $eventType }}" @selected(request('jenis') === $eventType)>{{ $eventType }}</option>
                @endforeach
            </select>
            <button class="btn-outline-gold justify-center" type="submit">Tampilkan</button>
        </form>
    </div>
</section>
<section class="section-wrap bg-charcoal-100">
    <div class="section-inner">
        @if($portfolios->isNotEmpty())
            <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                @foreach($portfolios as $portfolio)
                    <article class="group relative overflow-hidden border border-white/10 bg-charcoal">
                        <a href="{{ route('portfolio.show', $portfolio) }}" class="block">
                            <img src="{{ $portfolio->getCoverUrl() }}" alt="Dokumentasi {{ $portfolio->title }}" class="aspect-[4/3] w-full object-cover transition duration-700 group-hover:scale-105" loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
                            <div class="absolute inset-x-0 bottom-0 p-6">
                                <p class="text-xs uppercase tracking-[.2em] text-gold">{{ $portfolio->event_type }} · {{ $portfolio->location }}</p>
                                <h2 class="mt-2 font-heading text-2xl text-white">{{ $portfolio->title }}</h2>
                                <p class="mt-2 text-sm text-white/60">{{ $portfolio->client }}</p>
                            </div>
                        </a>
                        <div class="border-t border-white/10 p-4">
                            <x-whatsapp-cta class="btn-outline-gold w-full justify-center text-xs" label="Diskusikan event serupa" :message="$portfolio->getWhatsappMessage()" />
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="mt-10">{{ $portfolios->links() }}</div>
        @else
            <p class="border border-white/10 p-10 text-center text-white/60">Dokumentasi untuk pilihan ini akan segera ditambahkan.</p>
        @endif
    </div>
</section>
@endsection
