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
        $tables = ['hotels', 'restaurants', 'yachts', 'destinations', 'events', 'journals', 'guides'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->string('slug_tr')->nullable()->unique();
                $table->string('slug_en')->nullable()->unique();
                $table->string('seo_title_tr')->nullable();
                $table->string('seo_title_en')->nullable();
                $table->text('seo_description_tr')->nullable();
                $table->text('seo_description_en')->nullable();
                $table->string('og_image')->nullable();
                $table->boolean('seo_noindex')->default(false);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['hotels', 'restaurants', 'yachts', 'destinations', 'events', 'journals', 'guides'];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn([
                    'slug_tr',
                    'slug_en',
                    'seo_title_tr',
                    'seo_title_en',
                    'seo_description_tr',
                    'seo_description_en',
                    'og_image',
                    'seo_noindex'
                ]);
            });
        }
    }
};
