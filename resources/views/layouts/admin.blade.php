<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">

    <title>@yield('page-title', 'Dashboard') — Aliman Pilar Admin</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="font-body antialiased" style="background:#0f0f0f; color:#fff;">

<div x-data="{ sidebarOpen: window.innerWidth >= 1024 }" class="flex h-screen overflow-hidden">

    {{-- =========================================
         SIDEBAR
    ========================================= --}}
    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        class="fixed lg:relative z-40 inset-y-0 left-0 w-64 flex flex-col
               bg-charcoal-100 border-r border-gold/20
               transform transition-transform duration-300 ease-in-out"
        style="background:#111111;"
    >
        {{-- Sidebar Header --}}
        <div class="flex items-center justify-between px-5 py-5 border-b border-gold/20">
            <div>
                <div class="flex items-center gap-1.5">
                    <span class="text-gold text-[10px]">✦</span>
                    <span class="font-heading font-bold text-base tracking-[0.15em] text-white">ALIMAN PILAR</span>
                    <span class="text-gold text-[10px]">✦</span>
                </div>
                <p class="font-body text-[0.5rem] tracking-[0.3em] text-gold/60 uppercase mt-0.5 pl-3">ADMIN PANEL</p>
            </div>
            <button @click="sidebarOpen = false" class="lg:hidden text-white/40 hover:text-gold transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- Navigation Items --}}
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-0.5">
            @php
                $menuItems = [
                    ['route' => 'admin.dashboard',    'icon' => 'grid',        'label' => 'Dashboard'],
                    ['route' => 'admin.kategori.index',   'icon' => 'tag',       'label' => 'Kategori'],
                    ['route' => 'admin.produk.index',     'icon' => 'package',   'label' => 'Produk'],
                    ['route' => 'admin.portofolio.index', 'icon' => 'image',     'label' => 'Portofolio'],
                    ['route' => 'admin.blog.index',       'icon' => 'file-text', 'label' => 'Blog'],
                    ['route' => 'admin.blog-kategori.index', 'icon' => 'tag',    'label' => 'Kategori blog'],
                    ['route' => 'admin.testimoni.index',  'icon' => 'star',      'label' => 'Testimoni'],
                    ['route' => 'admin.klien.index',      'icon' => 'users',     'label' => 'Klien'],
                    ['route' => 'admin.pesan.index',      'icon' => 'mail',      'label' => 'Pesan'],
                    ['route' => 'admin.whatsapp-nomor.index', 'icon' => 'phone', 'label' => 'WhatsApp'],
                    ['route' => 'admin.whatsapp-template.index', 'icon' => 'file-text', 'label' => 'Template WhatsApp'],
                    ['route' => 'admin.pengaturan.index', 'icon' => 'settings',  'label' => 'Pengaturan'],
                ];
                // SVG path data untuk setiap icon
                $iconPaths = [
                    'grid'      => 'M3 3h7v7H3zM14 3h7v7h-7zM14 14h7v7h-7zM3 14h7v7H3z',
                    'tag'       => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z',
                    'package'   => 'M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16zM3.27 6.96L12 12.01l8.73-5.05M12 22.08V12',
                    'image'     => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
                    'file-text' => 'M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z M14 2v6h6 M16 13H8 M16 17H8 M10 9H8',
                    'star'      => 'M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z',
                    'users'     => 'M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2 M23 21v-2a4 4 0 00-3-3.87 M16 3.13a4 4 0 010 7.75 M9 7a4 4 0 100 8 4 4 0 000-8z',
                    'mail'      => 'M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z M22 6l-10 7L2 6',
                    'phone'     => 'M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.68A2 2 0 012 .18h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 14.92v2z',
                    'settings'  => 'M12 15a3 3 0 100-6 3 3 0 000 6z M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z',
                ];
            @endphp

            @foreach ($menuItems as $item)
                @php
                    $activePattern = preg_replace('/\.index$/', '.*', $item['route']);
                    $isActive = request()->routeIs($activePattern);
                    $path = $iconPaths[$item['icon']] ?? '';
                @endphp
                <a
                    href="{{ route($item['route']) }}"
                    class="flex items-center gap-3 px-4 py-2.5 text-sm font-body font-medium rounded-none transition-all duration-200
                           {{ $isActive
                               ? 'text-gold bg-gold/10 border-l-2 border-gold pl-5'
                               : 'text-white/50 hover:text-gold hover:bg-white/5 hover:pl-6 border-l-2 border-transparent' }}"
                >
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $path }}"/>
                    </svg>
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        {{-- Sidebar Footer: User + Logout --}}
        <div class="border-t border-gold/20 p-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-8 h-8 rounded-full bg-gold/20 flex items-center justify-center">
                    <span class="font-heading font-bold text-gold text-sm">
                        {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                    </span>
                </div>
                <div class="min-w-0">
                    <p class="font-body text-xs font-semibold text-white truncate">{{ auth()->user()->name ?? 'Administrator' }}</p>
                    <p class="font-body text-[10px] text-white/40 truncate">{{ auth()->user()->email ?? '' }}</p>
                </div>
            </div>
            <a href="{{ route('admin.profil.edit') }}" class="mb-2 block text-xs text-gold hover:text-white">Ubah profil admin</a>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-2 px-3 py-2 text-xs font-body text-white/40 hover:text-red-400 transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- Sidebar overlay mobile --}}
    <div
        x-show="sidebarOpen && window.innerWidth < 1024"
        @click="sidebarOpen = false"
        class="fixed inset-0 z-30 bg-black/60 lg:hidden"
        x-transition:enter="transition-opacity ease-in duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    ></div>

    {{-- =========================================
         MAIN AREA
    ========================================= --}}
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        {{-- Topbar --}}
        <header class="flex items-center justify-between px-6 py-4 border-b border-gold/10" style="background:#111111;">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = !sidebarOpen" class="text-white/40 hover:text-gold transition-colors lg:hidden">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <h1 class="font-heading font-semibold text-lg text-white tracking-wide">
                    @yield('page-title', 'Dashboard')
                </h1>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" target="_blank"
                   class="font-body text-xs text-white/40 hover:text-gold transition-colors flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Lihat Website
                </a>
                <div class="w-8 h-8 rounded-full bg-gold/20 flex items-center justify-center">
                    <span class="font-heading font-bold text-gold text-sm">
                        {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                    </span>
                </div>
            </div>
        </header>

        {{-- Flash Messages --}}
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition
                 class="mx-6 mt-5 flex items-center justify-between gap-3 px-5 py-3 bg-green-900/30 border border-green-500/30 text-green-400 font-body text-sm">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
                <button @click="show = false" class="text-green-400/60 hover:text-green-400 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div x-data="{ show: true }" x-show="show" x-transition
                 class="mx-6 mt-5 flex items-center justify-between gap-3 px-5 py-3 bg-red-900/30 border border-red-500/30 text-red-400 font-body text-sm">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('error') }}
                </div>
                <button @click="show = false" class="text-red-400/60 hover:text-red-400 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div x-data="{ show: true }" x-show="show" x-transition
                 class="mx-6 mt-5 px-5 py-3 bg-red-900/30 border border-red-500/30 font-body text-sm">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-red-400 font-semibold">Terdapat kesalahan:</span>
                    <button @click="show = false" class="text-red-400/60 hover:text-red-400 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-red-300">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Page Content --}}
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>
    </div>
</div>

{{-- Alpine.js --}}
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

@stack('scripts')
</body>
</html>
