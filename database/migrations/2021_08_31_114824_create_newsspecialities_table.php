<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsspecialitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsspecialities', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name')->collation('utf8_general_ci');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
        $newsspeciality = new \App\Models\Newsspeciality();
        $newsspeciality->name = 'Top News' ;
        $newsspeciality->save();
        $newsspeciality = new \App\Models\Newsspeciality();
        $newsspeciality->name = 'Top Sliding News' ;
        $newsspeciality->save();
        $newsspeciality = new \App\Models\Newsspeciality();
        $newsspeciality->name = 'Details News' ;
        $newsspeciality->save();
        $newsspeciality = new \App\Models\Newsspeciality();
        $newsspeciality->name = 'None' ;
        $newsspeciality->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('newsspecialities');
    }
}
