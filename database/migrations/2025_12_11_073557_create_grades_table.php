<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ... dalam fungsi up()
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            // Nilai ini milik siswa mana
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            // Nilai ini untuk mata pelajaran apa
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            // Siapa guru yang menginput nilai ini
            $table->foreignId('teacher_id')->constrained('users')->onDelete('restrict');

            $table->integer('score'); // Nilai Akhir (0-100)
            $table->string('description')->nullable(); // Deskripsi capaian kompetensi
            $table->timestamps();

            // Pastikan siswa hanya memiliki satu nilai untuk satu mapel per semester/tahun
            $table->unique(['student_id', 'subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
