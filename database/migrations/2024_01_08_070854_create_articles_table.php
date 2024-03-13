<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
			$table->uuid('id')->primary();
			$table->integer('category_id')->unsigned()->nullable();
			$table->string('title');
			$table->boolean('headline')->default(0);
			$table->string('slug');
			$table->string('tags')->nullable();
			$table->text('content');
			$table->string('keyword')->nullable();
			$table->string('description')->nullable();
			$table->string('img')->nullable();
			$table->string('embed', 500)->nullable();
			$table->date('date')->nullable();
			$table->integer('viewer')->unsigned()->nullable();
			$table->enum('status', ['publish', 'unpublish'])->nullable();
			$table->boolean('push_notif')->default(0);
			$table->string('parent', 36)->nullable();
			$table->string('publish_by', 36)->nullable();
			$table->string('created_by', 36);
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
        Schema::dropIfExists('articles');
    }
}
