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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('path');
            $table->boolean('logo')->default(false);
            $table->string('desc')->nullable();
            $table->string('ext');
            $table->unsignedBigInteger('mdj_id');
            $table->timestamps();

            // Clé étrangère
            $table->foreign('mdj_id')->references('id')->on('mdjs')
                ->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
