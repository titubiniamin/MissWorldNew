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
        if ($request->ajax()) {
            $currentStep = MwStep::where('is_current', 1)->first()->id;
            $applicants = MwApplicant::with('address.upazilla.district.division', 'imageVideo', 'user')
                ->where('f_current_steps', $currentStep)
                ->get();

            return Datatables::of($applicants)->addIndexColumn()
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->first_name . " " . $row->last_name;
                })
                ->addColumn('photo', function ($row) {
                    $image = $row->imageVideo->close_up_photo ? asset('storage/applicant_image/' . $row->imageVideo->close_up_photo) : asset('images/blank.png');
                    return '<img src="' . $image . '" height="100" width="100">';
                })
                ->addColumn('video', function ($row) {
                    if ($row->imageVideo->video) {
                        $video = asset('storage/applicant_image/' . $row->imageVideo->video);
                        $result = '<video src="' . $video . '" height="100" width="150" controls>
                                <source src="' . $video . '" type="video/mp4">
                                <source src="' . $video . '" type="video/ogg">
                            </video> ';
                    } else {
                        $blank = asset('images/no-video.png');
                        $result = '<img src="' . $blank . '" height="100" width="100">';
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
                    return date_diff(date_create($row->date_of_birth), date_create('today'))->y;
                })
                ->addColumn('address', function ($row) {
                    return $row->address->address . ', Division: ' . $row->address->division->name . ', District: ' . $row->address->division->name . ', Upazilla: ' . $row->address->upazilla->name;
                })
                ->addColumn('step', function ($row) {
                    $step = MwStep::where('id', $row->f_current_steps)->get()->first();

                    return $step->step_name;
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
                        '<select id="step" class="form-control" onchange="getSteps()">
                        <option disabled selected>Change/Jump Next Round</option>
                        ' . $options . '</select>';


                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'step_change', 'photo', 'video'])
                ->make(true);
        }
        return view('admin.participant_list');

    }

    public function stepChange($stepId)
    {
        return $stepId;
    }


//    public function test()
//    {
//        $division = Division::with('districts.upazilla')->get();
//        dd($division->districts->random()->id);
//        $upazilla = Upazilla::with('district.division')->get()->random();
//        dd($upazilla->district->division->id);
//        $user = User::factory(1)->create();
//        dd($user[0]->id);
//        return Schema::getColumnListing('mw_applicants');
////      $upazilla =  Upazilla::with('district.division')->get()->random();
//        $division = Division::with('districts.upazilla')->get()->random();
//        dd($division->districts->random()->upazilla->random());
//
//    }

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
