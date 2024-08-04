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
        Schema::table('questions', function (Blueprint $table) {
            // Menyimpan nama kunci asing yang benar berdasarkan output SHOW CREATE TABLE
            $foreignKeyName = 'your_foreign_key_name_here'; // Ganti dengan nama kunci asing yang benar

            // Hapus kunci asing jika ada
            if (Schema::hasColumn('questions', 'category_id')) {
                $table->dropForeign($foreignKeyName);
                $table->dropColumn('category_id');
            }
        });
    }

    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }
};
