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
            'tagtypes' => Tagtype::all()->latest()
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

    /**
     * Based on request, will add a person or remove a person from an event
     *
     * @return void
     */
    public function ajaxRequestPost(Request $request)
    {
        $msg = $request->all();

        if($request->state == "true"){
            //add
            Event::find($request->event_id)->people()->attach($request->person_id);
            $msg = "Attached user id:".$request->person_id." to event_id:".$request->event_id;
        }
        else{
            //add
            Event::find($request->event_id)->people()->detach($request->person_id);
            $msg = "Removed user id:".$request->person_id." to event_id:".$request->event_id;
        }
   
        return response()->json(['success'=>$msg, 'message'=>$msg]);
    }
}
