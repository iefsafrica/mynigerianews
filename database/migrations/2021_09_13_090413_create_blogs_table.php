<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('blogsubcategory_id');
            $table->string('title',100)->collation('utf8_general_ci');
            $table->string('summary')->collation('utf8_general_ci');
            $table->longText('description')->collation('utf8_general_ci');
            $table->integer('status')->default(0);
            $table->date('date');
            $table->string('tags',50)->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('blogsubcategory_id')->references('id')->on('blogsubcategories')->onDelete('cascade');
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
        Schema::dropIfExists('blogs');
    }
}
