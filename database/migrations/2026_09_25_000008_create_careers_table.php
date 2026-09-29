<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('requirements');
            $table->string('location')->default('Bali, Indonesia');
            $table->string('employment_type')->default('Full-time'); // Full-time, Part-time, Contract
            $table->text('application_info')->nullable();
            $table->boolean('is_published')->default(false); // Default false: no invented vacancies!
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
