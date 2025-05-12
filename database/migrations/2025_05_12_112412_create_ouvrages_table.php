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
        Schema::create('ouvrages', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description')->nullable();
            $table->foreignId('auteur_id')->constrained('auteurs')->onDelete('cascade');
            $table->foreignId('domaine_id')->constrained('domaines')->onDelete('cascade');
            $table->string('isbn')->unique()->nullable();
            $table->string('editeur')->nullable();
            $table->date('date_publication')->nullable();
            $table->integer('nombre_pages')->nullable();
            $table->string('langue')->nullable();
            $table->string('format_fichier', 20); // PDF, DOCX, etc.
            $table->string('taille_fichier')->nullable();
            $table->string('chemin_fichier');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ouvrages');
    }
};
