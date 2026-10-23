<?php

namespace App\Http\Controllers\Admin;

use App\Models\WhatsappTemplate;

class WhatsappTemplateController extends ManagedResourceController
{
    protected string $modelClass = WhatsappTemplate::class;
    protected string $routeName = 'admin.whatsapp-template';
    protected string $title = 'Template WhatsApp';

    protected function fields(): array
    {
        return [
            ['name' => 'key', 'label' => 'Kunci (product, portfolio, general, contact)', 'type' => 'text'],
            ['name' => 'label', 'label' => 'Nama template', 'type' => 'text'],
            ['name' => 'template', 'label' => 'Isi pesan. Placeholder memakai format {nama_field}.', 'type' => 'textarea'],
        ];
    }

    protected function validationRules(?int $id = null): array
    {
        return [
            'key' => ['required', 'alpha_dash', 'max:50', 'unique:whatsapp_templates,key'.($id ? ','.$id : '')],
            'label' => ['required', 'string', 'max:100'],
            'template' => ['required', 'string', 'max:2000'],
        ];
    }
}
