<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('auth')->except(['postAPI', 'edit']);
        // $this->middleware('auth')->only(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index');
    }

    public function postAPI()
    {
        $posts = Post::paginate(10);
        return $posts;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = Post::create($this->validateRequest());

        // return request
        return response()->json([
            'post'  => $post,
            'message' => 'Job post has been created'
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
        // https://www.mynotepaper.com/laravel-vue-crud-single-page-application-tutorial
        $post = Post::find($id);
        // $post = Post::where('id', '=', $id)->firstOrFail();
        return $post;
        // return response()->json($post);
        // return response()->json([
        //     'post'  => $post,
        //     'message' => 'Job post has been created'
        // ], 200);
        // return view('admin.posts.edit', compact('post'));
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
            'position' => ['required', 'min:1', 'max:50', 'string'],
            'slug' => ['min:1', 'max:50', 'string', 'alpha_dash', 'unique:posts'],
            'content' => [''],
        ]);

    }
}
