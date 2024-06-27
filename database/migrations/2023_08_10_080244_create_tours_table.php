<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('title')->nullable();
			$table->string('slug')->nullable();
            $table->string('tour_country')->nullable();
            $table->string('tour_division')->nullable();
            $table->string('tour_day')->nullable();
			$table->string('views')->nullable();
            $table->string('tour_group')->nullable();
            $table->string('depture')->nullable();
            $table->string('depture_time')->nullable();
            $table->string('return_time')->nullable();
            $table->string('dress_code')->nullable();
            $table->string('price_includes')->nullable();
            $table->string('price_excludes')->nullable();
            $table->float('regular_price')->nullable();
			$table->float('discount_price')->nullable();
            $table->string('discount_type')->nullable();
            $table->text('description')->nullable();
			$table->integer('is_popular')->default(0);
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tours');
    }
};
