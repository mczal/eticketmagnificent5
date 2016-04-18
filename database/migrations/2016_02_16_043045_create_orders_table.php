<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_order');
            $table->integer('quantity');
            $table->integer('total_price');
            $table->tinyInteger('status'); /* status pembayaran..
                                        default:
                                                0 = expire
                                                1 = belum dibayar
                                                2 = terbayar.. manual oleh admin
                                        */
              //user info
            $table->string('name');
            $table->string('address');
            // $table->string('id_no'); //nomor ktp atau ktm
            // $table->string('id_type'); //jenis tipe : ktm / ktp / kartupelajar
            $table->string('email')->unique();
            $table->string('handphone');

            $table->softDeletes();

            $table->timestamps(); // created at and updated at
            $table->timestamp('expired_date'); //salah tipee niiihhh harusnay datetime koko...
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
