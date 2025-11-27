<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaanusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maanusers', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('first_name',100)->collation('utf8_general_ci')->nullable();
            $table->string('last_name',100)->collation('utf8_general_ci')->nullable();
            $table->string('phone',50)->collation('utf8_general_ci')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();;
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
        Schema::dropIfExists('maanusers');
    }
}
