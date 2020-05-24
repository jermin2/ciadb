@extends ('layouts/main')

@section ('content')

<div class="row">
  <div class="col-xl-6 col-lg-12 col-md-12  col-sm-12 mx-auto">
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
    <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com" value="{{$person->email}}">
    @endsection

    @section('gender')
        <select class="custom-select" name="gender" id="year">
          <option value="" selected>..</option>
          <option value="m" @if($person->gender == "m") selected @endif >M</option> 
          <option value="f" @if($person->gender == "f") selected @endif >F</option> 
        </select>
      @endsection


    @section('number')
    <input type="text" class="form-control" name="number" id="number" placeholder="022123456" value="{{$person->number}}">
    @endsection

    @section('year')
    <select class="custom-select" name="year" id="year">
    <option value="" selected>Choose...</option>
    @for($i=1; $i < 14; $i++)
      <option value="{{$i}}" @if($i==$person->year) selected @endif>Year {{$i}}</option> 
    @endfor
    </select>
    
    @endsection

    @section('tags')
      @component('components.tagpicker', ['tagtypes' => $tagtypes, 'selectedTagList' => $person->tags])   
      @endcomponent
    @endsection

    @section('usertags')
      @component('components.tagpicker', ['tags' => $usertags, 'tagname' => "usertags[]", 'selectedTagList' => $person->usertags ])
      @endcomponent
    @endsection

    @section('parents')
    <input type="text" class="form-control" name="parents" id="parents" placeholder="Mr and Mrs Smith" value="{{$person->parents}}">
    @endsection

    @section('school')
    <input type="text" class="form-control" name="school" id="school" placeholder="Mt Roskill Primary" value="{{$person->school}}">
    @endsection

    @section('baptism')
      @component('components.timepicker', ['pickername'=>'baptism'])
        @slot('currentTime')
          {{$person->baptism}}
        @endslot
      @endcomponent
    @endsection

    @section('dob')
      @component('components.timepicker', ['pickername'=>'dob'])
        @slot('currentTime')
          {{$person->dob}}
        @endslot
      @endcomponent
    @endsection

    @section('notes')
      <textarea class="form-control w-100" type="text" name="notes" id="notes" rows=5 placeholder="Notes">{{$person->notes}}</textarea>
    @endsection
    
    @section('additional-footer')
      <span class="text-muted">Last updated at: {{$person->updated_at}}</span>
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
  </div>

  <div class="col col-xl-6 col-lg-12 col-md-12 col-sm-12 mx-auto">
    @component('components.goals', ['goals'=>$person->goals, 'person'=>$person])
    @endcomponent
  </div>

  <div class="row col-md-12 col-lg-12 mx-auto">
        @component('components.lastevents', ['events' => $person->lastTenEvents() ])
      @slot('title')
        Last Ten Events
      @endslot
    @endcomponent
  </div>

</div>
@endsection

@section('footer')

<script src="{{ asset('js/peoplepicker.js') }}?5"></script>

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
