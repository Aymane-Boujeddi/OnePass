<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('adress_ips', function (Blueprint $table) {
            $table->id();
            $table->string('adressIP')->unique();
            $table->string('nameAppareil');
            $table->enum('etat', ['liste_blanche', 'liste_noir']);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adress_i_p_s');
    }
};
