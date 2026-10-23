@extends('layouts.app')

@section('title', '404 – Halaman Tidak Ditemukan')

@section('content')
<div class="min-h-screen bg-charcoal flex items-center justify-center relative overflow-hidden">

    {{-- Background ornament --}}
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none select-none">
        <span class="font-heading font-bold text-white/[0.02]" style="font-size: 40vw; line-height: 1;">404</span>
    </div>

    {{-- Vertical gold line left --}}
    <div class="absolute left-8 md:left-16 top-1/4 bottom-1/4 w-[2px] bg-gradient-to-b from-transparent via-gold to-transparent opacity-40"></div>
    <div class="absolute right-8 md:right-16 top-1/4 bottom-1/4 w-[2px] bg-gradient-to-b from-transparent via-gold to-transparent opacity-40"></div>

    <div class="relative z-10 text-center px-6 max-w-xl mx-auto">
        {{-- Section marker --}}
        <p class="font-body text-[0.6rem] tracking-[0.5em] text-gold/60 uppercase mb-8">Aliman Pilar Production</p>

        {{-- 404 Number --}}
        <div class="relative inline-block mb-6">
            <span class="font-heading font-black text-gold leading-none" style="font-size: clamp(5rem, 20vw, 12rem);">404</span>
        </div>

        {{-- Gold divider --}}
        <div class="flex items-center justify-center gap-4 mb-8">
            <div class="h-[1px] w-16 bg-gold/40"></div>
            <span class="text-gold text-xs">✦</span>
            <div class="h-[1px] w-16 bg-gold/40"></div>
        </div>

        {{-- Message --}}
        <h1 class="font-heading font-bold text-2xl md:text-3xl text-white mb-4">
            Halaman Tidak Ditemukan
        </h1>
        <p class="font-body text-white/50 text-base leading-relaxed mb-10">
            Halaman yang Anda cari telah dipindahkan, dihapus, atau mungkin belum pernah ada.
            Biarkan kami membantu Anda kembali ke jalur yang benar.
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('home') }}" class="btn-gold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Kembali ke Beranda
            </a>
            <a href="{{ route('catalog.index') }}" class="btn-outline-gold">
                Lihat Produk
            </a>
        </div>
    </div>
</div>
@endsection
