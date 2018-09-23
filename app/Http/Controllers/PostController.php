<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests;

//Model
use App\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = '';
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('posts.index', ['posts' => $posts, 'query' => $query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in the storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$this->validate($request, [
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:10',
            'image' => 'required|image'
        ]);

        $user = Auth::user();

        /*$post = new Post;
        $post->title = Input::get('title');
        $post->content = Input::get('content');
        $post->user = $user->id;
        if(Input::hasFile('image')){
            $file = Input::file('image');
            $file->move(public_path() . '/upload/', $file->getClientOriginalName());
            $post->image = $file->getClientOriginalName();
        }
        $post->save();*/

        if($file = $request->file('image')) {
            $filename = $file->getClientOriginalName();
            $file->move(public_path() . '/upload/', $filename);
        }
        else{
            session()->flash('message', 'Failed to upload');
            return redirect('posts/create');
        }

        Post::create([
            'title' => $request['title'],
            'content' => $request['content'],
            'image' => $filename,
            'user_id' => $user->id
        ]);

        session()->flash('message', 'Your post has been created successfully');
        return redirect('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $user = Auth::user();
        if($post->user_id != $user->id)
        {
            session()->flash('message', 'You cannot edit post made by other user!');
            return redirect('posts');
        }
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:10',
            'image' => 'required|image'
        ]);

        $post->title = $request->title;
        $post->content = $request->content;
        if($file = $request->file('image')) {
            $filename = $file->getClientOriginalName();
            $file->move(public_path() . '/upload/', $filename);
            $post->image = $filename;
        }
        $post->save();
        session()->flash('message', 'Your post has been updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('posts');
    }

    /**
     * Search the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        $posts = Post::where('title', 'LIKE', '%' . $query . '%')->orderBy('id', 'desc')->paginate(10);

        return view('posts.index', compact('posts', 'query'));
    }
}
