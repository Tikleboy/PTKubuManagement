<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('PT. KUBU MANAGEMENT BALI');
            $table->string('tagline')->default('Professional Property Care Services in Bali');
            $table->string('subtagline')->default('Landscape • Housekeeping • Property Care');
            $table->text('description');
            $table->text('vision');
            $table->json('mission');
            $table->string('about_image')->nullable();
            $table->string('hero_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_profiles');
    }
};
