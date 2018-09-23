<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

//Model
use App\User;

class UserController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

	/**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
    	$user = Auth::user();
        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    	$this->validate($request, [
            'name' => 'required|min:3|max:255',
            'email' => 'required|min:5|max:255|email'
        ]);

    	$user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        /*if($file = $request->file('image')) {
            $filename = $file->getClientOriginalName();
            $file->move(public_path() . '/upload/', $filename);
            $user->image = $filename;
        }*/
        $user->save();
        session()->flash('message', 'Your profile has been updated successfully');
        return redirect()->back();
    }
}
