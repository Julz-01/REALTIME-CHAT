<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Userprofile;
use Auth;
Use App\User;
use Image;
use File;

class UserprofileController extends Controller
{
     public function __construct()
    {
    	$this->middleware('auth');
    }

    public function profile()
    {
    	return view('profile');
    }

    public function userprofile()
    {
    	return view('image');
    }

    public function store()
    {
    	$this->validate(request(), 
    		[
    			'image' => 'required|image|mimes:jpeg,png,png,jpg,gif',
    		]);

    	if(Auth::user()->userprofile){
    		$oldimage = Userprofile::where('user_id', Auth::user()->id)->firstOrFail();
    		File::delete([
    			public_path($oldimage->image),
    			public_path($oldimage->thumbnail),
    		]);
    		$oldimage->delete();
    	}

    	$image = request('image');
    	$imagename = $image->getClientOriginalName();
    	$imagename = time().'_'.$imagename;
		$thumbnail = $image->getClientOriginalName(); 
		$thumbnail = time().'_thumbnail'.$thumbnail;
		Image::make($image)->fit(100, 100)->save(public_path('/images/').$thumbnail);
    	$image->move(public_path('/images'), $imagename);

    	Userprofile::create([
    	'user_id' => Auth::user()->id,
    	'image' => 'images/'.$imagename,
    	'thumbnail' => 'images/'.$thumbnail,
    	]);
    }

    public function name()
    {
        $users = User::where('id', Auth::user()->id)->first();
        return view('name', compact('users'));
    }

    public function update_user(User $user)
    {
        $data = User::where('id', '=', Auth::user()->id)->first();
        $data->name = request('name');
        $data->email = request('email');
        $data->save();
    }
    public function list()
    {
        $users = User::orderBy('created_at', 'DESC')->get();
        return view('users', compact('users'));
    }

    public function delete(User $user)
    {
        $data = User::where('id','=', $user->id)->first();
        $data->delete();
    }
    public function  vue_user()
    {
        $data = User::orderBy('created_at', 'DESC')->get();
        return $data;
    }
}
