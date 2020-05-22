@extends ('layouts/main')

@section ('content')

  @component('components.person', ['tagtypes' => $tagtypes, 'usertags' => $usertags])

    @section('content-header')
      <form method="POST" action="{{ route('people.update', $person->id) }}" class="needs-validation col-md-12" novalidate>
      @method('PUT')
      @csrf 
    @endsection

    @section('content-title')
      <h2>Edit: {{$person->name()}}</h2>
    @endsection

    @section('first_name')
    <input class="form-control" type="text" name="first_name" id="first_name" value="{{$person->first_name}}">
    @endsection

    @section('last_name')
    <input class="form-control" type="text" name="last_name" id="last_name" value="{{$person->last_name}}">
    @endsection

    @section('email')
    <input type="email" class="form-control" id="email" placeholder="you@example.com" value="{{$person->email}}">
    @endsection

    @section('number')
    <input type="text" class="form-control" id="number" placeholder="022123456" value="{{$person->number}}">
    @endsection

    @section('tags')
      @component('components.tagpicker', ['tagtypes' => $tagtypes, 'selectedTagList' => $person->tags])   
      @endcomponent
    @endsection

    @section('usertags')
      @component('components.tagpicker', ['tags' => $usertags, 'tagname' => "usertags[]", 'selectedTagList' => $person->usertags ])
      @endcomponent
    @endsection

    @section('notes')
      <textarea class="form-control w-100" type="text" name="notes" id="notes" rows=5 placeholder="Notes">{{$person->notes}}</textarea>
    @endsection
    

    @section('content-footer')
      @can('show_users')
        @isset($person->user)
        <div class="mb-3">
          <label> Associated with a user </label>
          <a href="{{ route('users.edit', $person->user->id) }}"> Edit Login details </a>
        </div>
        @endisset
      @endcan
    @endsection

    @section('buttons')
      <button class="col-md-6 btn btn-primary btn-lg btn-round" type="submit">Save</button>
    @endsection

  @endcomponent

  @component('components.goals')
    @section('goals')
      @foreach($person->goals as $goal)
        @if(!$goal->private || $goal->author_id == Auth::user()->id)
        <tr>
          <td>{{$goal->goal}}</td>
          <td>{{$goal->start_date}}</td>
          <td>{{$goal->end_date}}</td>
          <td><input type="checkbox" @if($goal->private) checked @endif></td>
          <td>
              <a href="{{route('goals.edit', [ 'goal' => $goal, 'person'=> $person ]) }}" class="btn btn-info">E </a>
              <a href="{{route('goals.delete', [ 'goal' => $goal, 'person'=> $person ]) }}" class="btn btn-danger">D </a>
          </td>
        </tr>
        @endif
      @endforeach
    @endsection
  @endcomponent
@endsection

@section('footer')

<script src="{{ asset('js/peoplepicker.js') }}?5"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.25.3/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />

<script type="text/javascript">
$(document).ready( function() {

    $('.date').datetimepicker({
    format: "DD-MM-YYYY",
    debug: true,
    } );
});

</script>



@endsection
