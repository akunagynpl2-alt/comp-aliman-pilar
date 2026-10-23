@extends('layouts.admin')
@section('page-title', 'Pengaturan situs')
@section('content')
<div class="mx-auto max-w-5xl p-6 md:p-10">
    <div>
        <p class="text-xs uppercase tracking-[.25em] text-gold">Konten global</p>
        <h1 class="mt-2 font-heading text-3xl text-white">Pengaturan situs</h1>
    </div>
    @if(session('success'))<p role="status" class="mt-6 border border-green-700/40 bg-green-900/20 p-4 text-sm text-green-200">{{ session('success') }}</p>@endif
    @if($errors->any())<div role="alert" class="mt-6 border border-red-500/30 bg-red-950/30 p-4 text-sm text-red-200">{{ $errors->first() }}</div>@endif
    <form method="POST" action="{{ route('admin.pengaturan.update') }}" class="mt-8 space-y-10">
        @csrf
        @foreach($settings as $group => $items)
            <section class="border border-white/10 bg-black/20 p-6 md:p-8">
                <h2 class="mb-6 font-heading text-2xl capitalize text-white">{{ str_replace('_', ' ', $group) }}</h2>
                <div class="grid gap-6 md:grid-cols-2">
                    @foreach($items as $setting)
                        <div class="{{ $setting->type === 'textarea' ? 'md:col-span-2' : '' }}">
                            <label for="setting-{{ $setting->key }}" class="mb-2 block text-sm text-white/75">{{ $setting->label }}</label>
                            @if($setting->type === 'textarea')
                                <textarea id="setting-{{ $setting->key }}" name="settings[{{ $setting->key }}]" rows="4" maxlength="5000" class="form-dark">{{ old('settings.'.$setting->key, $setting->value) }}</textarea>
                            @else
                                <input id="setting-{{ $setting->key }}" name="settings[{{ $setting->key }}]" value="{{ old('settings.'.$setting->key, $setting->value) }}" maxlength="5000" class="form-dark">
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach
        <button type="submit" class="btn-gold">Simpan semua pengaturan</button>
    </form>
</div>
@endsection
