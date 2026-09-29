<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->string('meta_title')->default('PT. KUBU MANAGEMENT BALI | Professional Property Care Services in Bali');
            $table->text('meta_description')->default('Professional landscape, garden maintenance, and housekeeping services for villas, hotels, residences, and commercial properties in Bali.');
            $table->string('hero_headline')->default('KUBU MANAGEMENT BALI');
            $table->string('hero_badge')->default('LANDSCAPE • HOUSEKEEPING • PROPERTY CARE');
            $table->string('hero_subheadline')->default('Professional Property Care Services in Bali');
            $table->text('hero_description')->default('Professional landscape, garden maintenance, and housekeeping services for villas, hotels, residences, and commercial properties in Bali.');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};
