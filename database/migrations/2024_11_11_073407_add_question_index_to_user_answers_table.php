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
        Schema::table('user_answers', function (Blueprint $table) {
            $table->integer('question_index')->after('course_id'); // Menambahkan kolom setelah course_id
        });
    }

    public function down()
    {
        Schema::table('user_answers', function (Blueprint $table) {
            $table->dropColumn('question_index'); // Menghapus kolom jika migrasi dibatalkan
        });
    }
};
