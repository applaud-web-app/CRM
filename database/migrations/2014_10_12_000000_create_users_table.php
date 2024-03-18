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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('profile_img');
            $table->string('device_token');
            $table->string('emp_code',50)->nullable();
            $table->string('username');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('phone')->nullable();
            $table->enum('gender',['M','F','O'])->nullable();
            $table->string("blood_group",10)->nullable();
            $table->dateTime('dob')->nullable();
            $table->string('department',50)->nullable();
            $table->tinyInteger('status');
            $table->dateTime("joining_date")->nullable();
            $table->string("address",100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
