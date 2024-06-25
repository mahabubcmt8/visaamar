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
        Schema::create('comapany_infos', function (Blueprint $table) {
            $table->id();
            $table->string('system_name')->nullable();
            $table->string('website_logo')->nullable();
            $table->string('user_logo')->nullable();
            $table->string('admin_logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('timezone')->nullable();
            $table->string('company_name')->nullable();
            $table->string('site_mettro')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_des')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_image')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comapany_infos');
    }
};
