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
            $table->string('phone')->nullable()->after('password');
            $table->string('country', 2)->default('GH')->after('phone');

            $table->string('paystack_customer_code')->nullable()->unique()->after('is_premium_cached');
            $table->string('paystack_authorization_code')->nullable()->after('paystack_customer_code');

            $table->unsignedBigInteger('storage_used_bytes')->default(0)->after('paystack_authorization_code');
            $table->unsignedBigInteger('storage_limit_bytes')->default(5 * 1024 * 1024 * 1024)->after('storage_used_bytes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
