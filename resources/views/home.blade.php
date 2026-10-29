@extends('layouts.app')

@section('title', ($settings['site_name'] ?? config('app.name')).' — Pilar Penopang Acara Anda')
@section('description', $settings['site_description'] ?? 'Sewa tenda event, genset, LED screen, sound system, panggung, dan perlengkapan produksi. Konsultasi langsung dengan Aliman Pilar Production.')

@section('content')
<section class="relative flex min-h-[90svh] items-center overflow-hidden bg-charcoal">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_72%_35%,rgba(255,215,0,.13),transparent_42%)]"></div>
    <div class="pointer-events-none absolute right-[-.08em] top-1/2 -translate-y-1/2 select-none font-heading text-[36vw] font-bold leading-none text-white/[.025]">P</div>
    <div class="section-inner relative z-10 grid items-center gap-10 pb-20 pt-32 lg:grid-cols-[1.15fr_.85fr] lg:items-start lg:pb-28">
        <div>
            <p class="mb-7 flex items-center gap-4 text-[.65rem] uppercase tracking-[.4em] text-gold"><span class="h-px w-10 bg-gold"></span> Aliman Pilar Production</p>
            <h1 class="max-w-5xl font-heading text-5xl font-bold leading-[1.04] text-white sm:text-7xl lg:text-[clamp(4rem,5.4vw,4.9rem)]">Fondasi kuat<br>untuk <span class="text-gold-gradient">acara besar.</span></h1>
            <p class="mt-8 max-w-xl text-base leading-7 text-white/65 md:text-lg">Kami adalah pilar penopang acara Anda. Peralatan yang siap, koordinasi yang rapi, dan tim teknis yang menjaga setiap momen tetap berjalan.</p>
            <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                <a href="{{ route('catalog.index') }}" class="btn-gold justify-center">Jelajahi Produk <span aria-hidden="true">&rarr;</span></a>
                <x-whatsapp-cta class="btn-outline-gold justify-center" label="Pesan via WhatsApp" message="Halo Aliman Pilar Production, saya ingin berkonsultasi untuk kebutuhan event. Mohon informasi lebih lanjut." />
            </div>
            <div class="mt-12 flex flex-wrap gap-x-8 gap-y-3 border-t border-white/[.06] pt-5 text-xs uppercase tracking-[.15em] text-white/45">
                <span>Corporate</span><span>Pameran</span><span>Wedding</span><span>Konser</span><span>Turnamen</span><span>Festival</span>
            </div>
        </div>
        <div class="relative mx-auto mt-3 w-full max-w-[23rem] lg:ml-auto lg:mr-0 lg:mt-[2.55rem] lg:max-w-[27rem]">
            <div class="relative grid aspect-square place-items-center overflow-hidden rounded-[1.75rem] border border-gold/20 bg-[#0a0a0a] p-4 shadow-[0_0_80px_rgba(255,215,0,0.08)] sm:p-5">
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,rgba(255,215,0,.12),transparent_60%)]"></div>
                <div class="absolute inset-x-[12%] top-0 h-px bg-gradient-to-r from-transparent via-gold/70 to-transparent"></div>
                <img
                    src="{{ asset('images/logo.jpeg') }}"
                    alt="Logo Aliman Pilar Production"
                    class="relative z-10 h-full w-full object-contain drop-shadow-[0_20px_48px_rgba(255,215,0,0.18)]"
                    fetchpriority="high"
                >
            </div>
        </div>
    </div>
</section>

<section class="border-y border-gold/15 bg-charcoal-100 py-8">
    <div class="section-inner grid grid-cols-2 gap-6 text-center md:grid-cols-4">
        <div><p class="font-heading text-3xl text-gold">{{ $categories->count() }}</p><p class="mt-1 text-[.6rem] uppercase tracking-[.18em] text-white/45">Kategori produk</p></div>
        <div><p class="font-heading text-3xl text-gold">{{ $totalProducts }}</p><p class="mt-1 text-[.6rem] uppercase tracking-[.18em] text-white/45">Pilihan produk</p></div>
        <div><p class="font-heading text-3xl text-gold">{{ $featuredPortfolios->count() }}</p><p class="mt-1 text-[.6rem] uppercase tracking-[.18em] text-white/45">Dokumentasi unggulan</p></div>
        <div><p class="font-heading text-3xl text-gold">{{ $clients->count() }}</p><p class="mt-1 text-[.6rem] uppercase tracking-[.18em] text-white/45">Klien/mitra terdaftar*</p></div>
        <p class="col-span-full text-[.6rem] text-white/35">*Konten klien, testimoni, dan portofolio yang ditandai [CONTOH] harus diganti atau dihapus sebelum publikasi.</p>
    </div>
</section>

<section class="border-y border-gold/15 bg-charcoal-100 py-16 md:py-20">
    <div class="section-inner grid gap-10 lg:grid-cols-[.75fr_1.25fr]">
        <div>
            <p class="text-xs uppercase tracking-[.3em] text-gold">I — Prinsip kami</p>
            <h2 class="mt-4 font-heading text-3xl leading-tight text-white md:text-4xl">Bukan hanya menyewakan alat. Kami menopang jalannya acara.</h2>
        </div>
        <div class="grid gap-7 sm:grid-cols-2">
            @foreach([
                ['Peralatan terawat','Pemeriksaan kesiapan sebelum perlengkapan diberangkatkan.'],
                ['Teknisi di lokasi','Dukungan tim untuk instalasi, koordinasi, dan kebutuhan acara.'],
                ['Antar & pemasangan','Pengiriman dan instalasi diselaraskan dengan jadwal venue.'],
                ['Satu pintu','Tenda, audio, daya, visual, panggung, dan kebutuhan pendukung.'],
            ] as [$title,$description])
                <article class="border-l border-gold/55 pl-4">
                    <h3 class="font-heading text-xl text-white">{{ $title }}</h3>
                    <p class="mt-2 text-sm leading-6 text-white/55">{{ $description }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section-wrap bg-charcoal">
    <div class="section-inner">
        <div class="mb-10 flex flex-col justify-between gap-5 md:flex-row md:items-end">
            <div><p class="text-xs uppercase tracking-[.3em] text-gold">II — Kategori produk</p><h2 class="mt-3 font-heading text-3xl text-white md:text-5xl">Perlengkapan yang<br>tersedia untuk acara Anda.</h2></div>
            <a href="{{ route('catalog.index') }}" class="text-xs uppercase tracking-[.2em] text-gold hover:text-white">Jelajahi semua kategori &rarr;</a>
        </div>
        <div class="grid auto-rows-[190px] grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">
            @foreach($categories as $index => $category)
                @php
                    $categoryProduct = $category->activeProducts->first();
                @endphp
                <a href="{{ route('catalog.index', ['kategori' => $category->slug]) }}" class="{{ in_array($index % 7, [0, 5], true) ? 'row-span-2' : '' }} group relative overflow-hidden border border-white/[.06] bg-charcoal-100">
                    <img src="{{ $categoryProduct->getThumbnailUrl('large') }}" alt="{{ $categoryProduct->name }}" class="absolute inset-0 h-full w-full object-cover opacity-55 transition duration-700 group-hover:scale-105 group-hover:opacity-80" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/25 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 border-l-2 border-gold p-4 md:p-5">
                        <p class="text-[.6rem] uppercase tracking-[.2em] text-gold">{{ $category->active_products_count }} pilihan</p>
                        <h3 class="mt-1 font-heading text-lg text-white md:text-xl">{{ $category->name }}</h3>
                    </div>
                    <span class="absolute right-4 top-4 text-xs tracking-widest text-gold opacity-0 transition group-hover:opacity-100" aria-label="Kategori unggulan">★★★</span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="section-wrap bg-charcoal-100">
    <div class="section-inner">
        <div class="mb-10 flex flex-col justify-between gap-5 md:flex-row md:items-end">
            <div><p class="text-xs uppercase tracking-[.3em] text-gold">III — Produk dengan foto</p><h2 class="mt-3 font-heading text-3xl text-white md:text-5xl">Peralatan yang<br>tersedia saat ini.</h2></div>
            <a href="{{ route('catalog.index') }}" class="text-xs uppercase tracking-[.2em] text-gold hover:text-white">Lihat semua produk &rarr;</a>
        </div>
        <div class="space-y-5">
            @forelse($featuredProducts as $index => $product)
                <article class="grid overflow-hidden border border-white/[.06] transition hover:border-gold/40 md:grid-cols-2">
                    <a href="{{ route('catalog.show', $product) }}" class="{{ $index % 2 ? 'md:order-2' : '' }} relative block min-h-64 overflow-hidden bg-charcoal">
                        <img src="{{ $product->getThumbnailUrl('large') }}" alt="{{ $product->name }}" class="absolute inset-0 h-full w-full object-cover transition duration-700 hover:scale-105" loading="lazy">
                        @if($product->is_featured)
                            <span class="absolute left-5 top-5 text-sm tracking-[.35em] text-gold" aria-label="Produk unggulan">★★★</span>
                        @endif
                    </a>
                    <div class="{{ $index % 2 ? 'md:order-1' : '' }} flex flex-col justify-center p-7 md:p-10">
                        <p class="text-xs uppercase tracking-[.25em] text-gold">{{ $product->category?->name }}</p>
                        <h3 class="mt-3 font-heading text-2xl text-white md:text-3xl"><a href="{{ route('catalog.show', $product) }}" class="hover:text-gold">{{ $product->name }}</a></h3>
                        <p class="mt-4 line-clamp-3 text-sm leading-7 text-white/55">{{ $product->description }}</p>
                        @if($product->capacity)<p class="mt-4 border-l border-gold/50 pl-3 text-sm text-white/65">{{ $product->capacity }}</p>@endif
                        <div class="mt-6 flex flex-wrap items-center gap-4">
                            <x-whatsapp-cta class="btn-gold text-xs" label="Tanyakan Ketersediaan" :message="$product->getWhatsappMessage()" />
                            <a href="{{ route('catalog.show', $product) }}" class="text-xs uppercase tracking-wider text-white/45 hover:text-gold">Spesifikasi &rarr;</a>
                        </div>
                    </div>
                </article>
            @empty
                <p class="border border-white/[.06] p-8 text-white/55">Produk unggulan akan ditampilkan setelah katalog dikelola.</p>
            @endforelse
        </div>
    </div>
</section>

<section class="section-wrap bg-charcoal">
    <div class="section-inner">
        <div class="mb-10 flex flex-col justify-between gap-5 md:flex-row md:items-end">
            <div><p class="text-xs uppercase tracking-[.3em] text-gold">IV — Dokumentasi</p><h2 class="mt-3 font-heading text-3xl text-white md:text-5xl">Pilar yang sama,<br>cerita acara yang beragam.</h2></div>
            <a href="{{ route('portfolio.index') }}" class="text-xs uppercase tracking-[.2em] text-gold hover:text-white">Seluruh portofolio &rarr;</a>
        </div>
        @if($featuredPortfolios->isNotEmpty())
            <div class="grid gap-4 md:grid-cols-12">
                @foreach($featuredPortfolios->take(4) as $index => $portfolio)
                    <article class="{{ $index === 0 ? 'md:col-span-7 md:row-span-2' : 'md:col-span-5' }} group relative min-h-64 overflow-hidden bg-charcoal-100">
                        <a href="{{ route('portfolio.show', $portfolio) }}" class="absolute inset-0">
                            <img src="{{ $portfolio->getCoverUrl('large') }}" alt="Placeholder dokumentasi {{ $portfolio->title }} — ganti dengan foto event asli" class="h-full w-full object-cover transition duration-700 group-hover:scale-105" loading="lazy">
                            <span class="absolute inset-0 bg-gradient-to-t from-black via-black/15 to-transparent"></span>
                            <span class="absolute bottom-0 p-6">
                                <span class="text-[.6rem] uppercase tracking-[.25em] text-gold">{{ $portfolio->event_type }} · {{ $portfolio->location }}</span>
                                <span class="mt-2 block font-heading text-2xl text-white">{{ $portfolio->title }}</span>
                            </span>
                        </a>
                        <div class="absolute right-4 top-4"><x-whatsapp-cta class="btn-gold text-[10px]" label="Event serupa" :message="$portfolio->getWhatsappMessage()" /></div>
                    </article>
                @endforeach
            </div>
        @else
            <p class="border border-white/[.06] p-8 text-white/55">Dokumentasi akan ditambahkan setelah portofolio tersedia.</p>
        @endif
    </div>
</section>

<section class="border-y border-gold/15 bg-charcoal-100 py-16 md:py-20">
    <div class="section-inner grid gap-10 lg:grid-cols-[.8fr_1.2fr]">
        <div>
            <p class="text-xs uppercase tracking-[.3em] text-gold">Cara kerja</p>
            <h2 class="mt-4 font-heading text-3xl text-white md:text-4xl">Dari kebutuhan awal hingga siap di lokasi.</h2>
            <p class="mt-4 leading-7 text-white/55">Seluruh konsultasi, pengecekan ketersediaan, dan kesepakatan layanan dilakukan langsung bersama tim melalui WhatsApp.</p>
            <a href="{{ route('how-to-order') }}" class="mt-6 inline-block text-xs uppercase tracking-widest text-gold">Pelajari cara pemesanan &rarr;</a>
        </div>
        <div class="grid gap-6 sm:grid-cols-2">
            @foreach([['01','Ceritakan acara'],['02','Pilih peralatan'],['03','Cek jadwal & teknis'],['04','Sepakati pelaksanaan']] as [$n,$label])
                <div class="flex items-center gap-4 border-b border-white/[.06] pb-4"><span class="font-heading text-3xl text-gold">{{ $n }}</span><span class="text-sm text-white/75">{{ $label }}</span></div>
            @endforeach
            <div class="sm:col-span-2"><x-whatsapp-cta class="btn-gold text-xs" label="Mulai percakapan WhatsApp" message="Halo Aliman Pilar Production, saya ingin mendiskusikan kebutuhan event saya." /></div>
        </div>
    </div>
</section>

@if($testimonials->isNotEmpty())
<section class="section-wrap bg-charcoal">
    <div class="section-inner">
        <div class="mb-10"><p class="text-xs uppercase tracking-[.3em] text-gold">Kesan kolaborasi</p><h2 class="mt-3 font-heading text-3xl text-white md:text-4xl">Kepercayaan dibangun<br>dari detail yang terjaga.</h2></div>
        <div class="grid gap-5 md:grid-cols-2">
            @foreach($testimonials->take(4) as $testimonial)
                <figure class="border-l border-gold/60 bg-charcoal-100 p-6 md:p-8">
                    <div class="text-sm tracking-[.25em] text-gold" aria-label="Penilaian {{ $testimonial->rating }} dari 5">{{ str_repeat('★', $testimonial->rating) }}<span class="text-white/20">{{ str_repeat('★', 5 - $testimonial->rating) }}</span></div>
                    <blockquote class="mt-4 font-heading text-xl leading-relaxed text-white">“{{ $testimonial->content }}”</blockquote>
                    <figcaption class="mt-6 text-xs uppercase tracking-wider text-white/45">{{ $testimonial->client_name }} · {{ $testimonial->client_title }}</figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($clients->isNotEmpty())
<section class="border-y border-white/[.06] bg-charcoal-100 py-12">
    <div class="section-inner">
        <p class="mb-7 text-center text-[.6rem] uppercase tracking-[.3em] text-white/40">Klien & mitra — ganti contoh sebelum publikasi</p>
        <div class="flex flex-wrap items-center justify-center gap-x-10 gap-y-5">
            @foreach($clients as $client)
                <span class="font-heading text-sm text-white/45">{{ $client->name }}</span>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="section-wrap bg-charcoal">
    <div class="section-inner grid items-start gap-10 lg:grid-cols-[.8fr_1.2fr] lg:gap-16">
        <div class="max-w-lg">
            <p class="flex items-center gap-3 text-xs uppercase tracking-[.3em] text-gold"><span class="h-px w-8 bg-gold"></span> Jangkauan layanan</p>
            <h2 class="mt-5 font-heading text-3xl leading-tight text-white md:text-4xl">Dukungan produksi, dekat dengan lokasi acara Anda.</h2>
            <p class="mt-5 leading-7 text-white/55">Kami melayani berbagai kebutuhan event. Jangkauan pengiriman dan kesiapan tim dikonfirmasi berdasarkan alamat, akses venue, serta jadwal acara.</p>
        </div>
        <div class="overflow-hidden rounded-xl border border-gold/20 bg-charcoal-100 shadow-[0_20px_60px_rgba(0,0,0,.28)]">
            <div class="grid gap-6 p-5 sm:grid-cols-2 sm:p-7">
                <div class="min-w-0">
                    <p class="text-[.65rem] uppercase tracking-[.22em] text-gold">Cakupan layanan</p>
                    <p class="mt-3 text-sm leading-6 text-white/75">{{ $settings['service_areas'] ?: 'Hubungi tim kami untuk mengecek jangkauan layanan.' }}</p>
                </div>
                <div class="min-w-0 border-t border-white/[.06] pt-5 sm:border-l sm:border-t-0 sm:pl-6 sm:pt-0">
                    <p class="text-[.65rem] uppercase tracking-[.22em] text-gold">Alamat kantor</p>
                    <p class="mt-3 text-sm leading-6 text-white/75">{{ $settings['address'] ?: 'Alamat kantor belum diatur.' }}</p>
                    @if($settings['address'])
                        <a href="https://www.google.com/maps/search/?api=1&amp;query={{ urlencode($settings['address']) }}" target="_blank" rel="noopener noreferrer" class="mt-3 inline-flex items-center gap-2 text-xs font-semibold text-gold transition hover:text-white">
                            Buka petunjuk arah <span aria-hidden="true">&rarr;</span>
                        </a>
                    @endif
                </div>
            </div>
            @if($settings['address'])
                <iframe
                    title="Peta lokasi Aliman Pilar Production"
                    src="{{ $settings['google_maps_embed'] ?: 'https://www.google.com/maps?q='.urlencode($settings['address']).'&output=embed' }}"
                    class="h-64 w-full border-y border-white/[.06] bg-black sm:h-72"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
            @endif
            <div class="flex flex-col gap-3 p-5 sm:flex-row sm:items-center sm:justify-between sm:px-7">
                <p class="text-xs leading-5 text-white/45">Lokasi acara Anda di luar area tersebut? Hubungi tim untuk konfirmasi.</p>
                <x-whatsapp-cta class="btn-outline-gold justify-center text-xs" label="Konfirmasi area layanan" message="Halo Aliman Pilar Production, mohon konfirmasi layanan untuk lokasi acara saya." />
            </div>
        </div>
    </div>
</section>

@if($latestPosts->isNotEmpty())
<section class="section-wrap bg-charcoal-100">
    <div class="section-inner">
        <div class="mb-9 flex items-end justify-between gap-4">
            <div><p class="text-xs uppercase tracking-[.3em] text-gold">Catatan produksi</p><h2 class="mt-3 font-heading text-3xl text-white md:text-4xl">Bekal untuk acara<br>yang lebih matang.</h2></div>
            <a href="{{ route('blog.index') }}" class="hidden text-xs uppercase tracking-widest text-gold sm:block">Baca semua artikel &rarr;</a>
        </div>
        <div class="grid gap-5 md:grid-cols-3">
            @foreach($latestPosts as $post)
                <article class="group border border-white/[.06]">
                    <a href="{{ route('blog.show', $post) }}" class="block overflow-hidden"><img src="{{ $post->getFeaturedImageUrl() }}" alt="Foto artikel {{ $post->title }}" class="aspect-[4/3] w-full object-cover transition duration-700 group-hover:scale-105" loading="lazy"></a>
                    <div class="p-5">
                        <p class="text-[.6rem] uppercase tracking-[.2em] text-gold">{{ $post->blogCategory?->name }}</p>
                        <h3 class="mt-3 font-heading text-xl leading-snug text-white group-hover:text-gold"><a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a></h3>
                        <p class="mt-3 line-clamp-3 text-sm leading-6 text-white/50">{{ $post->excerpt }}</p>
                    </div>
                </article>
            @endforeach
        </div>
        <a href="{{ route('blog.index') }}" class="mt-6 inline-block text-xs uppercase tracking-widest text-gold sm:hidden">Baca semua artikel &rarr;</a>
    </div>
</section>
@endif

<section class="relative overflow-hidden bg-black py-24 md:py-32">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,rgba(255,215,0,.12),transparent_55%)]"></div>
    <div class="section-inner relative text-center">
        <span class="text-xs tracking-[.6em] text-gold">★ ★ ★</span>
        <p class="mt-5 text-xs uppercase tracking-[.35em] text-gold">Pilar penopang acara Anda</p>
        <h2 class="mx-auto mt-5 max-w-4xl font-heading text-4xl font-bold text-white md:text-6xl">Satu percakapan bisa merapikan banyak hal.</h2>
        <p class="mx-auto mt-5 max-w-xl leading-7 text-white/55">Ceritakan rencana acara Anda. Kami bantu merangkai perlengkapan dan dukungan yang diperlukan.</p>
        <div class="mt-8"><x-whatsapp-cta class="btn-gold px-8 py-4" label="Diskusikan kebutuhan acara" message="Halo Aliman Pilar Production, saya ingin berkonsultasi tentang kebutuhan perlengkapan untuk acara saya." /></div>
    </div>
</section>
@endsection

@push('structured-data')
    @php
        $businessSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => $settings['site_name'] ?? 'Aliman Pilar Production',
            'description' => $settings['site_description'] ?? 'Penyewaan perlengkapan event dan dukungan teknis.',
            'url' => url('/'),
            'image' => asset('images/logo.jpeg'),
        ];
        if (!empty($settings['address'])) {
            $businessSchema['address'] = ['@type' => 'PostalAddress', 'streetAddress' => $settings['address'], 'addressCountry' => 'ID'];
        }
        if (!empty($settings['email'])) {
            $businessSchema['email'] = $settings['email'];
        }
        if (!empty($settings['phone_main'])) {
            $businessSchema['telephone'] = $settings['phone_main'];
        }
        if (!empty($settings['service_areas'])) {
            $businessSchema['areaServed'] = $settings['service_areas'];
        }
    @endphp
    <script type="application/ld+json">{!! json_encode($businessSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>
@endpush
