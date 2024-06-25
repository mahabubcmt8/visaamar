<?php

use App\Helpers\Constant;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->foreignId('subcategory_id')->nullable();
            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->string('slug');
            $table->string('thumbnail')->nullable();
            $table->decimal('point', 8, 2)->nullable()->default(0);
            $table->string('price', 100)->nullable();
            $table->string('offer_price', 100)->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('policy')->default(Constant::POLICY_STATUS['deactive']);
            $table->tinyInteger('terms')->default(Constant::TERMS_STATUS['deactive']);
            $table->tinyInteger('status')->default(Constant::PRODUCT_STATUS['active']);
            $table->timestamps();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
