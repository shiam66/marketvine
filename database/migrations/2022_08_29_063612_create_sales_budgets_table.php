<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_budgets', function (Blueprint $table) {
            $table->id();
            $table->integer('budgetYear');
            $table->float('salesJan', 10, 2)->nullable();
            $table->float('salesFeb', 10, 2)->nullable();
            $table->float('salesMar', 10, 2)->nullable();
            $table->float('salesApr', 10, 2)->nullable();
            $table->float('salesMay', 10, 2)->nullable();
            $table->float('salesJun', 10, 2)->nullable();
            $table->float('salesJul', 10, 2)->nullable();
            $table->float('salesAug', 10, 2)->nullable();
            $table->float('salesSep', 10, 2)->nullable();
            $table->float('salesOct', 10, 2)->nullable();
            $table->float('salesNov', 10, 2)->nullable();
            $table->float('salesDec', 10, 2)->nullable();
            $table->float('salesTotal', 10, 2)->nullable();
            $table->float('cogsJan', 10, 2)->nullable();
            $table->float('cogsFeb', 10, 2)->nullable();
            $table->float('cogsMar', 10, 2)->nullable();
            $table->float('cogsApr', 10, 2)->nullable();
            $table->float('cogsMay', 10, 2)->nullable();
            $table->float('cogsJun', 10, 2)->nullable();
            $table->float('cogsJul', 10, 2)->nullable();
            $table->float('cogsAug', 10, 2)->nullable();
            $table->float('cogsSep', 10, 2)->nullable();
            $table->float('cogsOct', 10, 2)->nullable();
            $table->float('cogsNov', 10, 2)->nullable();
            $table->float('cogsDec', 10, 2)->nullable();
            $table->float('cogsTotal', 10, 2)->nullable();
            $table->float('oeJan', 10, 2)->nullable();
            $table->float('oeFeb', 10, 2)->nullable();
            $table->float('oeMar', 10, 2)->nullable();
            $table->float('oeApr', 10, 2)->nullable();
            $table->float('oeMay', 10, 2)->nullable();
            $table->float('oeJun', 10, 2)->nullable();
            $table->float('oeJul', 10, 2)->nullable();
            $table->float('oeAug', 10, 2)->nullable();
            $table->float('oeSep', 10, 2)->nullable();
            $table->float('oeOct', 10, 2)->nullable();
            $table->float('oeNov', 10, 2)->nullable();
            $table->float('oeDec', 10, 2)->nullable();
            $table->float('oeTotal', 10, 2)->nullable();
            $table->float('recJan', 10, 2)->nullable();
            $table->float('recFeb', 10, 2)->nullable();
            $table->float('recMar', 10, 2)->nullable();
            $table->float('recApr', 10, 2)->nullable();
            $table->float('recMay', 10, 2)->nullable();
            $table->float('recJun', 10, 2)->nullable();
            $table->float('recJul', 10, 2)->nullable();
            $table->float('recAug', 10, 2)->nullable();
            $table->float('recSep', 10, 2)->nullable();
            $table->float('recOct', 10, 2)->nullable();
            $table->float('recNov', 10, 2)->nullable();
            $table->float('recDec', 10, 2)->nullable();
            $table->float('recTotal', 10, 2)->nullable();
            $table->tinyInteger('createdBy')->nullable();
            $table->tinyInteger('updatedBy')->nullable();
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
        Schema::dropIfExists('sales_budgets');
    }
}
