@extends('layouts.admin')

@section('page-title', $title)
@section('content')
<div class="mx-auto max-w-6xl p-6 md:p-10">
    <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="text-xs uppercase tracking-[.25em] text-gold">Pengelolaan situs</p>
            <h1 class="mt-2 font-heading text-3xl text-white">{{ $title }}</h1>
        </div>
        <a href="{{ route($routeName.'.create') }}" class="btn-gold">Tambah data</a>
    </div>
    @if(session('success'))<p role="status" class="mb-5 border border-green-700/40 bg-green-900/20 p-4 text-sm text-green-200">{{ session('success') }}</p>@endif
    <div class="overflow-x-auto border border-white/10 bg-black/20">
        <table class="w-full min-w-[680px] text-left text-sm">
            <thead class="border-b border-gold/20 bg-white/5 text-xs uppercase tracking-wider text-white/60">
                <tr>@foreach($columns as $column)<th class="px-5 py-4">{{ $column['label'] }}</th>@endforeach<th class="px-5 py-4">Aksi</th></tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($records as $record)
                    <tr class="hover:bg-white/[.03]">
                        @foreach($columns as $column)
                            <td class="max-w-sm px-5 py-4 text-white/75">
                                @if(($column['type'] ?? '') === 'checkbox')
                                    {{ data_get($record, $column['name']) ? 'Aktif' : 'Nonaktif' }}
                                @elseif(($column['type'] ?? '') === 'product-image')
                                    <img src="{{ $record->getThumbnailUrl() }}" alt="Foto {{ $record->name }}" class="h-14 w-20 border border-white/10 object-cover">
                                @else
                                    {{ \Illuminate\Support\Str::limit((string) data_get($record, $column['name']), 100) ?: '—' }}
                                @endif
                            </td>
                        @endforeach
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-4">
                                <a href="{{ route($routeName.'.edit', $record->getKey()) }}" class="text-gold hover:text-white">Ubah</a>
                                <form method="POST" action="{{ route($routeName.'.destroy', $record->getKey()) }}" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-300 hover:text-red-100">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="{{ count($columns) + 1 }}" class="px-5 py-12 text-center text-white/45">Belum ada data. Tambahkan konten pertama.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $records->links() }}</div>
</div>
@endsection
