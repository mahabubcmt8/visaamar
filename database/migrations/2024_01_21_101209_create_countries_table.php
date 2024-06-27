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
            $table->string('flat')->nullable();
            $table->string('capital')->nullable();
            $table->string('language')->nullable();
            $table->string('religion')->nullable();
            $table->string('population')->nullable();
            $table->string('phone_code')->nullable();
            $table->string('time_zone')->nullable();
            $table->string('currency_name')->nullable();
            $table->string('currency_symbol')->nullable();
            $table->string('weather')->nullable();
            $table->string('cities')->nullable();
            $table->longText('note')->nullable();
            $table->string('map_url')->nullable();
            $table->string('apply_visa_requirment')->nullable();
            $table->longText('visa_fee_service')->nullable();
            $table->longText('processing_time')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
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
