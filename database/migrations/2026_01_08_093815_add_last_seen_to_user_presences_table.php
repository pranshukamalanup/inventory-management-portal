<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('user_presences', function (Blueprint $table) {
            $table->timestamp('last_seen')->nullable()->after('is_online');
        });
    }

    public function down(): void
    {
        Schema::table('user_presences', function (Blueprint $table) {
            $table->dropColumn('last_seen');
        });
    }
};

