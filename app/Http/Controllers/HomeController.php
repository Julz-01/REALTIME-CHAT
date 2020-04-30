<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain;
Use App\Category;
use App\Subcategory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $domains = Domain::get();
        $categories = Category::get();
        $subcategories = Subcategory::get();

        return view('home',compact('domains','categories','subcategories'));
    }
}
