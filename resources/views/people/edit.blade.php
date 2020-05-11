@extends ('layouts/main')

@section ('content')
<div class="card col-lg-7 col-md-9 col-sm-12 mx-auto">
  <div class="card-header">
    <div class="card-title text-center"><h2>Edit: {{$person->name()}}</h2> </div>
  </div>

    <div class="card-body d-flex justify-content-center col-md-12 col-lg-12 mx-auto">

      <form method="POST" action="{{ route('people.update', $person->id) }}" class="needs-validation" novalidate>
        @csrf 
        @method('PUT')
    
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="label" for="first_name"> First Name</label>

            <input class="form-control" type="text" name="first_name" id="first_name" value="{{ $person->first_name }}" >
            <div class="invalid-feedback">Valid first name is required. </div>
          </div>

          <div class="col-md-6 mb-3">
            <label class="label" for="last_name"> Last Name</label>

            <input class="form-control" type="text" name="last_name" id="last_name" value="{{$person->last_name}}"> 
          </div>
        </div>

        <div class="mb-3">
          <label for="email">Email <span class="text-muted">(Optional)</span></label>

          <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com" value="{{$person->email}}">
          <div class="invalid-feedback">
            Please enter a valid email address.
          </div>
        </div>

        <div class="mb-3">
          <label for="number">Phone Number <span class="text-muted">(Optional)</span></label>
          <input type="text" class="form-control" name="number" id="number" placeholder="022123456" value="{{$person->number}}">
          <div class="invalid-feedback">
            Please enter a valid phone number.
          </div>
        </div>

        <!-- Tags -->
        <div class="mb-3">
          <label for="tags">Tags <span class="text-muted">(Optional)</span></label>
           
          @component('components.tagpicker', ['tagtypes' => $tagtypes, 'selectedTagList' => $person->tags])
          @endcomponent
        </div>

        @isset($user)
        <div class="mb-3">
          <label> Associated with a user </label>
          <a href="{{ route('user.edit') }}"> Edit Login details </a>
        </div>
        @endisset

        <hr class="mb-4">
        <button class="btn btn-success btn-lg btn-round" type="submit">Save</button>

      </form>
    </div>

</div>

@endsection