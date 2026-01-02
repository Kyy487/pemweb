<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ... dalam fungsi up()
        Schema::create('study_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Contoh: 'XII IPA 1'
            // Menggunakan foreignId ke tabel 'users' untuk Wali Kelas (homeroom_teacher)
            // Asumsi Wali Kelas adalah user dengan role 'teacher'
            $table->foreignId('homeroom_teacher_id')->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('study_classes');
    }
}
