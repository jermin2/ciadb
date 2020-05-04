<?php

namespace App\Http\Controllers;

use App\Person;
use App\Tag;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = Person::all();
        //Show a list of all the people
        return view('people/index', [
            'people' => $people ,
            'tags'  => Tag::all()
        ]
        
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('people/create', [
            'tags' => Tag::all()
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
        $person = new Person($this->validatePerson());
        $person->save();

        $person->tags()->attach(request('tags'));

        return redirect(route('people.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        return view('people/show', [
            'person' => $person,
            'tags' => Tag::all()
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        return view('people/edit', [
            'person' => $person,
            'tags' => Tag::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        $person->update($this->validatePerson());
        $person->tags()->sync(request('tags'));

        return redirect(route('people.show', $person->id));        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        //
    }

    protected function validatePerson()
    {
        return request()->validate([
            'first_name' => 'required',
            'last_name' => 'nullable',
            'email'     => 'nullable|email',
            'number'    => 'nullable',
            'tags'      => 'exists:tags,id'
        ]);
    }
}
