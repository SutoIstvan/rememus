<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Gallery images — thumbnail path
        Schema::table('images', function (Blueprint $table) {
            $table->string('thumb_path')->nullable()->after('image_path');
        });

        // Family avatars — thumbnail path
        Schema::table('families', function (Blueprint $table) {
            $table->string('avatar_thumb')->nullable()->after('avatar');
        });

        // Timeline media — thumbnail path
        Schema::table('timelines', function (Blueprint $table) {
            $table->string('media_thumb')->nullable()->after('media');
        });

        // Comments — thumbnail path
        Schema::table('comments', function (Blueprint $table) {
            $table->string('photo_thumb')->nullable()->after('photo');
        });
    }

    public function down(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn('thumb_path');
        });

        Schema::table('families', function (Blueprint $table) {
            $table->dropColumn('avatar_thumb');
        });

        Schema::table('timelines', function (Blueprint $table) {
            $table->dropColumn('media_thumb');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('photo_thumb');
        });
    }
};
