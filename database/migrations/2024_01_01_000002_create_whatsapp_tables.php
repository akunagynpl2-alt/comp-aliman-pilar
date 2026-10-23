<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('whatsapp_numbers', function (Blueprint $table) {
            $table->id();
            $table->string('name');             // Nama kontak (Admin Penjualan, Tim Teknis, dll.)
            $table->string('number');           // Format: 62812xxxxxxx (tanpa + atau 0)
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('whatsapp_templates', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();    // product, portfolio, general, contact
            $table->string('label');
            $table->text('template');           // Template pesan dengan placeholder {product_name}, dll.
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('whatsapp_templates');
        Schema::dropIfExists('whatsapp_numbers');
    }
};
