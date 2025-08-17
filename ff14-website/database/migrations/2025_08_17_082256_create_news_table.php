<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // nieuws titel
            $table->string('image')->nullable(); // afbeelding pad
            $table->text('content'); // nieuws inhoud
            $table->timestamp('published_at')->nullable(); // publicatiedatum
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // admin die het heeft gemaakt
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
