<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiPklsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_pkls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('guru_mapel_pkl_id')->constrained()->onDelete('cascade');
            $table->foreignId('siswa_id')->constrained()->onDelete('cascade');
            $table->integer('nilai1');
            $table->integer('nilai2');
            $table->integer('nilai3');
            $table->integer('nilai4');
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
        Schema::dropIfExists('nilai_pkls');
    }
}
