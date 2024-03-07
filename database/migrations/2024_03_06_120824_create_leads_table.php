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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->mediumText('name');
            $table->string('mobile');
            $table->mediumText('email');
            $table->string('code')->nullable();
            $table->string('age')->nullable();
            $table->string('price')->nullable();
            $table->dateTime('dob');
            $table->string('marital_status');
            $table->string('description');
            $table->string('address');
            $table->string('country',100)->nullable();
            $table->string('state',100)->nullable();
            $table->string('city',100)->nullable();
            $table->string('zipcode',50)->nullable();
            $table->string('lead_type',50);
            $table->bigInteger('assigned_to');
            $table->string('status',50);
            $table->bigInteger('assigned_by');
            $table->dateTime('contacted_date')->nullable();
            $table->dateTime('close_date')->nullable();
            $table->tinyInteger('is_deleted')->default(1);
            $table->mediumText('lead_mode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
