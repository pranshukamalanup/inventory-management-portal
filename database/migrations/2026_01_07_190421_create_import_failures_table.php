<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (Schema::hasTable('user_presences') &&
            !Schema::hasColumn('user_presences', 'last_seen')) {

            Schema::table('user_presences', function (Blueprint $table) {
                $table->timestamp('last_seen')->nullable()->after('is_online');
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('user_presences') &&
            Schema::hasColumn('user_presences', 'last_seen')) {

            Schema::table('user_presences', function (Blueprint $table) {
                $table->dropColumn('last_seen');
            });
        }
    }
};
