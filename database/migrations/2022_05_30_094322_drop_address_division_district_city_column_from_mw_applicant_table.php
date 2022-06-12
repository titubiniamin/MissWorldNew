<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropAddressDivisionDistrictCityColumnFromMwApplicantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mw_applicants', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('street_address');
            $table->dropColumn('country');
            $table->dropColumn('division');
            $table->dropColumn('district');
            $table->dropColumn('city');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mw_applicant', function (Blueprint $table) {
            //
        });
    }
}
