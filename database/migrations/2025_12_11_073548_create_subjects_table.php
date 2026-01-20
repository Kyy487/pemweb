<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ... dalam fungsi up()
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Contoh: 'Matematika Wajib'
            $table->string('code')->unique(); // Contoh: 'MTK01'
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
        Schema::dropIfExists('subjects');
    }
}
