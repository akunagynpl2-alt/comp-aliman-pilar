@extends('layouts.admin')
@section('page-title', 'Dashboard')
@section('content')
<div class="mx-auto max-w-6xl p-6 md:p-10">
    <p class="text-xs uppercase tracking-[.25em] text-gold">Ringkasan operasional</p>
    <h1 class="mt-2 font-heading text-3xl text-white">Dashboard</h1>
    @if(session('success'))<p role="status" class="mt-6 border border-green-700/40 bg-green-900/20 p-4 text-sm text-green-200">{{ session('success') }}</p>@endif
    <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach([
            ['total_categories','Kategori'],
            ['total_products','Produk'],
            ['total_portfolios','Portofolio'],
            ['total_blog_posts','Artikel blog'],
            ['total_testimonials','Testimoni'],
            ['unread_messages','Pesan belum dibaca'],
        ] as [$key,$label])
            <article class="border border-white/10 bg-black/20 p-6"><p class="text-xs uppercase tracking-wider text-white/45">{{ $label }}</p><p class="mt-3 font-heading text-4xl text-gold">{{ number_format($stats[$key]) }}</p></article>
        @endforeach
    </div>
    <div class="mt-9 border-l-2 border-gold pl-5 text-sm leading-6 text-white/55">Konten yang belum diverifikasi sebagai data perusahaan sebaiknya tetap ditandai sebagai contoh dan jangan ditayangkan sebagai klaim aktual.</div>
</div>
@endsection
