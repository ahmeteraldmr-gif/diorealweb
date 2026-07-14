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
        // 1. Hotels table
        Schema::table('hotels', function (Blueprint $table) {
            $table->unsignedBigInteger('destination_id')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_archived')->default(false);
            $table->string('video_file')->nullable();
            $table->string('video_url')->nullable();
        });

        // 2. Restaurants table
        Schema::table('restaurants', function (Blueprint $table) {
            $table->unsignedBigInteger('destination_id')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_archived')->default(false);
            $table->string('video_file')->nullable();
            $table->string('video_url')->nullable();
        });

        // 3. Journals table
        Schema::table('journals', function (Blueprint $table) {
            $table->unsignedBigInteger('destination_id')->nullable();
        });

        // 4. Destinations table
        Schema::table('destinations', function (Blueprint $table) {
            $table->json('desc')->nullable();
            $table->json('gallery')->nullable();
            $table->string('video_file')->nullable();
            $table->string('video_url')->nullable();
        });

        // 5. Guides table
        Schema::table('guides', function (Blueprint $table) {
            $table->json('gallery')->nullable();
            $table->string('video_file')->nullable();
            $table->string('video_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn(['destination_id', 'order', 'is_archived', 'video_file', 'video_url']);
        });

        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropColumn(['destination_id', 'order', 'is_archived', 'video_file', 'video_url']);
        });

        Schema::table('journals', function (Blueprint $table) {
            $table->dropColumn(['destination_id']);
        });

        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn(['desc', 'gallery', 'video_file', 'video_url']);
        });

        Schema::table('guides', function (Blueprint $table) {
            $table->dropColumn(['gallery', 'video_file', 'video_url']);
        });
    }
};
