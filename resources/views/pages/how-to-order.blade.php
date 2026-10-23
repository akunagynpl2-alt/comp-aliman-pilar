@extends('layouts.app')

@section('content')
<section class="bg-charcoal py-32 md:py-40">
    <div class="section-inner">
        <p class="text-xs uppercase tracking-[.3em] text-gold">Cara pemesanan</p>
        <h1 class="mt-4 max-w-4xl font-heading text-4xl font-bold text-white md:text-6xl">Mulai dari percakapan,<br><span class="text-gold-gradient">rencana jadi lebih jelas.</span></h1>
        <p class="mt-6 max-w-2xl leading-7 text-white/60">Seluruh konsultasi ketersediaan, penyesuaian kebutuhan, dan kesepakatan layanan dilakukan langsung melalui WhatsApp.</p>
    </div>
</section>
<section class="section-wrap bg-charcoal-100">
    <div class="section-inner grid gap-8 md:grid-cols-2">
        @foreach([['I','Ceritakan acara','Sampaikan jenis acara, tanggal, lokasi, perkiraan kebutuhan, dan hal teknis yang perlu diperhatikan.'],['II','Pilih perlengkapan','Telusuri katalog dan diskusikan pilihan peralatan atau konfigurasi yang cocok dengan venue.'],['III','Konfirmasi ketersediaan','Tim kami memeriksa jadwal, kebutuhan pengiriman, pemasangan, dan dukungan teknis.'],['IV','Sepakati pelaksanaan','Rincian layanan dan ketentuan disepakati langsung dengan tim sebelum persiapan dimulai.']] as [$number,$title,$description])
            <article class="border border-white/10 p-7 md:p-9"><p class="font-heading text-6xl text-gold/45">{{ $number }}</p><h2 class="mt-5 font-heading text-2xl text-white">{{ $title }}</h2><p class="mt-3 leading-7 text-white/55">{{ $description }}</p></article>
        @endforeach
    </div>
    <div class="section-inner mt-10"><x-whatsapp-cta class="btn-gold" label="Mulai konsultasi" message="Halo Aliman Pilar Production, saya ingin berkonsultasi mengenai rencana event. Berikut informasi awal acara saya:" /></div>
</section>
@endsection
