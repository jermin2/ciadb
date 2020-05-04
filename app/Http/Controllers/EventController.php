<?php

namespace App\Http\Controllers;

use App\Event;
use App\Tagtype;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //Show a list of all the people
        return view('events/index', [
            'events' => Event::all(),
            'tagtypes' => Tagtype::all()
        ]
        
        );
    }
}
