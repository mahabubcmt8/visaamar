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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->longText('remarks')->nullable();
            $table->longText('eligibility_for_visa')->nullable();
            $table->longText('fees_charges')->nullable();
            $table->longText('departure_requiremet')->nullable();
            $table->string('processing_time')->nullable();
            $table->string('flag')->nullable();
            $table->longText('contacts_links')->nullable();
            $table->integer('is_deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
