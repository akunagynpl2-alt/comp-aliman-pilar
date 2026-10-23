@extends('layouts.admin')

@section('page-title', ($record ? 'Ubah ' : 'Tambah ').$title)
@section('content')
<div class="mx-auto max-w-4xl p-6 md:p-10">
    <a href="{{ route($routeName.'.index') }}" class="text-xs uppercase tracking-[.2em] text-gold">&larr; Kembali ke {{ $title }}</a>
    <h1 class="mt-5 font-heading text-3xl text-white">{{ $record ? 'Ubah' : 'Tambah' }} {{ $title }}</h1>
    @if($errors->any())
        <div role="alert" class="mt-6 border border-red-500/30 bg-red-950/30 p-4 text-sm text-red-200">
            <p class="font-semibold">Periksa kembali data berikut:</p>
            <ul class="mt-2 list-inside list-disc">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif
    <form method="POST" enctype="multipart/form-data" action="{{ $record ? route($routeName.'.update', $record->getKey()) : route($routeName.'.store') }}" class="mt-8 space-y-6 border border-white/10 bg-black/20 p-6 md:p-8">
        @csrf
        @if($record) @method('PUT') @endif
        @foreach($fields as $field)
            @php
                $fieldName = $field['name'];
                $fieldValue = old($fieldName, data_get($record, $fieldName, $field['default'] ?? ''));
                if ($fieldValue instanceof \DateTimeInterface) {
                    $fieldValue = $fieldValue->format(($field['type'] ?? '') === 'datetime-local' ? 'Y-m-d\TH:i' : 'Y-m-d');
                }
            @endphp
            <div>
                @if(($field['type'] ?? 'text') === 'checkbox')
                    <label class="flex items-center gap-3 text-sm text-white/75">
                        <input type="checkbox" name="{{ $fieldName }}" value="1" @checked((bool) $fieldValue) class="accent-yellow-400">
                        <span>{{ $field['label'] }}</span>
                    </label>
                @else
                    <label for="{{ $fieldName }}" class="mb-2 block text-sm text-white/75">{{ $field['label'] }}</label>
                    @if(($field['type'] ?? '') === 'select')
                        <select id="{{ $fieldName }}" name="{{ $fieldName }}" class="form-dark">
                            @if($field['nullable'] ?? false)<option value="">Tidak dikategorikan</option>@endif
                            @foreach($field['options'] ?? [] as $optionValue => $optionLabel)
                                <option value="{{ $optionValue }}" @selected((string) $fieldValue === (string) $optionValue)>{{ $optionLabel }}</option>
                            @endforeach
                        </select>
                    @elseif(($field['type'] ?? '') === 'textarea')
                        <textarea id="{{ $fieldName }}" name="{{ $fieldName }}" rows="6" class="form-dark" @if(isset($field['maxlength'])) maxlength="{{ $field['maxlength'] }}" @endif>{{ $fieldValue }}</textarea>
                    @else
                        <input id="{{ $fieldName }}" type="{{ $field['type'] ?? 'text' }}" name="{{ $fieldName }}{{ ($field['multiple'] ?? false) ? '[]' : '' }}" @if(($field['type'] ?? '') !== 'file') value="{{ $fieldValue }}" @endif class="form-dark" @if(($field['type'] ?? '') === 'file') accept="image/jpeg,image/png,image/webp" @endif @if($field['multiple'] ?? false) multiple @endif @if(($field['type'] ?? '') === 'number') min="0" @endif @if(isset($field['maxlength'])) maxlength="{{ $field['maxlength'] }}" @endif>
                    @endif
                @endif
                @error($fieldName)<p class="mt-2 text-xs text-red-300">{{ $message }}</p>@enderror
            </div>
        @endforeach
        <div class="flex flex-wrap gap-3 border-t border-white/10 pt-6">
            <button type="submit" class="btn-gold">Simpan</button>
            <a href="{{ route($routeName.'.index') }}" class="btn-outline-gold">Batal</a>
        </div>
    </form>
</div>
@endsection
