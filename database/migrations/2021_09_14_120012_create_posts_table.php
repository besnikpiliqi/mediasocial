<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->text('content');
            $table->string('photo')->nullable();
            $table->timestamps();

            // $table->integer(’article_id’)  
            //       ->unsigned()  
            //       ->index();  
            // $table->foreign(’article_id’)  
            //       ->references(’id’)  
            //       ->on(’articles’)  
            //       ->onDelete(’cascade’);  
  
            // $table->integer(’category_id’)  
            //       ->unsigned()  
            //       ->index();  
            // $table->foreign(’category_id’)  
            //       ->references(’id’)  
            //       ->on(’categories’)  
            //       ->onDelete(’cascade’);
            // $table->primary([’article_id’, ’category_id’]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
