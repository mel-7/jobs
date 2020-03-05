<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('auth')->except(['postAPI']);
    }

    public function categoryListAPI()
    {
        $productCategories = Product_categories::all();

        return collect($productCategories);
    }  

    public function categoryTreeAPI()
    {
        $productCategories = Product_categories::all();

        function recurse_uls($array, $parent)
        {
            $return = array();
            foreach ($array as $c => $p)  {
                if ($p['parent'] != $parent) continue;
                $return[] = $p;
                $data = recurse_uls ($array, $p['id']);
                if($data) {
                    $length = count($return);
                    $return[$length - 1]['children'] = $data;
                }
            }
            return empty($return) ? null : $return;
        }
        
        $data = recurse_uls ($productCategories, 0);

        return $data;
    }    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index');
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
}
