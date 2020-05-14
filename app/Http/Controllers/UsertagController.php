<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Usertag;

class UsertagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    public function destroy(usertags $usertags)
    {
        //
    }

    protected function validateUsertag()
    {
        return request()->validate([
            'name'  => 'required',
            'color' => 'nullable'
        ]);
    }
}
