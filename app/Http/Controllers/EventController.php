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
            'tags' => Tag::all()
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
