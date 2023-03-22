<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function index()
    {
        $posts = Post::orderBy('id','desc')->paginate(5);
        return view('posts.index', compact('posts'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('posts.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'short_desc' => 'required',
        ]);
        
        Post::create($request->post());

        return redirect()->route('posts.index')->with('success','Post has been created successfully.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\company  $company
    * @return \Illuminate\Http\Response
    */
    public function show(Post $post)
    {
        return view('posts.show',compact('post'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function edit(Post $post)
    {
        return view('posts.edit',compact('post'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\company  $company
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'short_desc' => 'required',
        ]);
        
        $post->fill($request->post())->save();

        return redirect()->route('posts.index')->with('success','Post Has Been updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success','Post has been deleted successfully');
    }
}
