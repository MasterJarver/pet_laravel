<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Session;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('id', 'desc')->paginate(5);
        return view('tasks.index')->with('storedTasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'newTaskName' => 'required|min:5|max:191'
        ]);
        $task = new Task;
        $task->name = $request->newTaskName;
        $task->save();
        Session::flash('success', 'New task has been succesfully added!');
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::all()->find($id);
        return view('tasks.edit')->with('taskUnderEdit', $task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'updatedTaskName' => 'required|min:5|max:191'
        ]);
        $task = Task::all()->find($id);
        $task->name = $request->updatedTaskName;
        $task->save();
        Session::flash('success', 'task #' . $id . ' has been successfuly updated.');
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::all()->find($id);
        $task->delete();
        Session::flash('success', 'task #' . $id . ' has been succesfuly deleted.');
        return redirect()->route('tasks.index');
    }
}
