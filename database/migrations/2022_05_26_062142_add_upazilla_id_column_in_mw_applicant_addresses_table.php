<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUpazillaIdColumnInMwApplicantAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mw_applicant_addresses', function (Blueprint $table) {
            $table->unsignedBigInteger('upazilla_id')->after('district_id')->nullable();
            $table->foreign('upazilla_id')->references('id')->on('upazillas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mw_applicant_addresses', function (Blueprint $table) {
            //
        });
    }
}
