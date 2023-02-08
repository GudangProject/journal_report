<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loas', function (Blueprint $table) {
            $table->id();
            $table->integer('journal_id');
            $table->string('link')->nullable();
            $table->integer('user_id');
            $table->string('username')->nullable();
            $table->integer('created_by');
            $table->integer('status');
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
        Schema::dropIfExists('loas');
    }
}
