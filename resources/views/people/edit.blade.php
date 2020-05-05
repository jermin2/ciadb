@extends ('layouts/main')

@section ('content')
    <div class="col-md-8 col-lg-6">

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
           
          @component('components.tagpicker', ['tags' => $tags, 'selectedTagList' => $person->tags])
          @endcomponent
        </div>



        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Save</button>

      </form>
    </div>


@endsection