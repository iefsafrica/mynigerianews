<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ConvertLegacyUtf8mb3TablesToUtf8mb4 extends Migration
{
    /**
     * Tables that still contain explicit utf8mb3_general_ci columns.
     *
     * @var array<int, string>
     */
    protected $tables = [
        'blogs',
        'maanusers',
        'newsspecialities',
        'settings',
        'users',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->convertTables('utf8mb4', 'utf8mb4_unicode_ci');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->convertTables('utf8mb3', 'utf8mb3_general_ci');
    }

    /**
     * Convert configured tables to the given charset/collation.
     *
     * @param  string  $charset
     * @param  string  $collation
     * @return void
     */
    protected function convertTables($charset, $collation)
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        foreach ($this->tables as $table) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            DB::statement(sprintf(
                'ALTER TABLE `%s` CONVERT TO CHARACTER SET %s COLLATE %s',
                str_replace('`', '``', $table),
                $charset,
                $collation
            ));
        }
    }
}
