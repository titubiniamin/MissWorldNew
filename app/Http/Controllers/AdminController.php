<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\District;
use App\Models\MwApplicant;
use App\Models\MwFingerprint;
use App\Models\MwStep;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
//        $data = MwApplicant::query()->with(['user' => function ($query) {
//            $query->with(['address.upazilla.district.division','imageVideo']);
//        }])->get();
//        return $data;
        //////////////////////////
        ///
        $search = $request->search['value'] ?? null;
        $steps=MwStep::all();
        $districts=District::all();
        if ($request->ajax()) {
            $data = MwApplicant::query()
                ->with(['user' => function ($query) {
                $query->with(['address.upazilla.district.division','image_video']);
            }])->get();
//        dd($data);
            return Datatables::of($data)
                ->addColumn('full_name', function($row){
                    return $row->first_name." ".$row->last_name;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])

                ->make(true);
        }

//        return view('users');
        return view('admin.dashboard',['steps'=>$steps,'districts'=>$districts]);
        /// //////////////////////////
        ///
//        $data2=MwApplicant::query()->select('*')
//            ->leftJoin('mw_applicant_addresses','mw_applicant_addresses.user_id','=','mw_applicants.id')
//            ->leftJoin('districts','districts.id','=','mw_applicant_addresses.district_id')->get();
//        dd($data2);
        $data = MwApplicant::query()->with(['user' => function ($query) {
            $query->with(['address.upazilla.district.division','imageVideo']);
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
