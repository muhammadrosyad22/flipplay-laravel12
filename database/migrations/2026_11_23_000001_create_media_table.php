<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->string('id', 20)->primary();
            $table->string('title');
            $table->string('creator');
            $table->unsignedSmallInteger('release_year');
            $table->text('description');
            $table->string('type', 30);
            $table->unsignedInteger('episode_count')->nullable();
            $table->string('studio')->nullable();
            $table->unsignedInteger('volume_count')->nullable();
            $table->string('publisher')->nullable();
            $table->timestamps();

            // Judul yang sama diperbolehkan untuk jenis media berbeda,
            // sesuai data Spy x Family pada project Modul 3.
            $table->unique(['title', 'type'], 'media_title_type_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
