<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $tasks = Task::where('user_id', '=', auth()->id())->get();
        return view('tasks.index')
            ->with(compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->user_id = auth()->id();
        $task->save();

        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    //TODO: can use route model binding...   in all functions...   and avoid explicitly finding task and error checking...
    public function show($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return redirect('/tasks')->withErrors(['msg' => 'Task not found']);
        }
        //TODO: canAccess should be in Task model not controller...
        if (!$this->canAccess($task)) {
            return redirect('/tasks')->withErrors(['msg' => 'You are not authorized to access this task']);
        }
        return view('tasks.show')->with(compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return redirect('/tasks')->withErrors(['msg' => 'Task not found']);
        }
        if (!$this->canAccess($task)) {
            return redirect('/tasks')->withErrors(['msg' => 'You are not authorized to access this task']);
        }
        return view('tasks.edit')->with(compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        // Find the task to update
        $task = Task::find($id);

        if (!$task) {
            return redirect('/tasks')->withErrors(['msg' => 'Task not found']);
        }
        if (!$this->canAccess($task)) {
            return redirect('/tasks')->withErrors(['msg' => 'You are not authorized to access this task']);
        }

        // Update the task with the validated data
        $task->update($validatedData);

        // Redirect to the task show page
        return redirect('/tasks/show/' . $task->id);
    }

    public function complete(Request $request)
    {
        // Find the task to update
        $task = Task::find($request->input('task_id'));

        if (!$task) {
            return redirect('/tasks')->withErrors(['msg' => 'Task not found']);
        }
        if (!$this->canAccess($task)) {
            return redirect('/tasks')->withErrors(['msg' => 'You are not authorized to access this task']);
        }

        // Update the task with the validated data
        $task->completed = true;
        $task->save();

        // Redirect to the task show page
        return redirect('/tasks/show/' . $task->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request)
    {
        $task = Task::find($request->input('task_id'));

        if (!$task) {
            return redirect('/tasks')->withErrors(['msg' => 'Task not found']);
        }
        //TODO: canAccess move to Task model...
        if (!$this->canAccess($task)) {
            return redirect('/tasks')->withErrors(['msg' => 'You are not authorized to access this task']);
        }

        $task->delete();
        return redirect('/tasks')->withErrors(['msg' => $task->title . ' Deleted Successfully']);
    }

    public function canAccess($task): bool
    {
        return auth()->user()->id == $task->user_id;
    }
}
