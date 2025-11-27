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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('rss_link')->nullable()->after('status');
            $table->boolean('is_rss')->default(false)->after('rss_link');
            $table->unsignedBigInteger('rss_id')->nullable()->after('is_rss');

            $table->foreign('rss_id')->references('id')->on('rss_feeds')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            //
        });
    }
};
