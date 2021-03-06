<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\District;
use App\Models\Division;
use App\Models\MwApplicant;
use App\Models\MwApplicantAddress;
use App\Models\MwFingerprint;
use App\Models\MwStep;
use App\Models\Upazilla;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function viewAdminLogin(Request $request)
    {
        $value = $request->session()->get('key');
        if ($value) return redirect()->route('admin.dashboard');
        else return view('admin.login');

    }

    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            $fingerPrint = $request->get('finger_print');
            $admin = Auth::guard('admin')->user();
            $mwFingerPrint = MwFingerprint::query()
                ->where(['admin_id' => $admin->id, 'browser_finger_print' => $fingerPrint])
                ->first();

            if ($mwFingerPrint && $mwFingerPrint->browser_finger_print == $fingerPrint && $mwFingerPrint->is_active == 1) {
                $request->session()->put('key', 'value');
                return redirect()->route('admin.dashboard');
            } else if ($mwFingerPrint == null) {
                return redirect()->route('admin.send.auth.request');
            } else {
                return redirect()->route('admin.send.auth.request')->with('error', 'Browser Authentication is Pending');
            }


        } else {
            session()->flash('error', 'Either Email/Password is incorrect');
            return back()->withInput($request->only('email'));
        }
    }

    public function dashboard(Request $request)
    {
//        if ($request->ajax()) {
//            $data = User::select('id','name','email')->get();
//            return Datatables::of($data)->addIndexColumn()
//                ->addColumn('action', function($row){
//                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action'])
//                ->make(true);
//        }
//        $step=MwStep::where('id',1)->get()->first();
//        return $step->step_name;
//
//        return view('admin.participant_list');
//        $steps = MwStep::all();
//        $currentStep = $steps->where('is_current', 1)->first()->id;
//        $applicants = MwApplicant::with(['user', function($query) use ($currentStep){
//            $query->with('address.upazilla,district.division','imageVideo')
//                ->where('f_current_step',$currentStep);
//        }]) ->get();
//
//            dd($applicants);
//        $steps = MwStep::all();
//        $currentStep = $steps->where('is_current', 1)->first()->id;
//        $applicants = MwApplicant::with('address.upazilla.district.division', 'imageVideo')
//            ->where('f_current_steps', 1)
//            ->get();
//            dd($applicants[0]->imageVideo->close_up_photo);
//        $data = ['test' => 'test'];
//        $steps = MwStep::all();
//        $currentStep = $steps->where('is_current', 1)->first()->id;
////        dd($currentStep);
//        $applicants = MwApplicant::with(['user'=> function($query) use ($currentStep){
//            $query->with('address.upazilla,district.division','imageVideo')
//                ->where('f_current_step',$currentStep);
//
//            }]) ->get();


//            dd($applicants);
        if ($request->ajax()) {
//            $data = MwApplicant::query()->with(['user' => function ($query) {
//                $query->with(['address.upazilla.district.division']);
//            }])->get();
//            $steps = MwStep::all();
            $currentStep = MwStep::where('is_current', 1)->first()->id;
            $applicants = MwApplicant::with('address.upazilla.district.division', 'imageVideo','user')
                ->where('f_current_steps', $currentStep)
                ->get();
//            $applicants = MwApplicant::with(['user', function($query) use ($currentStep){
//                $query->with('address.upazilla,district.division','imageVideo')
//                    ->where('f_current_step',$currentStep);
//            }]) ->get();

//            dd($applicants);
            return Datatables::of($applicants)->addIndexColumn()
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->first_name . " " . $row->last_name;
                })
                ->addColumn('photo', function ($row) {
                    $image = $row->imageVideo->close_up_photo ? asset('storage/applicant_image/'.$row->imageVideo->close_up_photo) : asset('images/blank.png') ;
                    return '<img src="' . $image . '" height="100" width="100">';
                })
                ->addColumn('video', function ($row) {
                    if($row->imageVideo->video){
                        $video= asset('storage/applicant_image/'.$row->imageVideo->video);
                        $result='<video src="' . $video . '" height="100" width="150" controls>
                                <source src="'.$video.'" type="video/mp4">
                                <source src="'.$video.'" type="video/ogg">
                            </video> ';
                    } else{
                        $blank=asset('images/no-video.png');
                        $result='<img src="' . $blank . '" height="100" width="100">';
                    }
                    return $result;

                })
                ->addColumn('mobile', function ($row) {
                    return $row->mobile_no;
                })
                ->addColumn('email', function ($row) {
                    return $row->user->email;
                })
                ->addColumn('date-of-birth', function ($row) {
                    return $row->date_of_birth;
                })
                ->addColumn('age', function ($row) {
//                    $age=date(strtotime(now()-strtotime($row->date_of_birth);
                    return date_diff(date_create($row->date_of_birth), date_create('today'))->y;
//                    return $age;
                })
                ->addColumn('address', function ($row) {
                    return $row->address->address . ', Division: ' . $row->address->division->name . ', District: ' . $row->address->division->name. ', Upazilla: ' . $row->address->upazilla->name;
                })
                ->addColumn('step', function ($row) {
                    $step = MwStep::where('id', $row->f_current_steps)->get()->first();

                    return $step->step_name;
//                    $step=MwStep::where('id',$row->f_current_steps)->get();
//                    return $step->name;
                })
                ->addColumn('step_change', function ($row) {
                    $steps = MwStep::all();
                    $options = "";
                    foreach ($steps as $step) {
                        if ($step->id >= $row->f_current_steps && $step->id < ($row->f_current_steps + 2)) {
                            $options .= '<option value="' . $step->id . '"' . ($step->id == $row->f_current_steps ? "selected" : "") . ' >' . $step->step_name . '</option>';
                        }
                    }
                    return
                        '<select class="form-control">
                        <option disabled selected>Change/Jump Next Round</option>
                        ' . $options . '</select>';


                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'step_change', 'photo','video'])
                ->make(true);

        }
//        dd($applicants);
        return view('admin.participant_list');

    }

    public function dashboardData(Request $request)
    {
        $limit = $request->limit ?? 10;
        $first_name = $request->first_name ?? null;
        $currentStep = MwStep::query()->where('is_current', 1)->first()->id;
        return $applicants = MwApplicant::where('first_name', 'like', '%' . $first_name . '%')
            ->whereHas('address.upazilla', function ($q) use ($first_name) {
                $q->where('name', 'like', '%' . $first_name . '%');
            })->with('address.upazilla.district.division', 'imageVideo')
            ->where('f_current_steps', $currentStep)
            ->orderBy('id')
            ->paginate($limit);
    }

    public function dashboard_bk(Request $request)
    {
//        $data = MwApplicant::query()->with(['user' => function ($query) {
//            $query->with(['address.upazilla.district.division','imageVideo']);
//        }])->get();
//        return $data;
        //////////////////////////
        ///
        $search = $request->search['value'] ?? null;
        $steps = MwStep::all();
        $districts = District::all();
        if ($request->ajax()) {
            $data = MwApplicant::query()
                ->with(['user' => function ($query) {
                    $query->with(['address.upazilla.district.division', 'image_video']);
                }])->get();
//$data=compact('steps','data');
            return Datatables::of($data)
                ->addColumn('full_name', function ($row) {
                    return $row->first_name . " " . $row->last_name;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

//        return view('users');
        return view('admin.dashboard', ['steps' => $steps, 'districts' => $districts]);
        /// //////////////////////////
        ///
//        $data2=MwApplicant::query()->select('*')
//            ->leftJoin('mw_applicant_addresses','mw_applicant_addresses.user_id','=','mw_applicants.id')
//            ->leftJoin('districts','districts.id','=','mw_applicant_addresses.district_id')->get();
//        dd($data2);
        $data = MwApplicant::query()->with(['user' => function ($query) {
            $query->with(['address.upazilla.district.division', 'imageVideo']);
        }])->get()->toArray();
        dd($data);
//dd($data[0]->user->address->address);
        dd($data);

        $value = $request->session()->get('key');
        if ($value) {
            $steps = MwStep::all()->sortBy('step_num');
            $currentStep = MwStep::query()->where('is_current', '=', 1)->first()->id;
            $districts = District::query()->orderBy('name', 'asc')->get();
            $mwApplicats = MwApplicant::all()->where('f_current_steps', $currentStep);
//            dd($mwApplicats);
//            $currentStep=MwStep::query()->where('is_current','=',1)->first()//not working;
//            $current_step = MwStep::where('is_current','=',1)->first()->id;
//            dd($currentStep);
            return view('admin.dashboard');
        } else return view('admin.login');

    }

    public function test()
    {
        $division = Division::with('districts.upazilla')->get();
        dd($division->districts->random()->id);
        $upazilla = Upazilla::with('district.division')->get()->random();
        dd($upazilla->district->division->id);
        $user = User::factory(1)->create();
        dd($user[0]->id);
        return Schema::getColumnListing('mw_applicants');
//      $upazilla =  Upazilla::with('district.division')->get()->random();
        $division = Division::with('districts.upazilla')->get()->random();
        dd($division->districts->random()->upazilla->random());
//        $division=Division::all();
//        $data = Upazilla::with('district')->get();
//        print_r($data);
//        $district=District::with(['division'=>function($query) use ($division){
//            dd($division);
//        }]);
//        dd($district);
//        $a=Upazilla::with(['district' =>  function($query) {
//            $query->orderByRaw('RAND()')->take(1);}])->get();
//        return $a;
    }

    public function test2(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('id', 'name', 'email')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.test');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        Session::flash('key');
        return redirect()->route('admin.login');
    }

    public function adminAuthRequest()
    {
        $adminEmail = Auth::guard('admin')->user()->email;
        $adminId = Auth::guard('admin')->user()->id;
        $data = compact('adminId', 'adminEmail');
        return view('admin.auth_request')->with($data);
    }

    public function postAdminAuthRequest(Request $request)
    {
//       dd($request->all());
        $fingerPrint = $request->finger_print;
        $browserInfo = $_SERVER['HTTP_USER_AGENT'];
        $adminId = Auth::guard('admin')->id();
        $comment = $request->comment;
        $create = MwFingerprint::create([
            'admin_id' => $adminId,
            'admin_login_ip' => $request->ip(),
            'admin_browser_info' => $browserInfo,
            'is_active' => 0,
            'last_login_time' => date('Y-m-d H:i:s'),
            'browser_finger_print' => $fingerPrint,
            'last_action' => 'Pending',
            'request_user' => Auth::guard('admin')->id(),
            'comment' => $comment,
        ]);

        $update = Admin::findOrFail($adminId);
        $update->browser_fingerprint = $fingerPrint;
        $update->last_action = 'pending';
        $update->last_login_time = date('Y-m-d H:i:s');
        $update->last_action_user_name = $adminId;
        $update->ip_address = $request->ip();
        $update->save();
        session()->flash('success', 'Contact Authorized person to accept your request');
        return view('admin.auth_request');
    }

}
