{{-- resources/views/layouts/partials/footer.blade.php --}}
<footer class="bg-charcoal-100 border-t-2 border-gold/40">

    {{-- Main footer grid --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8">

            {{-- Col 1: Brand + Sosmed --}}
            <div class="lg:col-span-1">
                <a href="{{ route('home') }}" class="mb-6 inline-block">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Logo Aliman Pilar Production" class="h-20 w-20 object-contain">
                </a>

                <div class="w-8 h-[2px] bg-gold mb-6"></div>

                <p class="font-body text-sm text-white/60 leading-relaxed mb-8">
                    Pilar Penopang Acara Anda. Kami menyediakan perlengkapan event berkualitas tinggi untuk menjadikan setiap momen tak terlupakan.
                </p>

                {{-- Sosial media --}}
                <div class="flex items-center gap-4">
                    <a href="{{ $settings['instagram'] ?: route('contact.index') }}" aria-label="Instagram" class="w-9 h-9 flex items-center justify-center border border-white/10 text-white/40 hover:border-gold hover:text-gold transition-all duration-300">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="{{ $settings['facebook'] ?: route('contact.index') }}" aria-label="Facebook" class="w-9 h-9 flex items-center justify-center border border-white/10 text-white/40 hover:border-gold hover:text-gold transition-all duration-300">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="{{ $settings['youtube'] ?: route('contact.index') }}" aria-label="YouTube" class="w-9 h-9 flex items-center justify-center border border-white/10 text-white/40 hover:border-gold hover:text-gold transition-all duration-300">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                </div>
            </div>

            {{-- Col 2: Navigasi Utama --}}
            <div>
                <h4 class="font-heading font-semibold text-sm tracking-[0.2em] uppercase text-white mb-6">Navigasi</h4>
                <ul class="space-y-3">
                    @foreach ([
                        ['route' => 'home',      'label' => 'Beranda'],
                        ['route' => 'catalog.index',   'label' => 'Produk'],
                        ['route' => 'portfolio.index', 'label' => 'Portofolio'],
                        ['route' => 'blog.index',      'label' => 'Blog & Inspirasi'],
                        ['route' => 'about',     'label' => 'Tentang Kami'],
                        ['route' => 'contact.index',   'label' => 'Kontak'],
                    ] as $link)
                        <li>
                            <a href="{{ route($link['route']) }}"
                               class="font-body text-sm text-white/50 hover:text-gold transition-colors duration-200 flex items-center gap-2 group">
                                <span class="w-3 h-[1px] bg-gold/30 group-hover:w-5 group-hover:bg-gold transition-all duration-300"></span>
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Col 3: Layanan --}}
            <div>
                <h4 class="font-heading font-semibold text-sm tracking-[0.2em] uppercase text-white mb-6">Layanan</h4>
                <ul class="space-y-3">
                    @php
                        $services = [
                            'Sound System', 'Lighting', 'LED Screen & Backdrop',
                            'Tenda & Dekorasi', 'Stage & Panggung', 'Generator & Power',
                        ];
                    @endphp
                    @foreach ($services as $service)
                        <li>
                            <a href="{{ route('catalog.index') }}"
                               class="font-body text-sm text-white/50 hover:text-gold transition-colors duration-200 flex items-center gap-2 group">
                                <span class="w-3 h-[1px] bg-gold/30 group-hover:w-5 group-hover:bg-gold transition-all duration-300"></span>
                                {{ $service }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Col 4: Kontak + Jam Operasional --}}
            <div>
                <h4 class="font-heading font-semibold text-sm tracking-[0.2em] uppercase text-white mb-6">Kontak</h4>
                <ul class="space-y-4 mb-8">
                    <li>
                        <div class="font-body text-sm text-white/60 flex items-start gap-3">
                            <svg class="w-4 h-4 text-gold mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.124.555 4.12 1.524 5.857L.057 23.215a.75.75 0 0 0 .918.919l5.418-1.461A11.944 11.944 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.907 0-3.692-.516-5.223-1.415l-.374-.222-3.876 1.046 1.063-3.768-.238-.39A9.953 9.953 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
                            @if($primaryWa)
                                <a href="{{ $primaryWa->getWhatsappLink() }}" target="_blank" rel="noopener noreferrer" class="hover:text-gold">{{ $primaryWa->number }}</a>
                            @else
                                <span>{{ $settings['phone_main'] ?: 'WhatsApp belum diatur' }}</span>
                            @endif
                        </div>
                    </li>
                    <li>
                        <a href="mailto:{{ $settings['email'] ?: 'info@example.invalid' }}"
                           class="font-body text-sm text-white/60 hover:text-gold transition-colors duration-200 flex items-start gap-3">
                            <svg class="w-4 h-4 text-gold mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>{{ $settings['email'] ?: 'Email belum diatur' }}</span>
                        </a>
                    </li>
                    <li>
                        <div class="font-body text-sm text-white/60 flex items-start gap-3">
                            <svg class="w-4 h-4 text-gold mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>
                                {{ $settings['address'] ?: 'Alamat kantor belum diatur' }}
                                @if($settings['address'])
                                    <a href="https://www.google.com/maps/search/?api=1&amp;query={{ urlencode($settings['address']) }}" target="_blank" rel="noopener noreferrer" class="mt-2 inline-block text-gold hover:text-white">Lihat di Google Maps &rarr;</a>
                                @endif
                            </span>
                        </div>
                    </li>
                </ul>

                <div class="border-t border-white/10 pt-5">
                    <p class="font-body text-xs text-white/40 uppercase tracking-widest mb-2">Jam Operasional</p>
                    <p class="font-body text-sm text-white/60">{{ $settings['operating_hours'] ?: 'Senin–Sabtu: 08.00–20.00 WIB' }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom bar --}}
    <div class="border-t border-gold/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="font-body text-xs text-white/30">
                &copy; {{ date('Y') }} <span class="text-gold/60">Aliman Pilar Production</span>. Seluruh hak cipta dilindungi.
            </p>
            <div class="flex items-center gap-6">
                <a href="{{ route('privacy-policy') }}" class="font-body text-xs text-white/30 hover:text-gold/70 transition-colors duration-200">Kebijakan Privasi</a>
                <a href="{{ route('terms') }}" class="font-body text-xs text-white/30 hover:text-gold/70 transition-colors duration-200">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>
</footer>
