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
        Schema::table('links', function (Blueprint $table) {
            $table->string('city',100);
        });
    }

    /**
     * Reverse the migrations (откат изменений).
     */
    public function down(): void
    {
        Schema::table('links', function (Blueprint $table) {
            $table->dropColumn('city');
        });
    }
};
