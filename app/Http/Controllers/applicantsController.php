<?php

namespace App\Http\Controllers;

use App\User;
use App\Applicant_details;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ApplicantsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function dashboard()
    // {
    //     return view('user.dashboard');
    // }

    public function cv()
    {
        return view('user.cv');
    }

    public function account()
    {
        return view('user.account');
    }

    public function myApplications()
    {
        return view('user.myapplications');
    }

    public function getAccountInfo($id)
    {
        $user = User::where('id', '=', $id)->get();
        return response()->json([
            'user' => $user,
        ], 200);
    }

    public function updateAccountInfo(Request $request)
    {
        $user = User::where('id', '=', $request->id)->first();

        $user->update(
            $this->validate($request, [
                'name' => ['required', 'string', 'min:5', 'max:255'],
                'email' => ['string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required'],
            ])
        );
        return response()->json([
            'message' => 'Account settings have been updated'
        ], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // 'message' => auth()->id()
    public function store(Request $request)
    {
        $valueObj = json_decode($request->value);
        if( isset($valueObj->jobtitle) && isset($valueObj->company) && isset($valueObj->city) && isset($valueObj->description) ){
            $ad = Applicant_details::create($this->validateRequest());
            return response()->json([
                'message' => 'Work Experience has been created'
            ], 200);
        }else{
            return response()->json([
                'message' => 'Please fill in the fields accordingly'
            ], 422);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $valueObj = json_decode($request->value);
        if( isset($valueObj->jobtitle) && isset($valueObj->company) && isset($valueObj->city) && isset($valueObj->description) ){
            $ad = Applicant_details::find($request->id);
            $ad->value = $request->value;
            $ad->startdate = Carbon::parse($request->startdate);
            $ad->todate = $request->todate == null ? null : Carbon::parse($request->todate);
            $ad->topresent = $request->topresent;
            $ad->save($this->validateRequest());
            return response()->json([
                'message' => 'Work Experience has been updated',
            ], 200);
        }else{
            return response()->json([
                'message' => 'Please fill in the fields accordingly'
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Applicant_details::where('id', '=', $id)->firstOrFail()->delete();
        return response()->json([
            'message' => 'Work Experience has been deleted'
        ], 200);
    }

    public function getWorkExperience($id)
    {
        // $ad = Applicant_details::where('user', '=', 1);
        $ad = Applicant_details::where([
            'user' => $id,
            'type' => 'work_experience'
        ])->get();
        return response()->json([
            'exp' => $ad,
        ], 200);
    }

    /**
     * Validate Post Request
     */
    public function validateRequest()
    {
        return request()->validate([
            'user' => ['required'],
            'type' => ['required'],
            'value' => ['required'],
            'startdate' => ['required'],
            'todate' => [''],
            'topresent' => ['required'],
        ]);

    }
}
