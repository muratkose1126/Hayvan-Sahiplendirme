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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('species_id')->constrained()->cascadeOnDelete();
            $table->foreignId('breed_id')->constrained()->cascadeOnDelete();
            $table->string('color');
            $table->string('age');
            $table->string('gender');
            $table->string('status');
            $table->boolean('desexed');
            $table->string('microchip_number');
            $table->string('ear_tag_number');
            $table->longText('description');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
