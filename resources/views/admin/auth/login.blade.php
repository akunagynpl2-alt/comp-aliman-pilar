<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>Login Admin — Aliman Pilar Production</title>
    @vite(['resources/css/app.css'])
</head>
<body class="flex min-h-screen items-center justify-center bg-charcoal px-4 text-white">
    <main class="w-full max-w-md border border-gold/25 bg-charcoal-100 p-7 shadow-gold md:p-10">
        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo Aliman Pilar Production" class="mb-8 h-20 w-20 object-contain">
        <p class="text-xs uppercase tracking-[.25em] text-gold">Ruang administrator</p>
        <h1 class="mt-2 font-heading text-3xl">Masuk ke panel</h1>
        @if(session('success'))<p role="status" class="mt-5 text-sm text-green-200">{{ session('success') }}</p>@endif
        @if($errors->any())<p role="alert" class="mt-5 text-sm text-red-300">{{ $errors->first() }}</p>@endif
        <form method="POST" action="{{ route('admin.login.post') }}" class="mt-7 space-y-5">
            @csrf
            <div><label for="email" class="mb-2 block text-sm text-white/70">Email admin</label><input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" autofocus class="form-dark"></div>
            <div><label for="password" class="mb-2 block text-sm text-white/70">Kata sandi</label><input id="password" type="password" name="password" required autocomplete="current-password" class="form-dark"></div>
            <label class="flex items-center gap-2 text-sm text-white/60"><input type="checkbox" name="remember" value="1" class="accent-yellow-400"> Ingat saya</label>
            <button class="btn-gold w-full justify-center" type="submit">Masuk dengan aman</button>
        </form>
    </main>
</body>
</html>
