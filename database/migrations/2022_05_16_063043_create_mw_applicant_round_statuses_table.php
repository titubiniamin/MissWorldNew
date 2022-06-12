<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMwApplicantRoundStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mw_applicant_round_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('status')->nullable();
            $table->string('status_round3')->nullable();
            $table->string('status_round4')->nullable();
            $table->string('status_round5')->nullable();
            $table->string('status_round6')->nullable();
            $table->string('status_round7')->nullable();
            $table->dateTime('check_in_time_r3')->nullable();
            $table->dateTime('check_in_time_r4')->nullable();
            $table->dateTime('check_in_time_r5')->nullable();
            $table->dateTime('check_in_time_r6')->nullable();
            $table->dateTime('check_in_time_r7')->nullable();
            $table->dateTime('round2_status_day')->nullable();
            $table->dateTime('round3_status_day')->nullable();
            $table->dateTime('round4_status_day')->nullable();
            $table->dateTime('round5_status_day')->nullable();
            $table->dateTime('round6_status_day')->nullable();
            $table->dateTime('round7_status_day')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mw_applicant_round_statuses');
    }
}
