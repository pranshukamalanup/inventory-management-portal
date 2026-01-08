<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('import_failures', function (Blueprint $table) {
            $table->id();

            $table->foreignId('import_batch_id')
                ->constrained('import_batches')
                ->cascadeOnDelete();

            $table->unsignedInteger('row_number')->nullable();
            $table->json('row_data')->nullable();
            $table->string('error_message');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('import_failures');
    }
};
