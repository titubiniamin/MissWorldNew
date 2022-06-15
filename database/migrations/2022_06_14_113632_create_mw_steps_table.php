<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMwStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mw_steps', function (Blueprint $table) {
            $table->id();
            $table->integer('step_num');
            $table->string('step_name')->default(null);
            $table->integer('step_status')->nullable();
            $table->integer('is_current')->default(0);
            $table->integer('is_for_vote')->default(0);
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
        Schema::dropIfExists('mw_steps');
    }
}
