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
            $table->bigIncrements('id');
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('role')->nullable();
            $table->text('industry')->nullable();
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->string('employment_type')->nullable();
            $table->boolean('remote')->default(false);
            $table->text('monthly_salary')->nullable();
            $table->integer('vacancy')->nullable();
            $table->text('description')->nullable();
            $table->text('desired_skills')->nullable();
            $table->boolean('status')->default(false);
            $table->unsignedInteger('author')->nullable();
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
