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
        Schema::create('adopters', function (Blueprint $table) {
            $table->id();
            $table->string('identity_number');
            $table->date('birth_date');
            $table->string('fullname');
            $table->string('sex');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('address');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adopters');
    }
};
