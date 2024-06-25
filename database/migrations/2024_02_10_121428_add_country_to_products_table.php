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
        Schema::table('products', function (Blueprint $table) {
            $table->integer('division_id')->nullable()->after('sub_title');
            $table->integer('district_id')->nullable()->after('division_id');
            $table->integer('upazila_id')->nullable()->after('district_id');
            $table->longText('address')->nullable()->after('upazila_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn("division_id");
            $table->dropColumn("district_id");
            $table->dropColumn("upazila_id");
            $table->dropColumn("address");
        });
    }
};
