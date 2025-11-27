<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVerificationCodeAndVerificationExpireAtToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maanusers', function (Blueprint $table) {
            $table->string('verification_code',20)->nullable()->after('password');
            $table->timestamp('verification_expire_at')->nullable()->after('verification_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('maanusers', function (Blueprint $table) {
            $table->dropColumn('verification_code');
            $table->dropColumn('verification_expire_at');
        });
    }
}
