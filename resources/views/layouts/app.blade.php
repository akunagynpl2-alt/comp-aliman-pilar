<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(class_exists(\Artesaos\SEOTools\Facades\SEOMeta::class))
        {!! SEOMeta::generate() !!}
        {!! OpenGraph::generate() !!}
    @else
        <title>@yield('title', $settings['site_name'] ?? config('app.name', 'Aliman Pilar Production'))</title>
        <meta name="description" content="@yield('description', 'Pilar penopang acara Anda dengan perlengkapan event dan dukungan teknis profesional.')">
    @endif
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', $settings['site_name'] ?? config('app.name'))">
    <meta name="twitter:description" content="@yield('description', 'Pilar penopang acara Anda dengan perlengkapan event dan dukungan teknis profesional.')">
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @stack('structured-data')
</head>
<body class="overflow-x-hidden bg-charcoal font-body text-white antialiased">
    @include('layouts.partials.navbar')
    <main>@yield('content')</main>
    @include('layouts.partials.footer')

    <x-whatsapp-cta
        class="float-wa group"
        label="WhatsApp"
        message="Halo Aliman Pilar Production, saya ingin menanyakan informasi penyewaan perlengkapan event."
    />

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('sr-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.sr-init').forEach((element) => observer.observe(element));
        });
    </script>
    @stack('scripts')
</body>
</html>
