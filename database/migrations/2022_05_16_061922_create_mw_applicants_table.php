<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMwApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mw_applicants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unique();
            $table->integer('regno')->nullable();
            $table->integer('roll_no')->nullable();
            $table->integer('nid')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('birth_certificate_no')->nullable();
            $table->string('first_name',100);
            $table->string('last_name',100)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('occupation')->nullable();
            $table->text('address')->nullable();
            $table->text('street_address')->nullable();
            $table->integer('country')->nullable();
            $table->integer('division')->nullable();
            $table->integer('district')->nullable();
            $table->string('city',100)->nullable();
            $table->string('mobile_no',15)->nullable();
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->float('bust')->nullable();
            $table->float('waist')->nullable();
            $table->float('hips')->nullable();
            $table->float('chest')->nullable();
            $table->string('talent')->nullable();
            $table->string('talent_other')->nullable();
            $table->string('habits')->nullable();
            $table->string('habits_other')->nullable();
            $table->string('tell_us')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('relation_with_guardian')->nullable();
            $table->string('guardian_contact_no')->nullable();
            $table->string('why_participate')->nullable();
            $table->string('country_visited')->comment('This will be string of country id')->nullable();
            $table->string('beauty_purpose')->nullable();
            $table->string('hair_color')->nullable();
            $table->string('eye_color')->nullable();
            $table->float('rating')->nullable();
            $table->float('rating_5')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('browser_info')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('disqualified_round')->nullable();
            $table->date('disqualified_time')->nullable();
            $table->string('disqualified_reason')->nullable();
            $table->integer('mail_status')->nullable();
            $table->integer('f_current_steps')->nullable();
            $table->integer('is_we_done')->nullable();
            $table->integer('reject_step')->nullable();
            $table->integer('result_status')->nullable();
            $table->string('reffer')->nullable();
            $table->string('admin_comment')->nullable();
            $table->integer('is_view')->nullable();
            $table->string('last_round_change_user')->nullable();
            $table->string('last_round_change_user_ip')->nullable();
            $table->string('education')->nullable();
            $table->string('travel')->nullable();
            $table->string('experience')->nullable();
            $table->string('applicant_group')->nullable();
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
        Schema::dropIfExists('mw_applicants');
    }
}
