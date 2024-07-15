<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensisiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensisiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->date('tanggal');
            $table->decimal('latitude', 10, 8); // Precision 10, scale 8 for latitude
            $table->decimal('longitude', 11, 8); // Precision 11, scale 8 for longitude
            $table->string('jarak');
            $table->time('jam_masuk');
            $table->time('jam_pulang')->nullable();
            $table->enum('keterangan', ['hadir', 'libur', 'absen']);
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
        Schema::dropIfExists('absensisiswas');
    }
}
