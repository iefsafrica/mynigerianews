<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogsubcategories', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('category_id');
            $table->string('name',100);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('blogcategories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogsubcategories');
    }
}
