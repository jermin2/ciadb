<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use App\Tagtype;
use App\Event;
use App\Usertag;


class EventPersonController extends Controller
{
    public function show(Person $person)
    {
        $this->authorize('show_events');
        ddd("TO BE FIXED");
        $events = $person->events;

        //Show a list of the people
        return view('events/index', [
            'events' => $events,
            'person' => $person,
            'tagtypes' => Tagtype::all()
        ]);
    }

    public function index()
    {
        $this->authorize('show_events');

        //Show a list of the people
        return view('pivot/index', [
            'events' => Event::all(),
            'people' => Person::all(),
            'tagtypes' => Tagtype::all(),
            'usertags' => Usertag::all()
        ]);
    }
}
