<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function create()
    {
    	return view('category/create');
    }

    public function store(Category $category)
    {
    		$this->validate(request(),
    			[
    				'categoryname' => 'required',
    			]);
    		Category::create([
    			'categoryname' => request('categoryname'),
    			'slug'=> Str::slug(request('categoryname')),
    		]);
            return back();
    }
    public function show()
    {
        $categories = Category::get();
        return view('category/show', compact('categories'));
    }
}
