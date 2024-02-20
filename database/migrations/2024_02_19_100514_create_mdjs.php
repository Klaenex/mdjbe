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
            $table->longText('location')->nullable();
            $table->longText('objective')->nullable();
            $table->longText('tagline')->nullable();
            $table->string('street')->nullable();
            $table->unsignedBigInteger('dispositif_particulier')->nullable();
            $table->string('number')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('site')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tel')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('region')->nullable();
            $table->boolean('active')->default(0);
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
