<?php

namespace App\Http\Controllers;

use App\User;
use App\Person;
use App\Tagtype;
use App\Role;

use App\Event;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        //Requires Login to access anything
        $this->middleware('auth');
    }

    public function home()
    {
        $user = auth()->user();

        return view('users/home', [
            'events' => Event::where('author_id', $user->id)->latest('time')->take(5)->get()
        ]);



    }
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('show_users', $user);
        
        return view('user/show', [
            'user' => $user,
            'tagtypes' => Tagtype::all()
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $this->authorize('show_users', $user);
        
        return view('users/index', [
            'users' => User::all(),
            'tagtypes' => Tagtype::all()
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('edit_users', $user);

        return view('users/edit', [
            'user' => $user,
            'people' => Person::all(),
            'tagtypes' => Tagtype::all(),
            'roles'     => Role::all(),
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('edit_users', $user);

        $validation = request()->validate([
            'email' => 'email|required',
            'person' => 'unique:users,person_id|required|exists:people,id'
            
        ]);
        $user->roles()->sync(request('roles'));

        $user->person()->associate( Person::find(request('person')) );
        

        $validation['name'] = $user->person->name();
        $user->update( $validation);
        $user->person->update( [
            'email' => request('email')
        ]);


        return redirect(route('users.index'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function delete(User $user)
    {
        $this->authorize('delete_users', $user);

        $user->delete();

        return redirect(route('users.index'));
    }
}
