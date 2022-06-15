<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMwFingerprintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mw_fingerprints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admins')->cascadeOnDelete();
            $table->ipAddress('admin_login_ip')->nullable();
            $table->string('admin_browser_info')->nullable();
            $table->boolean('is_active')->default(0)->comment("0 => InActive 1 => Active");
            $table->timestamp('last_login_time')->nullable();
            $table->string('browser_finger_print');
            $table->string('last_action')->nullable()->comment('when admin request for browser authenticate');
            $table->string('request_user')->nullable();
            $table->string('comment')->nullable();
            $table->string('last_approved_user')->comment('which admin accepted for authenticated user')->nullable();
            $table->string('approve_user_ip')->nullable();
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
        Schema::dropIfExists('mw_fingerprints');
    }
}
