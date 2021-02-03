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
			$table->string('post_slug')->unique();
            $table->string('blog_url');
			$table->string('user_id');
			$table->string('title');
			$table->text('summary')->nullable();
            $table->text('body')->nullable();
			$table->string('featured_image')->nullable();
			$table->string('featured_image_caption')->nullable();
			$table->timestamps();
        });

		Schema::create('post_views', function (Blueprint $table) {
            $table->id();
			$table->string('post_id');
			$table->string('user_id')->nullable();
			$table->string('ip')->nullable();
			$table->string('referer')->nullable();
			$table->timestamps();
        });

		Schema::create('post_likes', function (Blueprint $table) {
            $table->id();
			$table->string('post_id');
			$table->string('user_id');
			$table->string('ip')->nullable();
			$table->string('referer')->nullable();
			$table->timestamps();
        });

		Schema::create('blog_subscription', function (Blueprint $table) {
            $table->id();
			$table->string('blog_id');
			$table->string('user_id');
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
		Schema::dropIfExists('post_views');
		Schema::dropIfExists('post_likes');
        Schema::dropIfExists('blog_subscription');
    }
}
