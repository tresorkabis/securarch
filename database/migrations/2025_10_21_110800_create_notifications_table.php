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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('numero', 50)->nullable();
            $table->string('objet', 100);
            $table->string('matricule', 20)->nullable();
            $table->string('grade', 50)->nullable();
            $table->text('observations')->nullable();
            $table->foreignId('decision_id')->nullable()->constrained('decisions')->onDelete('set null');
            $table->foreignId('agent_id')->nullable()->constrained('agents')->onDelete('set null');
            $table->text('fichier')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
