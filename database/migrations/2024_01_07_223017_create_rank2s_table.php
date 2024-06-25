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
        Schema::create('rank2s', function (Blueprint $table) {
            $table->id();
            $table->string('rank_name',200);
            $table->string('username',200);
            $table->decimal('team_sales',20,2);
            $table->decimal('team_point',20,2);
            $table->decimal('self_sales',20,2);
            $table->decimal('self_point',20,2);
            $table->decimal('self_earning',20,2);
            $table->decimal('team_earning',20,2);
            $table->decimal('self_bonus',20,2);
            $table->decimal('team_bonus',20,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rank2s');
    }
};
