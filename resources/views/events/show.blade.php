@extends ('layouts/main')

@section ('content')
    <div class="col-md-8 col-lg-6">

    <form method="POST" action="{{ route('people.store') }}" class="needs-validation" novalidate>
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

            <div class="mb-3">
                <label for="tags">Tags <span class="text-muted">(Optional)</span></label>

                <div>
                @foreach ($event->tags as $tag)
                    <a href="{{route('event-tag.show', $tag->id)}}"> {{$tag->name}} </a>
                @endforeach
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <label class="label" for="notes">Attendees</label>

                @foreach ($event->people as $person)
                    <a href="{{route('event-person.show',$person->id)}}"> {{$person->first_name}} {{$person->last_name }} </a>
                @endforeach

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


@endsection