<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
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
            $table->unsignedBigInteger('id_user')->nullable();
        });

        Schema::table('mdjs', function (Blueprint $table) {
            if (Schema::hasTable('users')) {
                $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            }

            if (Schema::hasTable('dispositif_particulier')) {
                $table->foreign('dispositif_particulier')->references('id')->on('dispositif_particulier')->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('mdjs', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropForeign(['dispositif_particulier']);
        });

        Schema::dropIfExists('mdjs');
    }
};
