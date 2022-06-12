<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMwFingerPrintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mw_finger_prints', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->string('admin_login_ip')->nullable();
            $table->string('admin_browser_info')->nullable();
            $table->integer('is_active')->nullable();
            $table->timestamp('last_login_time')->nullable();
            $table->timestamp('browser_finger_print');
            $table->string('last_action')->nullable()->comment('when admin request for browser authenticate');
            $table->string('request_user');
            $table->string('comment');
            $table->string('last_approved_user')->comment('which admin accepted for authenticated user');
            $table->string('approve_user_ip');
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
        Schema::dropIfExists('mw_finger_prints');
    }
}
