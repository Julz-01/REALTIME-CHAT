<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;
use App\Category;
Use App\Subcategory;
use App\Domain;

class DomainController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function create()
    {
    	$categories = Category::get();
    	$subcategories = Subcategory::get();
    	return view('domain/create', compact('categories','subcategories'));
    }
    public function store(Domain $domain)
    {
    	$this->validate(request(),
    		[
    		'email' => 'required|email',
    		'title' => 'required',
    		'url' => 'required',
    		]);

 if(request('img')){
        $image = request('img');
        $extension = $image->getClientOriginalExtension();
            $name = time().'_'. $image->getClientOriginalName();
            Storage::disk('public')->put($name, File::get($image));
            }else{
            $domain->img = 'default';
            }

        Domain::create([
            'title' => request('title'),
            'email' => request('email'),
            'url' => request('url'),
            'shortdescription' => request('shortdesc'),
            'description' => request('desc'),
            'category_id' => request('category_id'),
            'subcategory_id' => request('subcategory_id'),
            'img' => $name,
        ]);
    }
}
