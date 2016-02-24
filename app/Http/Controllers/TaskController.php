<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Task;
Use App\Repositories\TaskRepository;


class TaskController extends Controller
{

	protected $tasks;



    public function __construct(TaskRepository $tasks)
    {
    	$this->middleware('auth');

    	$this->tasks = $tasks;
    }

    public function index(Request $request)
    {
    	$tasks = $this->tasks->userTasks($request->user());

    	return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    			'name' => 'required|max:255',
    		]);

    	$request->user()->tasks()->create($request->all());

    	return redirect('/tasks');
    }

    public function destroy(Request $request, Task $task)
    {
    	$this->authorize('destroy', $task);

    	$task->delete();

    	return redirect('/tasks');
    }
}
