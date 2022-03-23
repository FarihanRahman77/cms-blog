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
            // $table->id();
            $table->bigInteger('id');
            $table->bigInteger('users_id');
            $table->bigInteger('parent_post_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description');
            $table->bigInteger('is_published'); 
            $table->string('createdAt');
            $table->string('updatedAt');
            $table->string('publishedAt');
            $table->text('description');
            $table->text('tags');
            $table->string('post_image');
            $table->bigInteger('views'); 
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
        Schema::dropIfExists('posts');
    }
}
