@extends('layouts.admin')
@section('page-title', 'Detail pesan')
@section('content')
<div class="mx-auto max-w-4xl p-6 md:p-10">
    <a href="{{ route('admin.pesan.index') }}" class="text-xs uppercase tracking-widest text-gold">&larr; Pesan masuk</a>
    <h1 class="mt-5 font-heading text-3xl text-white">{{ $message->name }}</h1>
    <dl class="mt-7 grid gap-5 border border-white/10 p-6 sm:grid-cols-2">
        @foreach(['phone' => 'Telepon', 'email' => 'Email', 'event_type' => 'Jenis acara', 'event_date' => 'Tanggal acara', 'event_location' => 'Lokasi'] as $key => $label)
            <div><dt class="text-xs uppercase tracking-wider text-gold">{{ $label }}</dt><dd class="mt-2 text-white/75">{{ $message->$key ?: '—' }}</dd></div>
        @endforeach
        <div class="sm:col-span-2"><dt class="text-xs uppercase tracking-wider text-gold">Kebutuhan</dt><dd class="mt-2 whitespace-pre-line leading-7 text-white/75">{{ $message->needs }}</dd></div>
    </dl>
    <div class="mt-6 flex flex-wrap gap-3">
        <a href="{{ $message->phone ? 'https://wa.me/'.preg_replace('/\D/', '', $message->phone).'?text='.rawurlencode('Halo '.$message->name.', kami menerima konsultasi event Anda.') : '#' }}" target="_blank" rel="noopener noreferrer" class="btn-gold">Balas via WhatsApp</a>
        <form method="POST" action="{{ route('admin.pesan.destroy', $message) }}" onsubmit="return confirm('Hapus pesan ini?')">@csrf @method('DELETE')<button class="btn-outline-gold" type="submit">Hapus pesan</button></form>
    </div>
</div>
@endsection
