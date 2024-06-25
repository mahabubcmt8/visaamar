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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('agent_id')->nullable();
            $table->tinyInteger('wallet_type')->nullable();
            $table->decimal('deb_amount',20,2)->default(0);
            $table->decimal('cred_amount',20,2)->default(0);
            $table->tinyInteger('status')->default(Constant::STATUS['pending']);
            $table->tinyInteger('in_status')->default(Constant::IN_STATUS['active']);
            $table->tinyInteger('transaction_type')->nullable();
            $table->string('transaction_no')->nullable();
            $table->string('transaction_note')->nullable();
            $table->string('method')->nullable();
            $table->string('wallet_address')->nullable();
            $table->string('currency')->nullable();
            $table->string('withdrawal_status')->nullable();
            $table->string('image')->nullable();
            $table->string('date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
