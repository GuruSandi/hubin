<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstansisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instansis', function (Blueprint $table) {
            $table->id();
            $table->text('instansi');
            $table->decimal('latitude', 10, 8)->nullable(); // Precision 10, scale 8 for latitude
            $table->decimal('longitude', 11, 8)->nullable(); // Precision 11, scale 8 for longitude
            $table->text('alamat');
            $table->text('domisili');
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
        Schema::dropIfExists('instansis');
    }
}
