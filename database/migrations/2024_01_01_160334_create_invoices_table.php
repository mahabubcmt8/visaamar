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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('agent_id', 60)->nullable();
            $table->string('refer_id', 60)->nullable();
            $table->decimal('total_point', 20, 2)->nullable();
            $table->decimal('sub_total', 20, 2)->nullable();
            $table->decimal('bill_amount', 20, 2)->nullable();
            $table->tinyInteger('status')->default(Constant::STATUS['pending']);
            $table->tinyInteger('order_status')->default(Constant::ORDER_STATUS['pending']);
            $table->string('cookie_id')->nullable();
            $table->string('date', 60)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
