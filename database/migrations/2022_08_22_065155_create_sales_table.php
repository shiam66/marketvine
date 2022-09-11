<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type');
            $table->string('invoice');
            $table->date('invoiceDate');
            $table->integer('customerId');
            $table->string('customerPo', 20)->nullable();
            $table->string('billTo', 200)->nullable();
            $table->string('billToContact', 200)->nullable();
            $table->string('shipTo', 200)->nullable();
            $table->string('shipToContact', 200)->nullable();
            $table->float('salesAmount', 10, 2);
            $table->float('vat', 10, 2)->default(0);
            $table->float('others', 10, 2)->default(0);
            $table->float('totalAmount', 10, 2);
            $table->float('advance', 10, 2)->default(0);
            $table->tinyInteger('paymentMethod');
            $table->float('balanceDue', 10, 2);
            $table->string('notes', 200)->nullable();
            $table->tinyInteger('paymentStatus')->default(0);
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
        Schema::dropIfExists('sales');
    }
}
