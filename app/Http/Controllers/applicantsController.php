<?php

namespace App\Http\Controllers;

use App\Applicant_details;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        //
    }

    public function getWorkExperience($id)
    {
        // $ad = Applicant_details::where('user', '=', 1);
        $ad = Applicant_details::where([
                'user' => $id,
                'type' => 'work_experience'
            ])->get();

        return response()->json([
            'ex' => $ad,
        ], 200);
        // return $ad;
    }

}
