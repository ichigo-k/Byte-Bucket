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
        Schema::create('items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->unique();
            $table->bigInteger('size')->nullable();
            $table->timestamp('date_added')->useCurrent();
            $table->foreignUuid('user_id')->constrained('users');
            $table->boolean('is_folder')->default(false);
            $table->string('mime_type')->nullable();
            $table->string('storage_key')->unique()->nullable();
            $table->uuid('parent_id')->nullable();
            $table->foreignUuid('bucket_id')->references('id')->on('buckets')->onDelete('cascade');

            $table->index('user_id');
            $table->index('date_added');
            $table->index(['bucket_id', 'parent_id']);
        });


        Schema::table('items', function (Blueprint $table) {
            $table->foreign('parent_id')
                ->references('id')
                ->on('items')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
