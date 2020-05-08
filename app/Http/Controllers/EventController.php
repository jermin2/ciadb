<?php

namespace App\Http\Controllers;

use App\Event;
use App\Tagtype;
use App\Tag;
use App\Person;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events/create', [
            'tagtypes' => Tagtype::all(),
            'people' => Person::all(),
            'user' => Auth::user(),

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
        $validate = $this->validateEvent();
        $formattime = \Carbon\Carbon::createFromFormat('D, jS M H:i Y', $request->time);

        $event = new Event([
            'name' => $request->name,
            'location' =>$request->location,
            'time'     => $formattime->toDateTimeString(),
            'notes'    => $request->notes,
        ]);

        $event->save();

        $event->tags()->attach(request('tags'));
        $event->people()->attach(request('people'));

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
            'tagtypes' => Tagtype::all()
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
            'tagtypes' => Tagtype::all(),
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
        $validate = $this->validateEvent();
        $formattime = \Carbon\Carbon::createFromFormat('D, jS M H:i Y', $request->time);

        
        $event->update([
            'name' => $request->name,
            'location' =>$request->location,
            'time'     => $formattime->toDateTimeString(),
            'notes'    => $request->notes,
        ]);

        $event->tags()->sync(request('tags'));
        $event->people()->sync(request('people'));

        return redirect(route('events.show', $event->id));        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function delete(Event $event)
    {
        $event->delete();

        return redirect(route('events.index'));
    }



    protected function validateEvent()
    {
        return request()->validate([
            'name' => 'required',
            'location' => 'nullable',
            'time'     => 'date_format:"D, jS M H:i Y"',
            'notes'    => 'nullable',
            'tags'      => 'exists:tags,id',
            'people'    => 'exists:people,id'
        ]);
    }
}