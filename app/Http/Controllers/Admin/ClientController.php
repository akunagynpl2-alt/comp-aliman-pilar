<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ClientController extends ManagedResourceController
{
    protected string $modelClass = Client::class;
    protected string $routeName = 'admin.klien';
    protected string $title = 'Klien / mitra';

    protected function fields(): array
    {
        return [
            ['name' => 'name', 'label' => 'Nama klien / mitra', 'type' => 'text'],
            ['name' => 'website', 'label' => 'Situs web', 'type' => 'url'],
            ['name' => 'logo', 'label' => 'Logo (JPEG, PNG, atau WebP, maks. 4 MB)', 'type' => 'file'],
            ['name' => 'sort_order', 'label' => 'Urutan', 'type' => 'number'],
            ['name' => 'is_active', 'label' => 'Tampilkan di situs', 'type' => 'checkbox'],
        ];
    }

    protected function validationRules(?int $id = null): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:4096'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    protected function afterSave(Model $record, Request $request): void
    {
        if ($request->hasFile('logo')) {
            $record->addMedia($request->file('logo'))->toMediaCollection('logo');
        }
    }
}
