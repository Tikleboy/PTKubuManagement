<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_settings', function (Blueprint $table) {
            $table->id();
            $table->string('whatsapp_number')->default('6281234567890');
            $table->string('default_whatsapp_message')->default('Halo KUBU MANAGEMENT BALI, saya ingin mendapatkan informasi mengenai layanan Landscape/Housekeeping.');
            $table->string('email')->default('info@kubumanagementbali.com');
            $table->string('instagram')->default('@kubumanagementbali');
            $table->string('instagram_url')->nullable();
            $table->text('office_address')->default('Kuta, Badung, Bali - Indonesia');
            $table->text('google_maps_embed')->nullable();
            $table->string('operating_hours')->default('Senin - Sabtu: 08:00 - 17:00 WITA');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_settings');
    }
};
