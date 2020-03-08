<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('auth')->except(['categoryTreeAPI', 'categoryListAPI']);
    }

    public function categoryListAPI()
    {
        $productCategories = Category::all();

        return collect($productCategories);
    }  

    public function categoryTreeAPI()
    {
        $productCategories = Category::all();

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
        $category = Category::create($this->validateRequest()); // Working
        // return request
        return response()->json([
            'request' => $category,
            'message' => 'Product category has been added'
        ], 200);
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


    /**
     * Form Validation
     */
    public function validateRequest()
    {
        return request()->validate([
            'slug' => ['min:1', 'max:50', 'string', 'alpha_dash', 'unique:categories'],
            'title' => ['required', 'min:1', 'max:50', 'string'],
            'parent' => ['required', 'numeric'],
        ]);

    }
}
