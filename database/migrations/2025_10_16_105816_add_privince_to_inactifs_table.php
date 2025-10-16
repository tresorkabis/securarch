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
        Schema::table('inactifs', function (Blueprint $table) {
            $table->string('province', 100)->nullable();
            $table->string('status', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inactifs', function (Blueprint $table) {
            $table->dropColumn('province');
            $table->dropColumn('status');
        });
    }
};
