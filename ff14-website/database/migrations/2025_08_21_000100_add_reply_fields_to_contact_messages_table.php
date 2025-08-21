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
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->text('admin_reply')->nullable()->after('message');
            $table->timestamp('replied_at')->nullable()->after('admin_reply');
            $table->foreignId('replied_by')->nullable()->constrained('users')->nullOnDelete()->after('replied_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropForeign(['replied_by']);
            $table->dropColumn(['admin_reply', 'replied_at', 'replied_by']);
        });
    }
};


