@extends ('layouts/main')

@section ('content')
    <div class="d-flex justify-content-center col-md-12 col-lg-10 mx-auto">
    <form method="POST" action="{{ route('events.store') }}" class="needs-validation w-100" novalidate>
        @csrf 
    
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="label" for="name">Name</label>

                <input class="form-control" type="text" name="name" id="name" placeholder="Event Name">
                <div class="invalid-feedback">Valid event name is required. </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="label" for="time">Time</label>

                <input class="form-control" type="text" name="time" id="time" placeholder="Time"> 
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="label" for="location">Location</label>

                <input class="form-control" type="text" name="location" id="location" placeholder="Location">
                <div class="invalid-feedback">Valid first name is required. </div>
            </div>
            
            <!-- Tags -->
            <div class="col-md-6 mb-3">
                <label for="tags">Tags <span class="text-muted">(Optional)</span></label>

                @component('components.tagpicker', ['tags' => $tags])
                    @slot('pickername')
                        event_tag
                    @endslot
                @endcomponent
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <div>
                @component('components.peoplepicker', ['tags' => $tags, 'people' => $people])
                @endcomponent
                </div>
                <div id="people" class="d-flex flex-wrap">
                    <!--The peoplepicker will create components in here-->
                </div>
            </div>
        </div>

            

        <div class="row">
            <div class="col-md-12 mb-3">
                <label class="label" for="notes">Notes</label>

                <textarea class="form-control w-100" type="text" name="notes" id="notes" rows=5 placeholder="Notes"></textarea>
                <div class="invalid-feedback">Valid first name is required. </div>
            </div>
        </div>






        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Save</button>

        </form>
    </div>


@endsection

@section('footer')
<script src="{{ asset('js/peoplepicker.js') }}"></script>
@endsection