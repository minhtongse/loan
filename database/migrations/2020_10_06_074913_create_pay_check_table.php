<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayCheckTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('amount', 10, 2);
            $table->float('total_income', 10, 2)->default(0);
            $table->enum('status', ['PENDING', 'APPROVED']);
            $table->dateTime('updated_at', 0);
            $table->dateTime('created_at', 0);
            $table->date('pay_date', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan');
    }
}
