<?php

namespace App\Http\Controllers;

use App\Person;
use App\Tag;
use App\TagType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view_people');

        $people = Person::all();
        //Show a list of all the people
        return view('people/index', [
            'people' => $people ,
            'tagtypes' => Tagtype::whereIn('id', [1, 2])->get(),
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
        $this->authorize('create_people');

        return view('people/create', [
            'tagtypes' => Tagtype::whereIn('id', [1, 2])->get(),
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
        $this->authorize('create_people');

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
        $this->authorize('view_people');

        return view('people/show', [
            'person' => $person,
            'tagtypes' => Tagtype::whereIn('id', [1, 2])->get(),
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
        $this->authorize('edit_people');

        $data = [
            'person' =>$person,
            'tagtypes' => Tagtype::whereIn('id', [1, 2])->get(),
        ];

        if($person->user_id ==  Auth::id())
        {
            $data = [
                'person' =>$person,
                'tagtypes' => Tagtype::whereIn('id', [1, 2])->get(),
                'user' => Auth::user()
            ];
        }
        

        return view('people/edit', $data);
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
        $this->authorize('edit_people');

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
        $this->authorize('delete_people');
        return "Not yet implemented";
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
