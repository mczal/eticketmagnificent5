<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_code')->unique();
            /*barcode belom*/
            $table->integer('order_id')->index(); // from table order
            $table->integer('type_id')->index(); //from table types

            $table->timestamp('order_date')->nullable();
            $table->timestamp('active_date')->nullable();
            $table->timestamp('check_in_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tickets');
    }
}
