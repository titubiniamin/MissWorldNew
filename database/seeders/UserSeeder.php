<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Division;
use App\Models\MwApplicant;
use App\Models\MwApplicantAddress;
use App\Models\MwApplicantImageVideo;
use App\Models\Upazilla;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=0;$i<10;$i++)
        {
            $user=User::factory(1)->create();
            MwApplicant::create([
                "user_id"=>$user[0]->id,
                "nid"=>$faker->unique()->numerify('#########'),
                "passport_no"=>$faker->unique()->numberBetween(1,10000),
                "birth_certificate_no"=>$faker->unique()->numerify,
                "first_name"=>$faker->firstName,
                "last_name"=>$faker->lastName,
                "date_of_birth"=>$faker->dateTime,
                "occupation"=>$faker->name,
                "mobile_no"=>$faker->numerify('###########'),
                "height"=>$faker->randomFloat(7,5,2),
                "weight"=>$faker->randomFloat(40,55,2),
                "bust"=>$faker->randomFloat(30,40,2),
                "waist"=>$faker->randomFloat(25,35,2),
                "hips"=>$faker->randomFloat(20,10,2),
                "chest"=>$faker->numerify,
                "talent"=>$faker->shuffleString,
                "talent_other"=>$faker->shuffleString,
                "habits"=>$faker->shuffleString,
                "habits_other"=>$faker->shuffleString,
                "tell_us"=>$faker->text,
                "guardian_name"=>$faker->name,
                "relation_with_guardian"=>$faker->name,
                "guardian_contact_no"=>$faker->phoneNumber(),
                "why_participate"=>$faker->text,
                "country_visited"=>$faker->numberBetween(1,100),
                "social_link"=>'http://'.$faker->name,
            ]);
            $upazilla=Upazilla::with('district.division')->get()->random();
            MwApplicantAddress::create([
                'user_id'=>$user[0]->id,
                'division_id'=>$upazilla->district->division->id,
                'district_id'=>$upazilla->district->id,
                'upazilla_id'=>$upazilla->id,
                'address'=>$faker->address
            ]);
            MwApplicantImageVideo::create([
                'user_id'=>$user[0]->id,
                'close_up_photo'=>$faker->imageUrl(150,150),
                'mid_shot_photo'=>$faker->imageUrl(150,150),
                'full_length_photo'=>$faker->imageUrl(150,150),
                'video'=>$faker->url
            ]);
        }


    }
}
