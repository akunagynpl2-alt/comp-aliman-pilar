@extends('layouts.app')

@section('content')
<section class="bg-charcoal py-28 md:py-36">
    <div class="section-inner grid gap-14 lg:grid-cols-[.8fr_1.2fr]">
        <div>
            <p class="text-xs uppercase tracking-[.3em] text-gold">Mari berdiskusi</p>
            <h1 class="mt-4 font-heading text-4xl font-bold leading-tight text-white md:text-6xl">Ceritakan acara<br>yang Anda siapkan.</h1>
            <p class="mt-6 max-w-lg leading-7 text-white/60">Bagikan kebutuhan awal Anda. Tim kami akan membantu mengarahkan perlengkapan dan dukungan teknis yang sesuai.</p>
            <div class="mt-10 space-y-5 border-l border-gold/40 pl-5 text-sm">
                <div><p class="text-xs uppercase tracking-widest text-gold">WhatsApp</p><p class="mt-1 text-white">{{ $primaryWa?->number ?? $settings['phone_main'] ?? 'Nomor belum diatur' }}</p></div>
                <div><p class="text-xs uppercase tracking-widest text-gold">Alamat</p><p class="mt-1 leading-6 text-white/65">{{ $settings['address'] ?: 'Alamat kantor belum diatur' }}</p></div>
                <div><p class="text-xs uppercase tracking-widest text-gold">Email</p><p class="mt-1 text-white">{{ $settings['email'] ?: 'Email belum diatur' }}</p></div>
                <div><p class="text-xs uppercase tracking-widest text-gold">Area layanan</p><p class="mt-1 leading-6 text-white/65">{{ $settings['service_areas'] ?: 'Area layanan akan diperbarui.' }}</p></div>
                <div><p class="text-xs uppercase tracking-widest text-gold">Jam operasional</p><p class="mt-1 leading-6 text-white/65">{{ $settings['operating_hours'] ?: 'Senin–Sabtu, 08.00–20.00 WIB' }}</p></div>
            </div>
        </div>

        <div class="border border-white/10 bg-charcoal-100 p-6 md:p-9">
            @if(session('success'))
                <div role="status" class="mb-6 border border-gold/30 bg-gold/5 p-4 text-sm leading-6 text-white">
                    {{ session('success') }}
                    @if(session('wa_message'))
                        <div class="mt-4">
                            <x-whatsapp-cta class="btn-gold text-xs" label="Pilih tim dan lanjut ke WhatsApp" :message="session('wa_message')" />
                        </div>
                    @endif
                </div>
            @endif
            <h2 class="font-heading text-2xl text-white">Form konsultasi</h2>
            <p class="mt-2 text-sm text-white/50">Tanda * menunjukkan informasi wajib.</p>
            <form method="POST" action="{{ route('contact.store') }}" class="mt-7 space-y-5">
                @csrf
                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="name" class="mb-2 block text-sm text-white/75">Nama *</label>
                        <input id="name" name="name" value="{{ old('name') }}" required maxlength="100" autocomplete="name" class="form-dark" aria-describedby="name-error">
                        @error('name')<p id="name-error" class="mt-2 text-xs text-red-300">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="phone" class="mb-2 block text-sm text-white/75">Nomor telepon *</label>
                        <input id="phone" name="phone" value="{{ old('phone') }}" required maxlength="20" autocomplete="tel" class="form-dark" aria-describedby="phone-error">
                        @error('phone')<p id="phone-error" class="mt-2 text-xs text-red-300">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div>
                    <label for="email" class="mb-2 block text-sm text-white/75">Email (opsional)</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" maxlength="100" autocomplete="email" class="form-dark">
                    @error('email')<p class="mt-2 text-xs text-red-300">{{ $message }}</p>@enderror
                </div>
                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="event_type" class="mb-2 block text-sm text-white/75">Jenis acara</label>
                        <select id="event_type" name="event_type" class="form-dark">
                            <option value="">Pilih jenis acara</option>
                            @foreach(['Corporate event', 'Pameran', 'Pernikahan', 'Konser', 'Turnamen', 'Festival', 'Lainnya'] as $type)
                                <option value="{{ $type }}" @selected(old('event_type') === $type)>{{ $type }}</option>
                            @endforeach
                        </select>
                        @error('event_type')<p class="mt-2 text-xs text-red-300">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="event_date" class="mb-2 block text-sm text-white/75">Tanggal acara</label>
                        <input id="event_date" type="date" name="event_date" min="{{ now()->addDay()->toDateString() }}" value="{{ old('event_date') }}" class="form-dark">
                        @error('event_date')<p class="mt-2 text-xs text-red-300">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div>
                    <label for="event_location" class="mb-2 block text-sm text-white/75">Lokasi acara</label>
                    <input id="event_location" name="event_location" value="{{ old('event_location') }}" maxlength="200" class="form-dark">
                    @error('event_location')<p class="mt-2 text-xs text-red-300">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="needs" class="mb-2 block text-sm text-white/75">Kebutuhan perlengkapan *</label>
                    <textarea id="needs" name="needs" rows="5" required maxlength="2000" class="form-dark" placeholder="Contoh: tenda, flooring, sound system, kebutuhan kapasitas...">{{ old('needs') }}</textarea>
                    @error('needs')<p class="mt-2 text-xs text-red-300">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="btn-gold w-full justify-center">Kirim & lanjut konsultasi</button>
                <p class="text-xs leading-5 text-white/40">Informasi digunakan untuk menindaklanjuti konsultasi Anda. Tidak ada transaksi yang diproses di situs ini.</p>
            </form>
        </div>
    </div>
</section>
@if($settings['address'])
<section class="bg-charcoal-100 pb-20">
    <div class="section-inner">
        <h2 class="mb-5 font-heading text-2xl text-white">Lokasi kami</h2>
        <iframe
            title="Peta lokasi Aliman Pilar Production"
            src="{{ $settings['google_maps_embed'] ?: 'https://www.google.com/maps?q='.urlencode($settings['address']).'&output=embed' }}"
            class="h-80 w-full border border-white/10 grayscale"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
        <a href="https://www.google.com/maps/search/?api=1&amp;query={{ urlencode($settings['address']) }}" target="_blank" rel="noopener noreferrer" class="mt-4 inline-flex text-sm text-gold hover:text-white">
            Buka petunjuk arah di Google Maps &rarr;
        </a>
    </div>
</section>
@endif
@endsection
