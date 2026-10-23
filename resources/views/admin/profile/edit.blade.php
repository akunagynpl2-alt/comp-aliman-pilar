@extends('layouts.admin')
@section('page-title', 'Profil admin')
@section('content')
<div class="mx-auto max-w-3xl p-6 md:p-10">
    <h1 class="font-heading text-3xl text-white">Profil admin</h1>
    @if(session('success'))<p role="status" class="mt-6 border border-green-700/40 bg-green-900/20 p-4 text-sm text-green-200">{{ session('success') }}</p>@endif
    @if($errors->any())<div role="alert" class="mt-6 border border-red-500/30 bg-red-950/30 p-4 text-sm text-red-200">{{ $errors->first() }}</div>@endif
    <form method="POST" action="{{ route('admin.profil.update') }}" class="mt-8 space-y-5 border border-white/10 bg-black/20 p-6">
        @csrf @method('PUT')
        <div><label for="name" class="mb-2 block text-sm text-white/75">Nama</label><input id="name" name="name" required value="{{ old('name', $user->name) }}" class="form-dark"></div>
        <div><label for="email" class="mb-2 block text-sm text-white/75">Email</label><input id="email" type="email" name="email" required value="{{ old('email', $user->email) }}" class="form-dark"></div>
        <div><label for="phone" class="mb-2 block text-sm text-white/75">Telepon</label><input id="phone" name="phone" value="{{ old('phone', $user->phone) }}" class="form-dark"></div>
        <div class="border-t border-white/10 pt-5"><p class="mb-4 text-sm text-white/60">Kosongkan bagian sandi bila tidak ingin menggantinya.</p>
            <label for="password" class="mb-2 block text-sm text-white/75">Sandi baru (minimal 12 karakter)</label><input id="password" type="password" name="password" autocomplete="new-password" class="form-dark">
        </div>
        <div><label for="password_confirmation" class="mb-2 block text-sm text-white/75">Konfirmasi sandi baru</label><input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" class="form-dark"></div>
        <button type="submit" class="btn-gold">Simpan profil</button>
    </form>
</div>
@endsection
