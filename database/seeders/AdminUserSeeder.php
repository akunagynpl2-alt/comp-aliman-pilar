<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_EMAIL');
        $password = env('ADMIN_PASSWORD');

        if (! $email || ! $password) {
            if (app()->environment('production')) {
                throw new \RuntimeException('ADMIN_EMAIL dan ADMIN_PASSWORD wajib diatur sebelum menjalankan seeder di production.');
            }

            return;
        }

        if (strlen($password) < 12) {
            throw new \RuntimeException('ADMIN_PASSWORD harus terdiri dari minimal 12 karakter.');
        }

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => env('ADMIN_NAME', 'Administrator Aliman Pilar'),
                'phone' => env('ADMIN_PHONE'),
                'role' => 'superadmin',
                'password' => Hash::make($password),
            ]
        );
    }
}
