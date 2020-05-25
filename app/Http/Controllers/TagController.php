<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    public function __construct()
    {
        //Requires Login to access anything
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('edit_systemtags');

        $validate = $this->validateTag();

        $usertag = new Tag([
            'name' => $request->name,
            'tagtype_id' => $request->tagtype_id,
            'color' => $request->color
        ]);

        $usertag->save();

        return redirect(route('usertags.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\usertags  $usertags
     * @return \Illuminate\Http\Response
     */
    public function delete(Tag $tag)
    {
        $this->authorize('edit_systemtags');

        $tag->delete();

        return redirect(route('usertags.index'));
    }

    protected function validateTag()
    {
        return request()->validate([
            'name'  => 'required',
            'color' => 'nullable',
            'tagtype_id' => 'exists:tagtypes,id'
        ]);
    }
}
