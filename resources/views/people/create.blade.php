@extends ('layouts/main')

@section ('content')
<div class="card col-lg-8 col-md-11 col-sm-12 mx-auto">
  <div class="card-header">
    <div class="card-title text-center"><h2>Record person</h2></div>
  </div>
  <div class="card-body d-flex justify-content-center col-md-12 col-lg-12 mx-auto">

    <form method="POST" action="{{ route('people.store') }}" class="needs-validation col-md-12" novalidate>
      @csrf 

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="label" for="first_name"> First Name</label>

          <input class="form-control" type="text" name="first_name" id="first_name">
          <div class="invalid-feedback">Valid first name is required. </div>
        </div>

        <div class="col-md-6 mb-3">
          <label class="label" for="last_name"> Last Name</label>

          <input class="form-control" type="text" name="last_name" id="last_name">
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="email">Email <span class="text-muted">(Optional)</span></label>
          <input type="email" class="form-control" id="email" placeholder="you@example.com">
          <div class="invalid-feedback">
            Please enter a valid email address.
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="number">Phone Number <span class="text-muted">(Optional)</span></label>
          <input type="email" class="form-control" id="number" placeholder="022123456">
          <div class="invalid-feedback">
            Please enter a valid phone number.
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="tags">Tags <span class="text-muted">(Optional)</span></label>
          <!-- Tags -->
          
          @component('components.tagpicker', ['tagtypes' => $tagtypes])   
          @endcomponent
          
        </div>
      </div>
      <hr class="mb-4">
      <div class="row">
        <div class="col-md-12">
          <button class="col-md-6 btn btn-primary btn-lg btn-round" type="submit">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection


