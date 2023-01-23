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
            $table->integer('journal_id')->nullable();
            $table->string('manuscript_title')->nullable();
            $table->string('manuscript_link')->nullable();
            $table->integer('price');
            $table->string('payer_name');
            $table->string('payer_rekening');
            $table->string('payer_bank');
            $table->integer('mybank_id');
            $table->text('image');
            $table->text('description');
            $table->integer('created_by');
            $table->integer('status')->default(1);
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
