@extends ('layouts/main')

@section ('content')
    <div class="d-flex justify-content-center col-md-12 col-lg-10 mx-auto">

    <div class="col-md-12">
    <form method="POST" action="{{ route('events.store') }}" class="needs-validation" novalidate>
        @csrf 
    
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="label" for="name">Name</label>

                <input class="form-control" type="text" name="name" id="name" value="{{ $event->name }}" readonly>
                <div class="invalid-feedback">Valid event name is required. </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="label" for="time">Time</label>

                <input class="form-control" type="text" name="time" id="time" value="{{$event->time}}" readonly> 
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="label" for="location">Location</label>

                <input class="form-control" type="text" name="location" id="location" value="{{ $event->location }}" readonly>
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

                <div id="people" class="d-flex flex-wrap">
                    @foreach ($event->people as $person)
                    <div class="p-1">
                        <a href="{{route('event-person.show',$person->id)}}"><input type="hidden" name="people[]" value="{{$person->id}}"> {{$person->first_name}} {{$person->last_name }} </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="tags">Tags <span class="text-muted">(Optional)</span></label>

                @component('components.tagpicker', ['tagtypes' => $tagtypes, 'selectedTagList' => $event->tags])
                @endcomponent

            </div>

        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <label class="label" for="notes">Notes</label>

                <textarea class="form-control" type="text" name="notes" id="notes" rows=5 readonly>{{ $event->notes }}</textarea>
                <div class="invalid-feedback">Valid first name is required. </div>
            </div>
        </div>

        <hr class="mb-4">
        <a href="{{ route('events.index') }}" class="btn btn-primary btn-lg btn-block" >Back</a>

        </form>
    </div>
    </div>


@endsection