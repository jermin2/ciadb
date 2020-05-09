@extends ('layouts/main')


@section ('header')

@endsection



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

            @error('time')
                @message
            @enderror

            <div class="col-md-6 mb-3">
                <label class="label" for="time">Time</label>

                @component('components.timepicker')
                @endcomponent
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="label" for="location">Location</label>

                <input class="form-control" type="text" name="location" id="location" placeholder="Location">
                <div class="invalid-feedback">Valid first name is required. </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="label" for="author">Author</label>
                <input class="form-control" value="{{Auth::user()->name}}" readonly/>
            </div>
            
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <div>
                @component('components.peoplepicker', [
                    'tagtypes' => $tagtypes, 
                    'people' => $people, 
                    'selectedperson' => $user->person
                    ])
                 
                @endcomponent
                </div>
                <div id="people" class="d-flex flex-wrap">
                @if(isset($user->person))
                    <a href="{{route('people.show', $user->person->id)}}"> {{ $user->person->name() }} </a>
                @endif
                    <!--The peoplepicker will create components in here-->
                </div>
            </div>

            <!-- Tags -->
            <div class="col-md-6 mb-3">
                <label for="tags">Tags <span class="text-muted">(Optional)</span></label>
                
                <div>
                @component('components.tagpicker', ['tagtypes' => $tagtypes] )
                    @slot('pickername')
                        event_tag
                    @endslot
                @endcomponent
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

<script src="{{ asset('js/peoplepicker.js') }}?41"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.25.3/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />

<script type="text/javascript">
$(document).ready( function() {
    $('#datetimepicker1').datetimepicker({
    format: "ddd, Do MMM HH:mm Y",
    debug: true,
    } );
});

</script>
@endsection
