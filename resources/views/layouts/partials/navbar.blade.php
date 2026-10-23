{{-- resources/views/layouts/partials/navbar.blade.php --}}
<nav
    x-data="{
        open: false,
        scrolled: false,
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 40;
            });
        }
    }"
    :class="scrolled ? 'bg-charcoal/95 backdrop-blur-md shadow-lg border-b border-gold/10' : 'bg-transparent'"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-500"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="group flex items-center">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Logo Aliman Pilar Production" class="h-16 w-16 object-contain">
            </a>

            {{-- Desktop Navigation --}}
            <div class="hidden lg:flex items-center gap-8">
                @php
                    $navLinks = [
                        ['route' => 'home',       'label' => 'Beranda'],
                        ['route' => 'catalog.index',    'active' => 'catalog.*', 'label' => 'Produk'],
                        ['route' => 'portfolio.index',  'active' => 'portfolio.*', 'label' => 'Portofolio'],
                        ['route' => 'blog.index',       'active' => 'blog.*', 'label' => 'Blog'],
                        ['route' => 'about',      'label' => 'Tentang Kami'],
                        ['route' => 'contact.index',    'active' => 'contact.*', 'label' => 'Kontak'],
                    ];
                @endphp

                @foreach ($navLinks as $link)
                    <a
                        href="{{ route($link['route']) }}"
                        class="relative font-body text-sm tracking-wide text-white/80 hover:text-gold transition-colors duration-300 group py-1
                               {{ request()->routeIs($link['active'] ?? $link['route']) ? 'text-gold' : '' }}"
                    >
                        {{ $link['label'] }}
                        <span class="absolute bottom-0 left-0 w-0 h-[1px] bg-gold transition-all duration-300
                                     group-hover:w-full
                                     {{ request()->routeIs($link['active'] ?? $link['route']) ? 'w-full' : '' }}">
                        </span>
                    </a>
                @endforeach

                <a
                    href="{{ route('contact.index') }}"
                    class="btn-gold text-xs tracking-widest uppercase ml-4"
                >
                    Hubungi Kami
                </a>
            </div>

            {{-- Mobile Hamburger --}}
            <button
                @click="open = !open"
                class="lg:hidden flex flex-col gap-[5px] p-2 group"
                aria-label="Toggle menu"
            >
                <span :class="open ? 'rotate-45 translate-y-[7px] bg-gold' : 'bg-white'"
                      class="block w-6 h-[2px] transition-all duration-300"></span>
                <span :class="open ? 'opacity-0 w-0' : 'bg-white'"
                      class="block w-6 h-[2px] transition-all duration-300"></span>
                <span :class="open ? '-rotate-45 -translate-y-[7px] bg-gold' : 'bg-white'"
                      class="block w-6 h-[2px] transition-all duration-300"></span>
            </button>
        </div>
    </div>

    {{-- Mobile Dropdown --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="lg:hidden bg-charcoal-100/98 backdrop-blur-md border-t border-gold/20"
    >
        <div class="max-w-7xl mx-auto px-4 py-6 flex flex-col gap-1">
            @foreach ($navLinks as $link)
                <a
                    href="{{ route($link['route']) }}"
                    @click="open = false"
                    class="flex items-center gap-3 px-4 py-3 font-body text-sm text-white/80 hover:text-gold hover:bg-gold/5 transition-all duration-200
                           {{ request()->routeIs($link['active'] ?? $link['route']) ? 'text-gold border-l-2 border-gold pl-5' : '' }}"
                >
                    {{ $link['label'] }}
                </a>
            @endforeach
            <div class="mt-4 pt-4 border-t border-white/10">
                <a
                    href="{{ route('contact.index') }}"
                    @click="open = false"
                    class="btn-gold w-full justify-center text-xs tracking-widest uppercase"
                >
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</nav>
