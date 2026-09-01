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
        $tables = ['hotels', 'restaurants', 'events', 'guides', 'journals'];
        foreach ($tables as $t) {
            if (Schema::hasTable($t) && !Schema::hasColumn($t, 'destination_id')) {
                Schema::table($t, function (Blueprint $table) {
                    $table->unsignedBigInteger('destination_id')->nullable()->after('id');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['hotels', 'restaurants', 'events', 'guides', 'journals'];
        foreach ($tables as $t) {
            if (Schema::hasTable($t) && Schema::hasColumn($t, 'destination_id')) {
                Schema::table($t, function (Blueprint $table) {
                    $table->dropColumn('destination_id');
                });
            }
        }
    }
};
