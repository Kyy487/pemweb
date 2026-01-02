<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ... dalam fungsi up()
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            // Menghubungkan siswa ke user (untuk otentikasi)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nisn')->unique(); // Nomor Induk Siswa Nasional
            $table->string('name');
            // Menghubungkan siswa ke kelas tempat mereka berada
            $table->foreignId('study_class_id')->constrained('study_classes')->onDelete('restrict');
            $table->timestamps();

            // Tambahkan indeks unik
            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
