@extends ('layouts/main')

@section ('content')

  @component('components.person', ['tagtypes' => $tagtypes, 'usertags' => $usertags])

    @section('content-header')
      <form method="POST" action="{{ route('people.store') }}" class="needs-validation col-md-12" novalidate>
      @csrf 
    @endsection

    @section('first_name')
    <input class="form-control" type="text" name="first_name" id="first_name" >
    @error('first_name')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @endsection

    @section('last_name')
    <input class="form-control" type="text" name="last_name" id="last_name"  >
    @endsection

    @section('email')
    <input type="email" class="form-control" id="email" placeholder="you@example.com"  >
    @endsection

    @section('number')
    <input type="email" class="form-control" id="number" placeholder="022123456"  >
    @endsection

    @section('tags')
      @component('components.tagpicker', ['tagtypes' => $tagtypes, ])   
      @endcomponent
    @endsection

    @section('usertags')
      @component('components.tagpicker', ['tags' => $usertags, 'tagname' => "usertags[]" ])
      @endcomponent
    @endsection

    @section('notes')
      <textarea class="form-control w-100" type="text" name="notes" id="notes" rows=5 placeholder="Notes"></textarea>
    @endsection

    @section('buttons')
      <button class="col-md-6 btn btn-primary btn-lg btn-round" type="submit">Save</button>
    @endsection

  @endcomponent
@endsection


