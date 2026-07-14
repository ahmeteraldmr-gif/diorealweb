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
        Schema::table('journals', function (Blueprint $table) {
            $table->json('content')->nullable()->after('desc'); // Full article body (TR & EN)
            $table->boolean('is_featured')->default(false)->after('content'); // Featured/spotlighted
            $table->integer('read_time')->nullable()->after('is_featured'); // Estimated read time (minutes)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('journals', function (Blueprint $table) {
            $table->dropColumn(['content', 'is_featured', 'read_time']);
        });
    }
};
