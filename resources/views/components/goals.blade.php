  <div class="card">
    <div class="card-header">
      <h2 class="card-title">Goals / Prayers </h2>
    </div>
    <div class="card-body">
      <form method="POST" action="{{route('goals.store')}}">
      @csrf
        <div >
          <table id="goalTable" style="width:100%">
            <thead>
              <tr>
                @isset($individual)
                <th >Person</th>
                <th>Goal/prayer</th>
                <th class="min-tablet-p">Start Date</th>
                <th class="min-tablet-p">End Date</th>
                <th class="min-tablet-l" >Notes</th>
                <th class="min-tablet-l">Private</th>
                <th>Action</th>
                @else
                <th>Goal/prayer</th>
                <th class="min-tablet-p">Start Date</th>
                <th class="min-tablet-p">End Date</th>
                <th class="min-tablet-l" >Notes</th>
                <th class="min-tablet-p">Private</th>              
                <th>Action</th>
                @endisset

              </tr>
            </thead>
            <tbody>
            <tr>
                @isset($individual)
                  {{$individual}}
                @endisset
                <td class="notes">
                  @empty($individual)
                    <input type="text" value="{{$person->id}}" name="person_id" hidden>
                  @endempty  
                  <input class="form-control" type="text" name="goal" placeholder="Goal">
                </td>
                <td>@component('components.timepicker', ['pickername'=>'start_date'])
                      @slot('currentTime')
                      {{Carbon\Carbon::now()->format('d-m-Y')}}
                      @endslot
                    @endcomponent
                </td>
                <td>@component('components.timepicker', ['pickername'=>'end_date'])
                    @endcomponent
                </td>

                <td> <input class="form-control" type="text" name="notes" placeholder="Notes"> </td>

                <td>
                  <div class="checkboxdiv input-group-text">
                    <div class="custom-control custom-checkbox ">
                        <input type="checkbox" class="custom-control-input" id="customCheck1" name="private">
                        <label class="custom-control-label" for="customCheck1"></label>
                    </div>
                  </div>
                </td>
                <td><button class="add-goal btn btn-success" type="submit">Add</button></td>
              </tr>
              @foreach($goals as $goal)
                @if(!$goal->private || $goal->author_id == Auth::user()->id)
                <tr>
                  @isset($individual)
                  <td><a  href="{{ route('people.edit', $goal->person->id) }}">{{$goal->person->name()}}</a></td>
                  @endisset
                  <td >{{$goal->goal}}</td>
                  <td >{{$goal->start_date}}</td>
                  <td >{{$goal->end_date}}</td>
                  @empty($individual)
                  <td> {{$goal->notes}} </td>
                  @endempty
                  <td >
                    <div class="checkboxdiv input-group-text">
                      <div class="custom-control custom-checkbox ">
                          <input type="checkbox" class="custom-control-input" @if($goal->private) checked @endif>
                          <label class="custom-control-label" for=""></label>
                      </div>
                    </div>
                  </td>
                  <td>
                      <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('goals.edit', [ 'goal' => $goal, 'person'=> $goal->person ]) }}">Edit </a>
                        <a class="dropdown-item" href="{{route('goals.delete', [ 'goal' => $goal, 'person'=> $goal->person ]) }}" >Delete </a>
                      </div>
                  </td>
                </tr>
                @endif
              @endforeach

            </tbody>
          </table>
        </div>
      </form>
    </div>
  </div>