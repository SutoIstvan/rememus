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
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->foreignId('memorial_id')->constrained('memorials')->onDelete('cascade');
            $table->string('name');
            $table->string('qr_code')->nullable();
            $table->enum('role', [
                'main_person',
                'father', 
                'mother',
                'grandfather_paternal',
                'grandmother_paternal', 
                'grandfather_maternal',
                'grandmother_maternal',
                'spouse',
                'sibling',
                'child',
                'other'
            ]);
            $table->string('avatar')->nullable();
            $table->json('position')->nullable(); // для сохранения позиции в дереве
            $table->string('node_id')->nullable(); // ID узла в дереве для связи
            $table->timestamps();

            // Индексы для оптимизации запросов
            $table->index(['memorial_id', 'role']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('families');
    }
};