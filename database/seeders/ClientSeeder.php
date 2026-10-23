<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $clients = [
            ['name' => '[CONTOH] Nama klien 01', 'sort_order' => 1],
            ['name' => '[CONTOH] Nama mitra 02', 'sort_order' => 2],
            ['name' => '[CONTOH] Nama klien 03', 'sort_order' => 3],
        ];

        foreach ($clients as $c) {
            Client::updateOrCreate(['name' => $c['name']], array_merge($c, ['is_active' => true]));
        }
    }
}
