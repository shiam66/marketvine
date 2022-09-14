<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customerName',100);
            $table->string('customerEmail',100);
            $table->string('billTo',100);
            $table->string('shipTo',100);
            $table->string('contact1Name',100)->nullable();
            $table->string('contact1Designation',100)->nullable();
            $table->string('contact1Mobile',15)->nullable();
            $table->string('contact2Name',100)->nullable();
            $table->string('contact2Designation',100)->nullable();
            $table->string('contact2Mobile',15)->nullable();
            $table->string('contact3Name',100)->nullable();
            $table->string('contact3Designation',100)->nullable();
            $table->string('contact3Mobile',15)->nullable();
            $table->string('contact4Name',100)->nullable();
            $table->string('contact4Designation',100)->nullable();
            $table->string('contact4Mobile',15)->nullable();
            $table->string('contact5Name',100)->nullable();
            $table->string('contact5Designation',100)->nullable();
            $table->string('contact5Mobile',15)->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('createdBy');
            $table->tinyInteger('updatedBy');
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
        Schema::dropIfExists('customers');
    }
}
