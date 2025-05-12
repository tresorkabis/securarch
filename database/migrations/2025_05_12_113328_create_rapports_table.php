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
        Schema::create('rapports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_rapport_id')->constrained('type_rapports')->onDelete('cascade');
            $table->string('intitule');
            $table->string('fichier')->nullable();
            $table->date('debut_periode');
            $table->date('fin_periode');
            $table->foreignId('agent_id')->constrained('agents')->onDelete('cascade');
            $table->string('pays');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapports');
    }
};
