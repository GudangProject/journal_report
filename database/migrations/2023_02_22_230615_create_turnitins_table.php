<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurnitinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnitins', function (Blueprint $table) {
            $table->id();
            // $table->integer('journal_id');
            $table->string('link_turnitin')->nullable();
            $table->string('link_surat_pernyataan')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('username')->nullable();
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('turnitins');
    }
}
