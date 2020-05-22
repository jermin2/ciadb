@extends ('layouts/main')

@section ('content')

<div class="row">
  <div class=" col-lg-6 col-md-12 col-sm-12 mx-auto">
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

      @section('number')
      <input type="email" class="form-control" id="number"  value="{{$person->number}}" readonly>
      @endsection

      @section('year')
      <input type="email" class="form-control" id="number"  value="Year {{$person->year}}" readonly>
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
        <a href="{{route('people.index')}}" class="col-md-6 btn btn-primary btn-lg btn-round">Close</a>
      @endsection

    @endcomponent
  </div>

  <div class="col-lg-6 col-md-12  col-sm-12 mx-auto">
    @component('components.goals', ['goals'=>$person->goals, 'person'=>$person])
    @endcomponent
  </div>
</div>
@endsection


