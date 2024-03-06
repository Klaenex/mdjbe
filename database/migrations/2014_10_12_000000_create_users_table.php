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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->default(0);
            $table->unsignedBigInteger('mdj_id')->nullable();
            $table->rememberToken();
            $table->timestamps();

            // Ajout de la contrainte de clé étrangère
            $table->foreign('mdj_id')->references('id')->on('mdjs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Suppression de la contrainte de clé étrangère avant de supprimer la table
            $table->dropForeign(['mdj_id']);
        });

        Schema::dropIfExists('users');
    }
};
