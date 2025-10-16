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
        Schema::create('inactifs', function (Blueprint $table) {
            $table->id();
            $table->string('matricule', 15)->nullable();
            $table->string('nom', 50)->nullable();
            $table->string('postnom', 50)->nullable();
            $table->string('prenom', 50)->nullable();
            $table->string('sexe')->nullable();
            $table->integer('anneedeces')->default(0);
            $table->text('observation')->nullable();
            $table->foreignId('grade_id')->nullable()->constrained('grades')->onDelete('set null');
            $table->foreignId('fonction_id')->nullable()->constrained('fonctions')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inactifs');
    }
};
