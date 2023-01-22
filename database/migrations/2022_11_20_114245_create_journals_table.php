<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('knowledge_id')->nullable();
            $table->string('name');
            $table->string('volume')->nullable();
            $table->string('number')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('semester')->nullable();
            $table->text('link_issue')->nullable();
            $table->string('indexasi')->nullable();
            $table->string('afiliate')->nullable();
            $table->bigInteger('total');
            $table->integer('created_by');
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journals');
    }
}
