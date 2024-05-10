<?php

namespace App\Http\Controllers;

use App\Models\Event;

class CalendarController extends Controller
{
    public function index() 
    {
        $events = array();
        foreach(Event::all() as $event)
        {
            if($event->priority == 'Critical') $event->color = '#7f1d1d';
            else if($event->priority == 'High Priority') $event->color = '#6d28d9';
            else if($event->priority == 'Neutral') $event->color = '#059669';
            else if($event->priority == 'Low Priority') $event->color = '#d97706';
            else $event->color = '#6b7280';

            $events[] = [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start,
                'end' => $event->end,
                'color' => $event->color
            ];
        }
        return view('calendar', ['events' => $events]);
    }
}