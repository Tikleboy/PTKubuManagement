<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. Garden, Maintenance, Planting, Landscape Project, Room, Villa, Hotel, Cleaning
            $table->string('slug')->unique();
            $table->enum('parent_group', ['landscape', 'housekeeping']);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_categories');
    }
};
