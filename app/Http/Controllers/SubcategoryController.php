<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Category;
use App\Subcategory;

class SubcategoryController extends Controller
{
        public function __construct()
    {
    	$this->middleware('auth');
    }

    public function create()
    {	
    	$data = Category::get();
    	return view('subcategory/create', compact('data'));
    }
    public function store()
    {
    	$this->validate(request(),
    		[
    			'subcategoryname' => 'required',
    			'category_id' => 'required',
    	     ]);
    	Subcategory::create([
    		'category_id' => request('category_id'),
    		'subcategoryname' => request('subcategoryname'),
    		'slug' => Str::slug(request('subcategoryname')),
    	]);
    	return redirect('home');
    }
}
