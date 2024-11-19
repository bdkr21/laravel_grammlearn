<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->integer('quantity')->default(0); // Menambahkan kolom quantity dengan default 0
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });
    }
};
