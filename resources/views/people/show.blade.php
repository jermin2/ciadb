@extends ('layouts/main')

@section ('content')

  <div class="card col-lg-7 col-md-9 col-sm-12 mx-auto">
    <div class="card-header">
        <div class="card-title text-center"><h2>Viewing: {{$person->name()}}</h2> </div>
    </div>
    <div class="card-body">
      <div class="d-flex justify-content-center col-md-12 col-lg-12 mx-auto">
        <form method="POST" action="{{ route('people.store') }}" class="needs-validation col-md-12" novalidate>
          @csrf 
        
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="label" for="first_name"> First Name</label>

              <input class="form-control" type="text" name="first_name" id="first_name" value="{{ $person->first_name }}" readonly>
              <div class="invalid-feedback">Valid first name is required. </div>
            </div>

            <div class="col-md-6 mb-3">
              <label class="label" for="last_name"> Last Name</label>

              <input class="form-control" type="text" name="last_name" id="last_name" value="{{$person->last_name}}" readonly> 
            </div>
          </div>

          <div class="mb-3">
            <label for="email">Email <span class="text-muted">(Optional)</span></label>
            <input type="email" class="form-control" id="email" placeholder="you@example.com" value="{{$person->email}}" readonly>
            <div class="invalid-feedback">
              Please enter a valid email address.
            </div>
          </div>

          <div class="mb-3">
            <label for="number">Phone Number <span class="text-muted">(Optional)</span></label>
            <input type="email" class="form-control" id="number" placeholder="022123456" value="{{$person->number}}" readonly>
            <div class="invalid-feedback">
              Please enter a valid phone number.
            </div>
          </div>

          <!-- Tags -->
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="tags">Tags <span class="text-muted">(Optional)</span></label>
                @component('components.tagpicker', ['tagtypes' => $tagtypes, 'selectedTagList' => $person->tags])

                @endcomponent
            </div>
            <div class="col-md-6 mb-3">
              <label for="tags">Tags <span class="text-muted">(Optional)</span></label>
                @component('components.tagpicker', ['tags' => $usertags, 'selectedTagList' => $person->usertags])

                @endcomponent
            </div>
          </div>
          <hr class="mb-4">

          <a href="{{ route('people.index') }}" class="col-md-6 btn btn-primary btn-lg btn-round" >Back</a>

        </form>
      </div>
    </div>
  </div>


@endsection