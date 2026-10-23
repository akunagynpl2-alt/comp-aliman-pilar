<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TestimonialController extends ManagedResourceController
{
    protected string $modelClass = Testimonial::class;
    protected string $routeName = 'admin.testimoni';
    protected string $title = 'Testimoni';

    protected function fields(): array
    {
        return [
            ['name' => 'client_name', 'label' => 'Nama pemberi testimoni', 'type' => 'text'],
            ['name' => 'client_title', 'label' => 'Jabatan / organisasi', 'type' => 'text'],
            ['name' => 'event_type', 'label' => 'Jenis acara', 'type' => 'text'],
            ['name' => 'content', 'label' => 'Isi testimoni', 'type' => 'textarea'],
            ['name' => 'avatar', 'label' => 'Foto pemberi testimoni (opsional)', 'type' => 'file'],
            ['name' => 'rating', 'label' => 'Penilaian (1–5)', 'type' => 'number'],
            ['name' => 'is_featured', 'label' => 'Testimoni unggulan', 'type' => 'checkbox'],
            ['name' => 'is_active', 'label' => 'Tampilkan di situs', 'type' => 'checkbox'],
            ['name' => 'sort_order', 'label' => 'Urutan', 'type' => 'number'],
        ];
    }

    protected function validationRules(?int $id = null): array
    {
        return [
            'client_name' => ['required', 'string', 'max:255'],
            'client_title' => ['nullable', 'string', 'max:255'],
            'event_type' => ['nullable', 'string', 'max:100'],
            'content' => ['required', 'string', 'max:3000'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:4096'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    protected function afterSave(Model $record, Request $request): void
    {
        if ($request->hasFile('avatar')) {
            $record->addMedia($request->file('avatar'))->toMediaCollection('avatar');
        }
    }
}
