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
        Schema::create('followup', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('lead_id');
            $table->string('notes',50);
            $table->string('serial_id',50);
            $table->dateTime('next_followup')->nullable();
            $table->string('added_by')->nullable();
            $table->tinyInteger('reminder24hr')->default(0);
            $table->tinyInteger('reminder1hr')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('followup');
    }
};
