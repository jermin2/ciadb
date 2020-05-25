<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Usertag;
use App\Tag;
use App\Tagtype;


use App\Role;

class UsertagController extends Controller
{
    public function __construct()
    {
        //Requires Login to access anything
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('edit_usertags');
        if(Auth::user()->hasPermission('edit_systemtags'))
        {
            return view('tags/index', [
                'user' => Auth::user(),
                'usertags' => Usertag::where('user_id', Auth::user()->id)->get(),
                'tags' => Tag::all(),
                'tagtypes' => Tagtype::all()
            ]);
        }
        else
        return view('tags/index', [
            'user' => Auth::user(),
            'usertags' => Usertag::where('user_id', Auth::user()->id)->get(),
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validateUsertag();

        $usertag = new Usertag([
            'name' => $request->name,
            'user_id' => Auth::user()->id,
            'color' => $request->color
        ]);

        $usertag->save();

        return redirect(route('usertags.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\usertags  $usertags
     * @return \Illuminate\Http\Response
     */
    public function show(usertags $usertags)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\usertags  $usertags
     * @return \Illuminate\Http\Response
     */
    public function edit(usertags $usertags)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\usertags  $usertags
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, usertags $usertags)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\usertags  $usertags
     * @return \Illuminate\Http\Response
     */
    public function delete(Usertag $usertag)
    {
        $usertag->delete();

        return redirect(route('usertags.index'));
    }

    protected function validateUsertag()
    {
        return request()->validate([
            'name'  => 'required',
            'color' => 'nullable'
        ]);
    }
}
