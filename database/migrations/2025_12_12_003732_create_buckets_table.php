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
        Schema::create('buckets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->constrained('users')->cascadeOnDelete();

            $table->string('name');
            $table->unique(['user_id', 'name']);

            $table->enum('type', ['standard', 'archival', 'deep_archive'])->default('standard');
            $table->string('physical_bucket_name');

            $table->index(['user_id', 'type']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buckets');
    }
};
