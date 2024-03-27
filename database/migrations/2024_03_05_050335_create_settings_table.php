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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->mediumText('site_title')->nullable();
            $table->mediumText('company')->nullable();
            $table->mediumText('site_logo')->nullable();
            $table->mediumText('site_image')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('smtp_host',50)->nullable();
            $table->string('smtp_port',50)->nullable();
            $table->string('smtp_security',20)->nullable();
            $table->string('username',50)->nullable();
            $table->string('smtppassword')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
