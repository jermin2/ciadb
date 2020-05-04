@extends ('layouts/main')

@section ('content')
    <div class="col-md-8 col-lg-6">

    <form method="POST" action="{{ route('people.store') }}" class="needs-validation" novalidate>
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

        <div class="mb-3">
          <label for="email">Email <span class="text-muted">(Optional)</span></label>
          <input type="email" class="form-control" id="email" placeholder="you@example.com">
          <div class="invalid-feedback">
            Please enter a valid email address.
          </div>
        </div>

        <div class="mb-3">
          <label for="number">Phone Number <span class="text-muted">(Optional)</span></label>
          <input type="email" class="form-control" id="number" placeholder="022123456">
          <div class="invalid-feedback">
            Please enter a valid phone number.
          </div>
        </div>

        <div class="mb-3">
        <label for="tags">Tags <span class="text-muted">(Optional)</span></label>

        <!-- Tags -->
        <select id="tags" name="tags[]" class="selectpicker" multiple> 
            @foreach ($tags as $tag)
            <option value="{{ $tag->id }}" > {{ $tag->name }} </option>
            @endforeach
        </select>
        </div>

        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Save</button>
    </form>

    </div>

@endsection