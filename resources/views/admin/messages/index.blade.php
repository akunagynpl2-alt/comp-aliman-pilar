@extends('layouts.admin')
@section('page-title', 'Pesan masuk')
@section('content')
<div class="mx-auto max-w-6xl p-6 md:p-10">
    <h1 class="font-heading text-3xl text-white">Pesan masuk</h1>
    @if(session('success'))<p class="mt-5 border border-green-700/40 bg-green-900/20 p-4 text-sm text-green-200">{{ session('success') }}</p>@endif
    <div class="mt-8 divide-y divide-white/10 border-y border-white/10">
        @forelse($messages as $message)
            <a href="{{ route('admin.pesan.show', $message) }}" class="flex flex-wrap items-center justify-between gap-3 py-5 hover:bg-white/[.03]">
                <span><strong class="text-white">{{ $message->name }}</strong><span class="ml-3 text-xs text-gold">{{ $message->is_read ? 'Dibaca' : 'Baru' }}</span><span class="mt-1 block text-sm text-white/55">{{ $message->event_type ?: 'Konsultasi umum' }} · {{ $message->phone }}</span></span>
                <span class="text-xs text-white/40">{{ $message->created_at->format('d M Y, H:i') }} &rarr;</span>
            </a>
        @empty
            <p class="py-12 text-center text-white/50">Belum ada pesan masuk.</p>
        @endforelse
    </div>
    <div class="mt-6">{{ $messages->links() }}</div>
</div>
@endsection
