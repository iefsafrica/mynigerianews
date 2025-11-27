<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('album_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lang_id');
            $table->unsignedBigInteger('album_id');
            $table->string('name');
            $table->foreign('album_id')->references('id')->on('albums')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('lang_id')->references('id')->on('languages')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album_categories');
    }
};
