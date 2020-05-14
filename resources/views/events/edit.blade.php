@extends ('layouts/main')

@section ('content')
<div class="card d-flex justify-content-center col-md-12 col-lg-10 mx-auto">

    <div class="card-header">
        <div class="card-title">
            <h2>Edit Event</h2>
        </div>
    </div>

    <div class="card-body">
        <div class="col-md-12">
            <form method="POST" action="{{ route('events.update', $event->id) }}" class="needs-validation col-md-12" novalidate>
                @csrf 
                @method('PUT')
            
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="label" for="name">Name</label>

                        <input class="form-control" type="text" name="name" id="name" value="{{ $event->name }}">
                        <div class="invalid-feedback">Valid event name is required. </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="label" for="time">Time</label>

                        @component('components.timepicker')
                        @slot('currentTime')
                            {{$event->time}}
                        @endslot
                        @endcomponent
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="label" for="location">Location</label>

                        <input class="form-control" type="text" name="location" id="location" value="{{ $event->location }}">
                        <div class="invalid-feedback">Valid first name is required. </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="label" for="author">Author</label>
                        <input class="form-control" value="{{$event->author->name}}" readonly/>
                    </div>

                    
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="label" for="notes">Attendees</label>
                        <div>
                        @component('components.peoplepicker', ['tagtypes' => $tagtypes, 'people' => $people, 'selectedpeople' => $event->people])
                        @endcomponent
                        </div>
                        <div id="people" class="d-flex flex-wrap">
                            @foreach ($event->people as $person)
                            <div class="p-1">
                                <a href="{{route('event.person.show',$person->id)}}"><input type="hidden" name="people[]" value="{{$person->id}}"> {{$person->first_name}} {{$person->last_name }} </a>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="tags">Tags <span class="text-muted">(Optional)</span></label>

                            <div>
                            @component('components.tagpicker', ['tagtypes' => $tagtypes, 'selectedTagList' => $event->tags])
                            @slot('pickername')
                                        event_tag
                                    @endslot
                            @endcomponent
                            @error('time')
                            <p class="help is-danger">{{ $errors->first('title') }}</p>
                            @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tags">Tags <span class="text-muted">(Optional)</span></label>

                            <div>
                            @component('components.tagpicker', ['tags' => $usertags, 'selectedTagList' => $event->usertags])
                                @slot('pickername')
                                    event_usertag
                                @endslot
                                @slot('tagname')
                                    usertags[]
                                @endslot
                            @endcomponent
                            @error('time')
                            <p class="help is-danger">{{ $errors->first('title') }}</p>
                            @enderror
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="label" for="notes">Notes</label>

                        <textarea class="form-control w-100" type="text" name="notes" id="notes" rows=5>{{ $event->notes }}</textarea>
                        <div class="invalid-feedback">Valid first name is required. </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="private" @if($event->private) checked @endif>
                            <label class="form-check-label" for="private">Make these notes private</label>
                        </div>
                    </div>
                </div>

                <hr class="mb-4">

                <div class="row col-md-12 mt-4">

                        <button class="btn btn-success btn-lg btn-round col-md-6 p-auto" type="submit">Save</button>

                </div>
            </form>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @can ('delete_event', $event)
            <div class="row col-md-12 mt-4">

                    <form method="POST" class="col-md-12" action="{{route('events.delete', $event->id)}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-lg btn-round col-md-6 p-auto" type="submit">Delete</button>
                    </form>

            </div>
            @endcan
        </div>
    </div>
</div>

@endsection

@section('footer')

<script src="{{ asset('js/peoplepicker.js') }}?5"></script>

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