@extends('layouts.app')

@section('content')
<section class="relative overflow-hidden bg-charcoal py-32 md:py-44">
    <div class="absolute inset-y-0 left-[12%] w-px bg-gradient-to-b from-transparent via-gold/50 to-transparent"></div>
    <div class="section-inner relative">
        <p class="text-xs uppercase tracking-[.35em] text-gold">Tentang Aliman Pilar</p>
        <h1 class="mt-5 max-w-5xl font-heading text-5xl font-bold leading-tight text-white md:text-7xl">Kami menjadi pilar<br><span class="text-gold-gradient">di balik acara yang kuat.</span></h1>
        <p class="mt-8 max-w-2xl text-lg leading-8 text-white/60">Aliman Pilar Production membantu penyelenggara merangkai kebutuhan teknis dan perlengkapan event dalam satu koordinasi yang andal—sejak persiapan hingga acara selesai.</p>
    </div>
</section>
<section class="section-wrap bg-charcoal-100">
    <div class="section-inner grid gap-16 lg:grid-cols-2">
        <div>
            <p class="text-xs uppercase tracking-[.25em] text-gold">Cerita kami</p>
            <h2 class="mt-4 font-heading text-3xl leading-tight text-white md:text-4xl">Fondasi yang baik membuat setiap detail bekerja.</h2>
            <p class="mt-6 leading-8 text-white/60">Berangkat dari kebutuhan lapangan yang terus berkembang, kami membangun layanan rental perlengkapan yang berorientasi pada kesiapan alat, komunikasi yang jelas, dan dukungan teknis yang bertanggung jawab. Konten profil ini merupakan materi awal dan perlu disesuaikan dengan sejarah perusahaan yang sebenarnya.</p>
        </div>
        <div class="space-y-8">
            <div class="border-l-2 border-gold pl-6"><p class="text-xs uppercase tracking-[.2em] text-gold">Visi</p><p class="mt-3 font-heading text-2xl leading-relaxed text-white">Menjadi mitra produksi event yang dipercaya karena kesiapan dan konsistensi.</p></div>
            <div class="border-l-2 border-gold/50 pl-6"><p class="text-xs uppercase tracking-[.2em] text-gold">Misi</p><ul class="mt-3 space-y-3 leading-7 text-white/60"><li>Menyediakan peralatan yang terawat dan sesuai spesifikasi.</li><li>Menghadirkan tim teknis yang komunikatif dan sigap.</li><li>Menyederhanakan koordinasi perlengkapan dalam satu layanan.</li></ul></div>
        </div>
    </div>
</section>
<section class="section-wrap bg-charcoal">
    <div class="section-inner">
        <p class="text-xs uppercase tracking-[.25em] text-gold">Nilai kerja</p>
        <div class="mt-8 grid gap-8 md:grid-cols-3">
            @foreach([['01','Andal','Persiapan yang terukur dan perlengkapan yang siap digunakan.'],['02','Terbuka','Komunikasi kebutuhan dan batas teknis sejak awal.'],['03','Kolaboratif','Tim bekerja menyatu dengan penyelenggara dan venue.']] as [$number,$title,$description])
                <article class="border-t border-gold/40 pt-5"><p class="font-heading text-5xl text-gold/40">{{ $number }}</p><h2 class="mt-4 font-heading text-2xl text-white">{{ $title }}</h2><p class="mt-3 leading-7 text-white/55">{{ $description }}</p></article>
            @endforeach
        </div>
    </div>
</section>
<section class="bg-charcoal-100 py-16"><div class="section-inner flex flex-col items-start justify-between gap-6 md:flex-row md:items-center"><div><h2 class="font-heading text-3xl text-white">Rencanakan event bersama kami.</h2><p class="mt-2 text-white/55">Tim kami siap membantu menyusun kebutuhan peralatan Anda.</p></div><x-whatsapp-cta class="btn-gold" label="Konsultasi via WhatsApp" /></div></section>
@endsection
