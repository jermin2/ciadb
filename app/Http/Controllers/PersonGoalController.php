<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use App\Goal;
use Illuminate\Support\Facades\Auth;

class PersonGoalController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $param = $this->validateGoal();

        $param['start_date']  = \Carbon\Carbon::createFromFormat('d-m-Y', $request->start_date);

        $param['author_id'] = Auth::user()->id;
        $param['private'] = request()->private == "on" ? true : false;
        $goal = new Goal($param);
        $goal->save();

        return redirect(route('people.edit', $request->person_id));
    }

    public function validateGoal()
    {
        return request()->validate([
            'person_id' => 'required',
            'goal' => 'required',
            'start_date' => 'date_format:"d-m-Y"',
            'end_date' => 'nullable|date_format:"d-m-Y"',
        ]);
    }

    public function delete(Person $person, Goal $goal)
    {
        //$this->authorize('delete_goals', $goal);
        $goal->delete();

        return redirect(route('people.edit', $person->id));
    }

    public function update(Request $request, Person $person, Goal $goal)
    {
        $param = request()->validate([
            'goal' => 'required',
            'start_date' => 'date_format:"d-m-Y"',
            'end_date' => 'nullable|date_format:"d-m-Y"',
        ]);

        $param['private'] = request()->private == "on" ? true : false;
        $param['start_date']  = \Carbon\Carbon::createFromFormat('d-m-Y', $request->start_date);

        if($request->end_date != null)
        {
            $param['end_date']  = \Carbon\Carbon::createFromFormat('d-m-Y', $request->end_date);
        }
            

        $goal->update(
            $param
        );


        return redirect(route('people.edit', $person->id));
    }

    public function edit(Person $person, Goal $goal)
    {
        return view('goals/edit', [
            'person' => $person,
            'goal' => $goal,
        ]);
    }


}
