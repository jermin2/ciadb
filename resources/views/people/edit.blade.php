@extends ('layouts/main')

@section ('content')

  @component('components.person', ['tagtypes' => $tagtypes, 'usertags' => $usertags])

    @section('header')
      <form method="POST" action="{{ route('people.update', $person->id) }}" class="needs-validation col-md-12" novalidate>
      @method('PUT')
      @csrf 
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
    <input type="email" class="form-control" id="number" placeholder="022123456" value="{{$person->number}}">
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
    

    @section('footer')
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
@endsection


