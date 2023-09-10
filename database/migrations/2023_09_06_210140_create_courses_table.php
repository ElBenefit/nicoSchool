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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('content');
            $table->string('type'); // Exercice, Théorie, etc.
            $table->string('visibility')->default('privé'); // Vous pouvez ajuster la définition selon vos besoins
            $table->foreignId('category_id')->constrained();
            $table->integer('order')->nullable(); // Champ pour l'ordre de séquence
            $table->integer('experiences_gived')->nullable();
            $table->integer('currencies_gived')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
