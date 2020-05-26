<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Tagtype;
use App\Usertag;
use App\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class EventTagController extends Controller
{
    public function showByTag(Tag $tag)
    {
        $this->authorize('show_events');

        //Show a list of the people
        return view('events/index', [
            'events' => Event::orderBy('time')->get(),
            'selectedTagList'   => new Collection([$tag]),
            'usertags' => Usertag::where('user_id', Auth::user()->id )->get(),
            'tagtypes' => Tagtype::all()
        ]);
    }

    public function showByUserTag(Usertag $usertag)
    {
        $this->authorize('show_events');
        
        //Show a list of the people
        return view('events/index', [
            'events' => Event::orderBy('time')->get(),
            'selectedUsertagList'   => new Collection([$usertag]),
            'usertags' => Usertag::where('user_id', Auth::user()->id )->get(),
            'tagtypes' => Tagtype::all()
        ]);
    }
}
