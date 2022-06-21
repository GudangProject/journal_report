<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10);
            $table->string('prefix')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->text('preview')->nullable();
            $table->longText('content');
            $table->string('image')->nullable();
            $table->string('caption')->nullable();
            $table->string('tags')->nullable();
            $table->integer('counter')->default(0);
            $table->tinyInteger('type')->default(1);
            $table->tinyInteger('status')->nullable();
            $table->integer('category_id');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
