<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable(false);
            $table->string('slug')->nullable(false)->unique();
            $table->string('description')->nullable(false)->default('');
            $table->unsignedInteger('author')->nullable(false);
            $table->string('layout')->default('default');
            $table->string('type')->default("article");
            $table->integer('status')->default(0);
            $table->softDeletes();
            $table->timestamps();


            $table->index(['title', 'type', 'author']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post');
    }
}
