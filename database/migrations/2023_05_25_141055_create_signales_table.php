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
        Schema::create('signales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id1')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id2')->constrained()->cascadeOnDelete();
            $table->string('email1');
            $table->string('email2');
            $table->string('problem');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signales');
    }
};
