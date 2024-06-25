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
        Schema::create('leaderships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rank_id');
            $table->decimal('lavel_1' ,20 ,2)->nullable()->default(0);
            $table->decimal('lavel_2' ,20 ,2)->nullable()->default(0);
            $table->decimal('lavel_3' ,20 ,2)->nullable()->default(0);
            $table->decimal('lavel_4' ,20 ,2)->nullable()->default(0);
            $table->decimal('lavel_5' ,20 ,2)->nullable()->default(0);
            $table->decimal('lavel_6' ,20 ,2)->nullable()->default(0);
            $table->decimal('lavel_7' ,20 ,2)->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaderships');
    }
};
