<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('email_verification_token', 64)
                ->nullable()
                ->unique()
                ->after('remember_token');

            $table->timestamp('email_verification_token_expires_at')
                ->nullable()
                ->after('email_verification_token');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropUnique(['email_verification_token']);

            $table->dropColumn([
                'email_verification_token',
                'email_verification_token_expires_at',
            ]);
        });
    }
};
