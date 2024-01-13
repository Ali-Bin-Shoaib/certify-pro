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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            // $table->string('name')->unique();
            // $table->string('email')->unique();
            // $table->string('username')->unique();
            // $table->string('password');
            $table->foreignId('user_id')->unique()->constrained('users', 'id')->cascadeOnDelete();
            $table->string('address');
            $table->string('phone', 25)->unique();
            // $table->string('cid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
