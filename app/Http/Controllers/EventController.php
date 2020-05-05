<?php

namespace App\Http\Controllers;

use App\Event;
use App\Tagtype;
use App\Tag;
use App\Person;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('events/create', [
            'tags' => Tag::all(),
            'tagtypes' => Tagtype::all(),
            'people' => Person::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new Event($this->validateEvent());
        $event->save();

        $event->tags()->attach(request('tags'));

        return redirect(route('events.index'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('tag')){
            $events = Tag::where('name', request('tag'))->firstOrFail()->events;
        } elseif(request('person'))
        {
            $events = Person::where('id', request('person'))->firstOrFail()->events;
        
        } else {
            $events = Event::all();
        }

        //Show a list of all the people
        return view('events/index', [
            'events' => $events,
            'tagtypes' => Tagtype::all()
        ]
        
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events/show', [
            'event' => $event,
            'tags' => Tag::all()
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events/edit', [
            'event' => $event,
            'tags' => Tag::all(),
            'people' => Person::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        dd($request);
        $event->update($this->validateEvent());
        $event->tags()->sync(request('tags'));

        return redirect(route('events.show', $event->id));        
    }



    protected function validateEvent()
    {
        return request()->validate([
            'name' => 'required',
            'location' => 'nullable',
            'time'     => 'nullable',
            'notes'    => 'nullable',
            'tags'      => 'exists:tags,id'
        ]);
    }
}
