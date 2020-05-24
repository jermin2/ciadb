<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Tagtype;
use App\Usertag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class EventTagController extends Controller
{
    public function show(Tag $tag)
    {
        $events = $tag->events;
        //Show a list of the people
        return view('events/index', [
            'events' => $events,
            'selectedTagList'   => new Collection([$tag]),
            'usertags' => Usertag::where('user_id', Auth::user()->id )->get(),
            'tagtypes' => Tagtype::all()
        ]);
    }
}
