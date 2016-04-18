<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfirmationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirmations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_rekening');
            $table->string('name');
            $table->string('nama_bank');
            $table->integer('total_transfer');
            $table->tinyInteger('status'); /*
                                            * 0 = belum di validasi
                                            * 1 = sudah di validasi
                                            */

            $table->integer('order_id')->index(); // from
            $table->timestamps(); // untuk created dan updated
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('confirmations');
    }
}
