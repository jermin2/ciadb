<?php

namespace App\Http\Controllers;

use App\Event;
use App\Tagtype;
use App\Tag;
use App\Person;
use App\User;
use App\Usertag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
        $this->authorize('create_events');

        return view('events/create', [
            'tagtypes' => Tagtype::all(),
            'people' => Person::all(),
            'user' => Auth::user(),
            'usertags' => Usertag::where('user_id', Auth::user()->id)->get()

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
        $this->authorize('create_events');

        $validate = $this->validateEvent();

        $formattime = \Carbon\Carbon::createFromFormat('D, jS M H:i Y', $request->time);

        $event = new Event([
            'name' => $request->name,
            'location' =>$request->location,
            'time'     => $formattime->toDateTimeString(),
            'notes'    => $request->notes,
            'author_id' => $request->author_id,
            'private'   => $request->private == "on" ? '1' : '0' ,
        ]);

        $event->save();

        $event->usertags()->attach(request('usertags'));
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
        $this->authorize('show_events');
        
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
            'tagtypes' => Tagtype::all(),
            'usertags' => Usertag::where('user_id', Auth::user()->id)->get()
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
        $this->authorize('show_events', $event);

        return view('events/show', [
            'event' => $event,
            'tagtypes' => Tagtype::all(),
            'usertags' => Usertag::where('user_id', Auth::user()->id)->get()
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
        $response = Gate::inspect('edit_events', $event);
        if(!$response->allowed()){
            //If not allowed, then just show
            return redirect(route('events.show', $event));   
        }

        return view('events/edit', [
            'event' => $event,
            'tagtypes' => Tagtype::all(),
            'people' => Person::all(),
            'usertags' => Usertag::where('user_id', Auth::user()->id )->get()
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
        $this->authorize('edit_events', $event);

        $validate = $this->validateEvent();
        $formattime = \Carbon\Carbon::createFromFormat('D, jS M H:i Y', $request->time);

        
        $event->update([
            'name' => $request->name,
            'location' =>$request->location,
            'time'     => $formattime->toDateTimeString(),
            'notes'    => $request->notes,
            'private'   => $request->private == "on" ? '1' : '0' ,
            
        ]);
        $event->usertags()->sync(request('usertags'));
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
        $this->authorize('delete_events', $event);

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
            'people'    => 'exists:people,id',
            'author_id' => 'exists:users,id'
        ]);
    }
}