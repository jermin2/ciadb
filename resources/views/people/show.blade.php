@extends ('layouts/main')

@section ('content')

<div class="row">
  <div class=" col-xl-6 col-lg-12 col-md-12 col-sm-12 mx-auto">
    @component('components.person', ['tagtypes' => $tagtypes, 'usertags' => $usertags])

      @section('content-title')
      <h2>Viewing: {{$person->name()}}</h2>
      @endsection

      @section('content-header')
        <form class=" col-md-12">
      @endsection

      @section('first_name')
      <input class="form-control" type="text" name="first_name" id="first_name" value="{{$person->first_name}}" readonly>
      @endsection

      @section('last_name')
      <input class="form-control" type="text" name="last_name" id="last_name" value="{{$person->last_name}}" readonly>
      @endsection

      @section('email')
      <input type="email" class="form-control" id="email"  value="{{$person->email}}" readonly>
      @endsection

      @section('gender')
        <input type="email" class="form-control" id="number"  value="{{$person->gender}}" readonly>
      @endsection

      @section('number')
      <input type="email" class="form-control" id="number"  value="{{$person->number}}" readonly>
      @endsection

      @section('year')
      <input type="email" class="form-control" id="number"  value="Year {{$person->year}}" readonly>
      @endsection

      @section('tags')
        <div class="form-control">
          @foreach ($person->tags as $tag)
          <a href="{{route('people-tag.show', $tag->id)}}">
                  <span class="badge" 
                      style="color:#fff; background-color:{{$tag->color}}" >
                  {{$tag->name}}
              </span> </a>
          @endforeach
        </div>
      @endsection

      @section('usertags')
        <div class="form-control">
        @foreach ($person->usertags as $tag)
          <a href="{{route('people-usertag.show', $tag->id)}}">
                  <span class="badge" 
                      style="color:#fff; background-color:{{$tag->color}}" >
                  {{$tag->name}}
              </span> </a>
          @endforeach
        </div>
      @endsection

      @section('parents')
    <input type="text" class="form-control" id="parents"  value="{{$person->parents}}">
    @endsection

    @section('school')
    <input type="text" class="form-control" id="school"  value="{{$person->school}}">
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
        @can('edit_people')
          <a href="{{route('people.edit', $person->id)}}" class="col-md-6 btn btn-danger btn-lg btn-round">Edit</a>
        @endcan
        <a href="{{route('people.index')}}" class="col-md-6 btn btn-primary btn-lg btn-round">Close</a>
      @endsection

    @endcomponent
  </div>

  <div class="col-xl-6 col-lg-12 col-md-12  col-sm-12 mx-auto">
    @component('components.goals', ['goals'=>$person->goals, 'person'=>$person])
    @endcomponent
  </div>

  @can('view_events')
  <div class="row col-md-12 col-lg-12 mx-auto">
        @component('components.lastevents', ['events' => $person->lastTenEvents() ])
      @slot('title')
        Last Ten Events
      @endslot
    @endcomponent
  </div>
  @endcan

</div>
@endsection


@section('footer')

<script type="text/javascript">

$(document).ready( function() {

    $('#goalTable').DataTable( { 
        dom: 'rt',
        autoWidth: true,
        responsive: true,
        columnDefs: [
          
          { responsivePriority: 1, targets: [0,-1]},
          { responsivePriority: 2, targets: 1},
          { responsivePriority: 3, targets: 2},
          { width: "40px", targets: 4},
          { width: "110px", targets: [1,2]},
          { width: "80px", targets: -1},
          
        ]
    });

});

</script>

@endsection