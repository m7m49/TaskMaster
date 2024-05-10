<?php

namespace App\Http\Controllers;

use App\Models\DoneTask;
use App\Models\Task;
class HomeController extends Controller
{
    function index(DoneTask $done) 
    {
        return view('index', [
            'tasks' => Task::latest()->filter(request(['search', 'priority', 'deadline_bf', 'deadline_af']))->get(),
            'done' => $done,
        ]);
    }
}