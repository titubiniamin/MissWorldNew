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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\ExcelServiceProvider;
use App\Exports\UserExport;
use function MongoDB\BSON\toJSON;

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
        $rounds = MwStep::query()->orderBy('step_num')->get();
        $districts = District::query()->orderBy('name')->get();
        if (request()->ajax()) {
            $currentStep = MwStep::where('is_current', 1)->first()->id;
            $applicants = MwApplicant::with('address.upazilla.district.division', 'imageVideo', 'user');

            if (!empty($request->round)) {


                $applicants = $applicants->where('f_current_steps', $request->round);


            }
            if (!empty($request->height)) {
                $applicants = $applicants->where('height', $request->height);
            }

            if (!empty($request->district)) {
                $applicants = $applicants->whereHas('address', function ($query) use ($request) {
                    $query->where('district_id', '=', $request->district);
                });
            }
            if (!empty($request->startDate) && !empty($request->endDate)) {
                $applicants = $applicants->whereBetween('created_at', [$request->startDate." 00:00:00", $request->endDate." 23:59:59"]);
//                $applicants = $applicants->where('id', '=',1);
            }
            if ($request->filled('photoStatus')) {
                if ($request->photoStatus == 1) {
                    $applicants = $applicants->whereHas('imageVideo');
                }
                else if ($request->photoStatus == 0) $applicants = $applicants->doesntHave('imageVideo');
            }



            if (!empty($request->applicationStatus)) {

                if ($request->applicationStatus == 1) {
                    $applicants = $applicants->where('mail_status', 1);
                }
            }

//            if (!empty($request->applicationStatus)) {
//
//                    if($request->applicationStatus == 1)
//                    {
//                        $applicants=$applicants->where('mail_status',1) ;
//                    }else if($request->applicationStatus == 0){
//                        $applicants=$applicants->where('mail_status', 0) ;
//                    }else{
//                        $applicants=$applicants->where('id',1);
//                    }
//            }

            return datatables()->of($applicants)
                ->addIndexColumn()
                ->setRowClass(function ($row) {
                    if ($row->mail_status == 0 && $row->is_view == 0) {
                        $class = "table-danger";
                    } else if ($row->mail_status == 0 && $row->is_view == 1) {
                        $class = "table-warning";
                    } else if ($row->mail_status == 1 && $row->is_view == 0) {
                        $class = "table-success";
                    } else {
                        $class = "table-default";
                    }
                    return $class;
                })
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->first_name . " " . $row->last_name;
                })
                ->addColumn('photo', function ($row) {
                    if ($row->imageVideo && $row->imageVideo->close_up_photo) {
                        $image = asset('storage/applicant_image/' . $row->imageVideo->close_up_photo);
                    } else {
                        $image = asset('images/blank.png');
                    }
//                    $image = $row->imageVideo->close_up_photo ? asset('storage/applicant_image/' . $row->imageVideo->close_up_photo) : asset('images/blank.png');
                    return '<img src="' . $image . '" height="100" width="100">';
                })
                ->addColumn('video', function ($row) {
                    if ($row->imageVideo && $row->imageVideo->video) {
                        $video = asset('storage/applicant_image/' . $row->imageVideo->video);
                        $result = '<video src="' . $video . '" height="100" width="150" controls>
                                <source src="' . $video . '" type="video/mp4">
                                <source src="' . $video . '" type="video/ogg">
                            </video> ';
                    } else {
                        $blank = asset('images/no-video.png');
                        $result = '<img src="' . $blank . '" height="50" width="50">';
                    }
                    return $result;

                })
                ->addColumn('height', function ($row) {
                    return $row->height;
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
                    return $row->address->address . ', Division: ' . $row->address->division->name . ', District: ' . $row->address->district->name . ', Upazilla: ' . $row->address->upazilla->name;
                })
                ->addColumn('step', function ($row) {
                    $step = MwStep::where('id', $row->f_current_steps)->get()->first();

                    return '<span id="step-' . $row->id . '">' . $step->step_name . ' </span>';
                })
                ->addColumn('step_change', function ($row) {
                    $steps = MwStep::all();
                    $options = "";
                    foreach ($steps as $step) {
                        if ($step->id >= $row->f_current_steps && $step->id < ($row->f_current_steps + 2)) {
                            $options .= '<option value="' . $step->id . '"' . ($step->id == $row->f_current_steps ? "selected" : "") . ' >' . $step->step_name . '</option>';
                        }
                    }
                    $id = $row->id;
                    return '<select id="step" class="form-control" onchange="getSteps(event,' . $id . ')">
                        <option disabled selected>Change/Jump Next Round</option>
                        ' . $options . '</select>';


                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'step_change', 'photo', 'video', 'step'])
                ->make(true);

        }
        $customer_name = MwApplicant::all();
        return view('custom-search', compact('customer_name', 'rounds', 'districts'));

    }

    public function stepChange($stepId, $id)
    {
        MwApplicant::find($id)->update(['f_current_steps' => $stepId]);
        return response()->json(['message' => 'Step Updated Successfully.']);
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

    public function export()
    {
        dd(1);
    }

}
