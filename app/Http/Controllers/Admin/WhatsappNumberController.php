<?php

namespace App\Http\Controllers\Admin;

use App\Models\WhatsappNumber;

class WhatsappNumberController extends ManagedResourceController
{
    protected string $modelClass = WhatsappNumber::class;
    protected string $routeName = 'admin.whatsapp-nomor';
    protected string $title = 'Nomor WhatsApp';

    protected function fields(): array
    {
        return [
            ['name' => 'name', 'label' => 'Nama tim', 'type' => 'text'],
            ['name' => 'number', 'label' => 'Nomor internasional (contoh 62812...)', 'type' => 'text'],
            ['name' => 'sort_order', 'label' => 'Urutan', 'type' => 'number'],
            ['name' => 'is_active', 'label' => 'Aktif untuk pengunjung', 'type' => 'checkbox'],
        ];
    }

    protected function validationRules(?int $id = null): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'number' => ['required', 'regex:/^62[0-9]{8,13}$/', 'unique:whatsapp_numbers,number'.($id ? ','.$id : '')],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
