<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpedingMoneyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('speding_money', function (Blueprint $table) {
            $table->id();
            $table->integer('mybank_id');
            $table->bigInteger('amount');
            $table->text('description')->nullable();
            $table->integer('used_by');
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
        Schema::dropIfExists('speding_money');
    }
}
