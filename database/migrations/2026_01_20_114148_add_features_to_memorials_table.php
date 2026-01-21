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
            $table->json('characteristics')->nullable();
            $table->json('hobbies')->nullable();
            $table->longText('custom_traits')->nullable();
            $table->longText('additional_hobbies')->nullable();
            $table->longText('retirement')->nullable();
            $table->longText('habits')->nullable();
            $table->longText('stories')->nullable();
            $table->longText('wisdom')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('memorials', function (Blueprint $table) {
            $table->dropColumn([
                'characteristics',
                'hobbies',
                'custom_traits',
                'additional_hobbies',
                'retirement',
                'habits',
                'stories',
                'wisdom',
            ]);
        });
    }
};