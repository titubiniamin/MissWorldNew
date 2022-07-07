<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Division;
use App\Models\MwApplicantAddress;
use App\Models\Upazilla;
use App\Models\User;
use Illuminate\Database\Seeder;

class MwApplicantAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MwApplicantAddress::create([
            'user_id'=>User::all()->random()->id,
            'division_id'=>Division::all()->random()->id,
            'district_id'=>District::all()->random()->id,
            'upazilla_id'=>Upazilla::all()->random()->id,
            'address'=>"sdfsdf",
        ]);
    }
}
