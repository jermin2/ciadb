  <div class="card">
    <div class="card-header">
      <div class="card-title text-center">
        <h2>Goals / Prayers </h2>
      </div>
    </div>
    <div class="card-body">
      <form method="POST" action="goals">
      @csrf
        <table>
          <thead>
            <tr>
              <th>Goal/prayer</th>
              <th>Start date</th>
              <th>End Date</th>
              <th>Private</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input class="form-control" type="text" name="goal" placeholder="Goal"></td>
              <td>@component('components.timepicker', ['pickername'=>'start_date'])
                          @endcomponent
              </td>
              <td>@component('components.timepicker', ['pickername'=>'end_date'])
                          @endcomponent</td>
              <td>
              <div class="input-group-text">
              <input class="" type="checkbox" name="private">
              </div></td>
              <td><button class="btn btn-success" type="submit">Add</button>
            </tr>
            @foreach($goals as $goal)
              @if(!$goal->private || $goal->author_id == Auth::user()->id)
              <tr>
                <td>{{$goal->goal}}</td>
                <td>{{$goal->start_date}}</td>
                <td>{{$goal->end_date}}</td>
                <td>
                <div class="input-group-text">
                  <input type="checkbox" @if($goal->private) checked @endif>
                </div>
                </td>
                <td>
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{route('goals.edit', [ 'goal' => $goal, 'person'=> $person ]) }}">Edit </a>
                      <a class="dropdown-item" href="{{route('goals.delete', [ 'goal' => $goal, 'person'=> $person ]) }}" >Delete </a>
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
