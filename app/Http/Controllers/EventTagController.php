<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Tagtype;

class EventTagController extends Controller
{
    public function show(Tag $tag)
    {
        $events = $tag->events;

        //Show a list of the people
        return view('events/index', [
            'events' => $events,
            'tag'   => $tag,
            'tagtypes' => Tagtype::all()
        ]);
    }
}
