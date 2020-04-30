<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Task;
use App\User;
class TaskController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function show(Task $task)
    {
    	$tasks = Task::where('user_id',Auth::user()->id)->orderBy('created_at', 'DESC')->get();
    	$users = User::orderBy('created_at','DESC')->get();
		return view('create', compact('tasks','users'));    
    }

    public function store()
    {
    	$this->validate(request(), [
    		'name' => 'required',
    		'task' => 'required',
    	]);

    	Task::create([
    		'user_id' => Auth::user()->id,
    		'name' => request('name'),
    		'task' => request('task')
    	]);
    }

    public function vue_task()
    {
    	$data = Task::where('user_id',Auth::user()->id)->orderBy('created_at', 'DESC')->get();
    	return response()->json($data);
    }

    public function destroy(Task $task)
    {
    	$task = Task::where('id', '=', $task->id)->first();
    	$task->delete();
    }
    public function update(Task $task)
    {
    	$data = Task::where('id', '=', $task->id)->first();
    	$data->name = request('name');
    	$data->task = request('task');
    	$data->save();
    }
}
