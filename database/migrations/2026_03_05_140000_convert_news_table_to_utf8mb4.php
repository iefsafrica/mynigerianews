<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ConvertNewsTableToUtf8mb4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (DB::getDriverName() !== 'mysql' || ! Schema::hasTable('news')) {
            return;
        }

        DB::statement('ALTER TABLE `news` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (DB::getDriverName() !== 'mysql' || ! Schema::hasTable('news')) {
            return;
        }

        DB::statement('ALTER TABLE `news` CONVERT TO CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci');
    }
}
