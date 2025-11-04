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
        Schema::table('agents', function (Blueprint $table) {
            $table->string('status', 50)->nullable();
            $table->integer('anneeengagement')->nullable();
            $table->foreignId('grade_id')->nullable()->constrained('grades')->onDelete('set null');
            $table->foreignId('fonction_id')->nullable()->constrained('fonctions')->onDelete('set null');
            $table->foreignId('province_id')->nullable()->constrained('provinces')->onDelete('set null');
            $table->foreignId('direction_id')->nullable()->constrained('directions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('anneeengagement');
            $table->dropColumn('grade_id');
            $table->dropColumn('fonction_id');
            $table->dropColumn('province_id');
            $table->dropColumn('direction_id');
        });
    }
};
