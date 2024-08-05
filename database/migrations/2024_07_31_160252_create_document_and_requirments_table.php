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
        Schema::create('document_and_requirments', function (Blueprint $table) {
            $table->id();
            $table->integer('country_id')->nullable();
            $table->longText('document_name')->nullable();
            $table->longText('document_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_and_requirments');
    }
};
