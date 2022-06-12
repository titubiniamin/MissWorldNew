<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreParticipantsRequest;
use App\Models\Country;
use App\Models\District;
use App\Models\Division;
use App\Models\MwApplicant;
use App\Models\MwApplicantAddress;
use App\Models\MwApplicantImageVideo;
use App\Models\Upazilla;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        dd(Auth::user()->id);
//        return Auth::user()->created_at;
        $mwApplicant = MwApplicant::query()->where('user_id', Auth::id())->with('user')->first();
        $mwApplicantAddress = MwApplicantAddress::where('user_id', Auth::id())->first();

        $divisions = Division::query()->with('districts')->get();
        $mwApplicantImageVidoes = mwApplicantImageVideo::query()->where('user_id', Auth::id())->first();
//        dd($mwApplicantImageVidoes);
        $countries = Country::all();
//        print_r($countries);
//        dd($countries);
        $data = compact('mwApplicant', 'divisions', 'mwApplicantAddress', 'mwApplicantImageVidoes','countries');
        return view('user.registration', $data);
    }
    function updateRegister(StoreParticipantsRequest $request)
    {
//        dd($request->all());
        $allData = $request->all();

        //If user submits talent input then reform talent array with comma separated and build new array data as $newData
//        if(array_key_exists('talent',$allData))
//        {
//        $talent['talent'] =implode(',',$allData['talent']);
//        unset($allData['talent']);
//        $newData=array_merge($allData,$talent);
////        unset($allData['talent']);
//        }


        $authId = Auth::id();
        $mwApplicant = MwApplicant::UpdateOrCreate(
            ['user_id' => $authId
            ], $allData
        );

        $mwApplicantAddress = MwApplicantAddress::UpdateOrCreate(
            ['user_id' => $authId],
            $request->all()
        );

//        $closeUpPhotoNewName = nullOrEmptyString();
//        $midShotPhotoNewName = nullOrEmptyString();
//        $fullLengthPhotoNewName = nullOrEmptyString();
        if ($request->hasFile('close_up_photo')) {
            $closeUpPhoto = $request->file('close_up_photo');
            $closeUpPhotoExtenstion = $closeUpPhoto->getClientOriginalExtension();
            $closeUpPhotoNewName = Str::random(8) . '-' . time() . '-close_up.' . $closeUpPhotoExtenstion;
            Storage::disk('public')->put('/applicant_image/' . $closeUpPhotoNewName, File::get($closeUpPhoto));

        }
        if ($request->hasFile('mid_shot_photo')) {
            $midShotPhoto = $request->file('mid_shot_photo');
            $midShotPhotoExtenstion = $midShotPhoto->getClientOriginalExtension();
            $midShotPhotoNewName = Str::random(8) . '-' . time() . '-mid_shot.' . $midShotPhotoExtenstion;
            Storage::disk('public')->put('/applicant_image/' . $midShotPhotoNewName, File::get($midShotPhoto));

        }
        if ($request->hasFile('full_length_photo')) {
            $fullLengthPhoto = $request->file('full_length_photo');
            $fullLengthPhotoExtenstion = $fullLengthPhoto->getClientOriginalExtension();
            $fullLengthPhotoNewName = Str::random(8) . '-' . time() . '-full_length.' . $fullLengthPhotoExtenstion;
            Storage::disk('public')->put('/applicant_image/' . $fullLengthPhotoNewName, File::get($fullLengthPhoto));

        }
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $videoExtenstion = $video->getClientOriginalExtension();
            $videoNewName = Str::random(8) . '-' . time() . '-video.' . $videoExtenstion;
            Storage::disk('public')->put('/applicant_video/' . $videoNewName, File::get($video));

        }
//        dd(0);
        $mwApplicantImageVideo = MwApplicantImageVideo::query();
        $mwApplicantImgVid = $mwApplicantImageVideo->where('user_id', $authId)->first();
        $mwApplicantImageVideo = $mwApplicantImageVideo->UpdateOrCreate(
            ['user_id' => $authId],
            [
                'close_up_photo' => $closeUpPhotoNewName ?? $mwApplicantImgVid->close_up_photo ?? null,
                'mid_shot_photo' => $midShotPhotoNewName ?? $mwApplicantImgVid->mid_shot_photo ?? null,
                'full_length_photo' => $fullLengthPhotoNewName ?? $mwApplicantImgVid->full_length_photo ?? null,
                'video' => $videoNewName ?? $mwApplicantImgVid->video ?? null,
            ]
        );


        return redirect()->back()->with('success', 'Data saved');
    }


    public function getDistrict($division_id)
    {
        return District::query()->where('division_id', $division_id)->get();

    }

    public function getUpazillas($district_id)
    {
        return $upazilla = Upazilla::query()->where('district_id', $district_id)->get();
//        dd($upazilla);
    }


    public function uploadTest()
    {
        return view('upload_test');
    }

    public function uploadTestStore(Request $request)
    {

        if ($request->hasFile('upload_file')) {
            $request->validate([
                'upload_file' => 'required|mimes:jgp,jpeg,png'
            ]);

            $originaName = $request->file('upload_file')->getClientOriginalName();
            $newName = time() . '.' . $request->file('upload_file')->getClientOriginalExtension();
            $resultUpload = Storage::disk('public')->put('' . $newName, File::get($request->file('upload_file')));
            if ($resultUpload) {
                Storage::disk('/public')->put('path', File::get($request->file('upload_file')));
                $file = new TestFile();
                $file->path = $newName;
                $file->type = 1;
                $file->save();

                dd($file->id);


            }
        }


    }

    public function test()
    {
        $mwApplicant = MwApplicant::query()->where('user_id', Auth::id())->first();
//        dd($mwApplicant);
        $data = compact('mwApplicant');
        return view('test', $data);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
