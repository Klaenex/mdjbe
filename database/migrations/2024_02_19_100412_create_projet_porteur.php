<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projet_porteur', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mdj_id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('projet_porteur', function (Blueprint $table) {
            if (Schema::hasTable('mdjs')) {
                $table->foreign('mdj_id')->references('id')->on('mdjs')->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('projet_porteur', function (Blueprint $table) {
            $table->dropForeign(['mdj_id']);
        });

        Schema::dropIfExists('projet_porteur');
    }
};
