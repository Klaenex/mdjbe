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
        Schema::create('projet_porteur', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mdj_id'); // Clé étrangère
            $table->string('name');
            $table->timestamps();

            // clef étrangère
            $table->foreign('mdj_id')->references('id')->on('mdjs');
        }, ['ifNotExists' => true]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projet_porteur');
    }
};
