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
        Schema::table('memorials', function (Blueprint $table) {
            $table->boolean('family_tree_enabled')->default(true)->after('grave_coordinates');
            $table->boolean('gallery_enabled')->default(true)->after('family_tree_enabled');
            $table->boolean('timeline_enabled')->default(true)->after('gallery_enabled');
            $table->boolean('features_enabled')->default(true)->after('timeline_enabled');
            $table->boolean('burial_location_enabled')->default(true)->after('features_enabled');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('memorials', function (Blueprint $table) {
            $table->dropColumn([
                'family_tree_enabled',
                'gallery_enabled',
                'timeline_enabled',
                'features_enabled',
                'burial_location_enabled'
            ]);
        });
    }
};
