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
        // 1. Yachts table
        Schema::table('yachts', function (Blueprint $table) {
            $table->string('video_file')->nullable();
            $table->string('video_url')->nullable();
            $table->boolean('show_video_on_cover')->default(false);
        });

        // 2. Destinations table
        Schema::table('destinations', function (Blueprint $table) {
            $table->boolean('show_video_on_cover')->default(false);
        });

        // 3. Guides table
        Schema::table('guides', function (Blueprint $table) {
            $table->boolean('show_video_on_cover')->default(false);
        });

        // 4. Events table
        Schema::table('events', function (Blueprint $table) {
            $table->boolean('show_video_on_cover')->default(false);
        });

        // 5. Journals table
        Schema::table('journals', function (Blueprint $table) {
            $table->string('video_file')->nullable();
            $table->string('video_url')->nullable();
            $table->boolean('show_video_on_cover')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('yachts', function (Blueprint $table) {
            $table->dropColumn(['video_file', 'video_url', 'show_video_on_cover']);
        });

        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn('show_video_on_cover');
        });

        Schema::table('guides', function (Blueprint $table) {
            $table->dropColumn('show_video_on_cover');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('show_video_on_cover');
        });

        Schema::table('journals', function (Blueprint $table) {
            $table->dropColumn(['video_file', 'video_url', 'show_video_on_cover']);
        });
    }
};
