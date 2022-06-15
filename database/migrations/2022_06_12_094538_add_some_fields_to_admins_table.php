<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldsToAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('ip_address')->nullable()->after('password');
            $table->integer('is_active')->nullable();
            $table->integer('is_approved')->nullable();
            $table->string('type')->nullable();
            $table->string('desk_type')->nullable();
            $table->string('browser_fingerprint')->nullable();
            $table->string('last_action')->nullable();
            $table->dateTime('last_login_time')->nullable();
            $table->string('last_action_user_name')->nullable();
        });

    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            //
        });
    }
}
