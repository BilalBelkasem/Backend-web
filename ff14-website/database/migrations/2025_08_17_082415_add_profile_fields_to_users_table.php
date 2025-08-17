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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->nullable(); // custom username
            $table->date('birthday')->nullable(); // verjaardag
            $table->string('profile_photo')->nullable(); // profielfoto
            $table->text('about_me')->nullable(); // over mij tekst
            $table->boolean('is_admin')->default(false); // admin rechten
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'birthday', 'profile_photo', 'about_me', 'is_admin']);
        });
    }
};
