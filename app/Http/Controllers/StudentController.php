<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Auth;

class StudentController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }
    public function add_student()
    {
    	$students = Student::orderBy('created_at', 'DESC')->get();
    	return view('student',compact('students'));
    }
    public function store()
    {
    	$this->validate(request(),
    		[
    			'name' => 'required',
    			'number' => 'required',
    		]);

    	Student::create([
    		'user_id' => Auth::user()->id,
    		'name' => request('name'),
    		'number' => request('number'),
    	]);
    }
    public function get_student()
    {
    	$data = Student::orderBy('created_at', 'DESC')->get();
    	return response()->json($data);
    }
    public function destroy(Student $student)
    {
    	$data = Student::where('id', '=', $student->id)->first();
    	$data->delete();
    }
    public function update(Student $student)
    {
    	$data = Student::where('id', '=', $student->id)->first();
    	$data->name = request('name');
    	$data->number = request('number');
    	$data->save();
    }
}
