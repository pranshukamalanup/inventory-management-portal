<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_presences', function (Blueprint $table) {
            $table->id();
            $table->string('user_type'); // admin | customer
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_online')->default(false);
            $table->timestamp('last_seen')->nullable();
            $table->timestamps();

            $table->unique(['user_type', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_presences');
    }
};
