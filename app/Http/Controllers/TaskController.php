<?php

namespace App\Http\Controllers;

use App\Models\DoneTask;
use App\Models\Event;
use App\Models\Task;
use Carbon\Carbon;

class TaskController extends Controller
{
    function create() 
    {
        return view('Tasks.create');
    }

    function oldTasks()
    {
        return view('Tasks.oldTasks', [
            'doneTask' => DoneTask::latest()->filter(request(['search', 'status', 'priority', 'deadline_bf', 'deadline_af']))->get(),
        ]);
    }
    
    function edit(Task $task)
    {
        return view('Tasks.edit', ['task' => $task]);
    }
    
    function update(Task $task)
    {
        $attributes = request()->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'priority' => 'required',
            'deadline' => 'required|date|after:' . Carbon::now()->format('Y-m-d\TH:i'),
        ]);
        $task->update([
            'title' => $attributes['title'],
            'description' => $attributes['description'],
            'priority' => $attributes['priority'],
            'deadline' => $attributes['deadline']
        ]);
        $event = Event::find($task->id);
        $event->update([
            'title' => $attributes['title'],
            'priority' => $attributes['priority'],
            'start' => $attributes['deadline'],
            'end' => $attributes['deadline'],
        ]);
        
        return redirect('/')->with('success', 'Task has been updated successfully.');
    }

    function store() 
    {
        $currentTime = Carbon::now(auth()->user()->timezone)->toDateTimeString();
        $attributes = request()->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'priority' => 'required',
            'deadline' => 'required|date|after:' . $currentTime,
        ]);

        $attributes['user_id'] = auth()->user()->id;
        Task::create($attributes);
        $color = null;
        if($attributes['priority'] == 'Critical') $color = '#7f1d1d';
        else if($attributes['priority'] == 'High Priority') $color = '#6d28d9';
        else if($attributes['priority'] == 'Neutral') $color = '#059669';
        else if($attributes['priority'] == 'Low Priority') $color = '#d97706';
        else $color = '#6b7280';
        Event::create([
            'id' => Task::latest()->first()->id,
            'title' => $attributes['title'],
            'priority' => $attributes['priority'],
            'color' => $color,
            'start' => $attributes['deadline'],
            'end' => $attributes['deadline']
        ]);
        
        return redirect('/')->with('success', 'Task has been Added successfully.');
    }
    
    function check(Task $task)
    {
        $currentTime = Carbon::now(auth()->user()->timezone)->toDateTimeString();
        DoneTask::create([
            'user_id' => $task->user_id,
            'title' => $task->title,
            'description' => $task->description,
            'priority' => $task->priority,
            'deadline' => $task->deadline,
            'done_at' => $currentTime,
            'status' => ($currentTime <= $task->deadline) ? 'On Time' : 'Overdue',
        ]);
        
        $task->delete();
        Event::destroy($task->id);
        
        return redirect('/');
    }

    function destroy(Task $task) 
    {
        $task->delete();
        Event::destroy($task->id);
        return back()->with('success', 'Task has been deleted successfully.');
    }
}