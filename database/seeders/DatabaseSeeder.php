<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\District;
use App\Models\Division;
use App\Models\MwApplicant;
use App\Models\MwApplicantAddress;
use App\Models\MwStep;
use App\Models\Upazilla;
use App\Models\User;
use Database\Factories\MwApplicantAddressFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $seeds=['DistrictSeeder','AdminSeeder','MwStepSeeder','UpazillaSeeder','AdminSeeder'];
//        foreach($seeds as $seed){
//            $this->call($seed);
//        }
        $this->call(AdminSeeder::class);
        $this->call(MwStepSeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(UpazillaSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TestSeeder::class);


//         User::factory(10)->create();
//        $this->call(MwApplicantAddressSeeder::class);
//              MwApplicantAddress::factory(10)->create();
//        $this->call(UserSeeder::class);
//        $faker = Faker\Factory::create();
//        echo $faker->name;
//          for ($i = 0; $i < 10; $i++) {
//            User::factory(1)->create();
//            MwApplicant::create([
//                "user_id"=>User::latest()->first()->id,
//                "nid"=>$faker->,
//                "passport_no",
//                "birth_certificate_no",
//                "first_name",
//                "last_name",
//                "date_of_birth",
//                "occupation",
//                "mobile_no",
//                "height",
//                "weight",
//                "bust",
//                "waist",
//                "hips",
//                "chest",
//                "talent",
//                "talent_other",
//                "habits",
//                "habits_other",
//                "tell_us",
//                "guardian_name",
//                "relation_with_guardian",
//                "guardian_contact_no",
//                "why_participate",
//                "country_visited",
//                "beauty_purpose",
//                "social_link",
//                "hair_color",
//                "eye_color",
//                "rating",
//                "rating_5",
//                "ip_address",
//                "browser_info",
//                "updated_by",
//                "disqualified_round",
//                "disqualified_time",
//                "disqualified_reason",
//                "mail_status",
//                "f_current_steps",
//                "is_we_done",
//                "reject_step",
//                "result_status",
//                "reffer",
//                "admin_comment",
//                "is_view",
//                "last_round_change_user",
//                "last_round_change_user_ip",
//                "education",
//                "travel",
//                "experience",
//                "applicant_group",
//            ]);
//            $division = Division::with('districts.upazilla')->get()->random();
//
//            MwApplicantAddress::create([
//                'user_id' => User::latest()->first()->id,
//                'division_id' => $division->id,
//                'district_id' => $division->districts->random()->id,
//                'upazilla_id' => $division->districts->random()->upazilla->random()->id,
//                'address' => Str::random(15),
//            ]);
//        }


    }
}
