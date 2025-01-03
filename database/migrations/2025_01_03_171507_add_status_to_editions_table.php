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
        Schema::table('editions', function (Blueprint $table) {
            $table->string('status', 15)->default('draft');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('editions', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
