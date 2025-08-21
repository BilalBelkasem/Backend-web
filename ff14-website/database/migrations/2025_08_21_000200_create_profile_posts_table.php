<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profile_posts', function (Blueprint $table) {
            $table->id();
            // owner of the wall
            $table->foreignId('profile_user_id')->constrained('users')->onDelete('cascade');
            // author of the post
            $table->foreignId('author_user_id')->constrained('users')->onDelete('cascade');
            $table->text('content');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_posts');
    }
};


