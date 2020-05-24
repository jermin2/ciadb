<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Tagtype;
use App\Person;
use App\Usertag;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class PersonTagController extends Controller
{

    public function showByTag(Tag $tag)
    {
        $this->authorize('show_people');
        
        //Show a list of the people
        return view('people/index', [
            'people' => Person::all(),
            'selectedTagList'   => new Collection([$tag]),
            'usertags' => Usertag::where('user_id', Auth::user()->id )->get(),
            'tagtypes' => Tagtype::whereIn('id', [1, 2])->get(),
        ]);
    }

    public function showByUserTag(Usertag $usertag)
    {
        $this->authorize('show_people');

        //Show a list of the people
        return view('people/index', [
            'people' => Person::all(),
            'selectedUsertagList'   => new Collection([$usertag]),
            'usertags' => Usertag::where('user_id', Auth::user()->id )->get(),
            'tagtypes' => Tagtype::whereIn('id', [1, 2])->get(),
        ]);
    }
}
