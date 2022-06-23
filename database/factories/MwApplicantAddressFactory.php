<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\Division;
use App\Models\Upazilla;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MwApplicantAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
//        $upazilla =  Upazilla::with('district.division')->get()->random();
//             return [
//                 'user_id'=>User::all()->random()->id,
//                 'division_id'=>$upazilla->district->division->id,
//                 'district_id'=>$upazilla->district->id,
//                 'upazilla_id'=>$upazilla->id,
//                 'address'=>$this->faker->text(50),
//             ];

        $division = Division::with('districts.upazilla')->get()->random();

        return [
            'user_id' => User::get()->random()->id,
            'division_id' => $division->id,
            'district_id' => $division->districts->random()->id,
            'upazilla_id' => $division->districts->random()->upazilla->random()->id,
            'address' => $this->faker->address(),
        ];

    }
}
