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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nid_no', 60)->after('image');
            $table->tinyInteger('gender')->after('nid_no');
            $table->string('birthday', 30)->after('gender');
            $table->foreignId('country')->after('birthday');
            $table->foreignId('states')->after('country');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("nid_no");
            $table->dropColumn("gender");
            $table->dropColumn("birthday");
            $table->dropColumn("country");
            $table->dropColumn("states");
        });
    }
};
