<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->date('paymentDate');
            $table->integer('customerId');
            $table->string('receivedId', 50)->nullable();
            $table->string('memo', 50)->nullable();
            $table->bigInteger('salesId');
            $table->string('invoice');
            $table->date('invoiceDate');
            $table->float('dueAmount', 10, 2);
            $table->float('discountAmount', 10, 2)->nullable();
            $table->float('receivedAmount', 10, 2);
            $table->tinyInteger('paymentMethod');
            $table->string('details')->nullable();
            $table->tinyInteger('depositTo');
            $table->tinyInteger('createdBy')->default(0);
            $table->tinyInteger('updatedBy')->default(0);
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
        Schema::dropIfExists('payments');
    }
}
