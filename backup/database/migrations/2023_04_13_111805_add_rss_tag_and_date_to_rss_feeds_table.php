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
        Schema::table('rss_feeds', function (Blueprint $table) {
            $table->string('tags')->nullable()->after('post_draft');
            $table->timestamp('scheduled_delete_post_time')->nullable()->after('post_draft');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rss_feeds', function (Blueprint $table) {
            //
        });
    }
};
