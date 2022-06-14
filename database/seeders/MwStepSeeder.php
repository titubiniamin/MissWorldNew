<?php

namespace Database\Seeders;

//use App\Models\MwStep;
use App\Models\MwStep;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MwStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $data=
           [
             ['step_num'=>1,'step_name'=>'Applicant Round','step_status'=>1,'is_current'=>0,'is_for_vote'=>0],
             ['step_num'=>2,'step_name'=>'Audition Round','step_status'=>1,'is_current'=>0,'is_for_vote'=>0],
             ['step_num'=>3,'step_name'=>'Head to Head Round','step_status'=>1,'is_current'=>0,'is_for_vote'=>0],
             ['step_num'=>4,'step_name'=>'Top Model Round','step_status'=>1,'is_current'=>0,'is_for_vote'=>0],
             ['step_num'=>5,'step_name'=>'Sports Round','step_status'=>1,'is_current'=>0,'is_for_vote'=>0],
             ['step_num'=>6,'step_name'=>'Talent Round','step_status'=>1,'is_current'=>0,'is_for_vote'=>0],
             ['step_num'=>7,'step_name'=>'Multimedia Round','step_status'=>1,'is_current'=>0,'is_for_vote'=>0],
             ['step_num'=>8,'step_name'=>'Gala Round','step_status'=>1,'is_current'=>0,'is_for_vote'=>0],
           ];
//       MwStep::create($data);
        MwStep::insert($data);
    }
}
