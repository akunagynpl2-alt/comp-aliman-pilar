<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            SiteSettingSeeder::class,
            WhatsappSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ProductPhotoSeeder::class,
            PortfolioSeeder::class,
            BlogSeeder::class,
            TestimonialSeeder::class,
            ClientSeeder::class,
        ]);
    }
}
