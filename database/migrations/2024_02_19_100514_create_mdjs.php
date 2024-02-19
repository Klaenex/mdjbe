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
        Schema::create('mdjs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('location');
            $table->longText('objective');
            $table->longText('tagline')->nullable();
            $table->string('street');
            $table->unsignedBigInteger('dispositif_particulier')->nullable();
            $table->string('number');
            $table->string('postal_code');
            $table->string('city');
            $table->string('email')->unique();
            $table->string('site')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tel')->nullable();
            $table->string('slug')->unique();
            $table->string('region');
            $table->timestamps();


            $table->foreign('dispositif_particulier')->references('id')->on('dispositif_particulier');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mdjs');
    }
};
