<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Tagtype;
use Illuminate\Http\Request;

class PersonTagController extends Controller
{
        /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('people/index', [
            'people' => $tag->people,
            'tag'   => $tag,
            'tagtypes' => Tagtype::all(),
        ]);
        
    }
}
