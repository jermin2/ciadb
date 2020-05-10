<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use App\Tagtype;


class EventPersonController extends Controller
{
    public function show(Person $person)
    {
        $this->authorize('show_events');
        
        $events = $person->events;

        //Show a list of the people
        return view('events/index', [
            'events' => $events,
            'person' => $person,
            'tagtypes' => Tagtype::all()
        ]);
    }
}
