@extends ('layouts/main')

@section ('content')
    <div class="d-flex justify-content-center col-md-12 col-lg-10 mx-auto">

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

                <input class="form-control" type="text" name="time" id="time" value="{{$event->time}}"> 
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="label" for="location">Location</label>

                <input class="form-control" type="text" name="location" id="location" value="{{ $event->location }}">
                <div class="invalid-feedback">Valid first name is required. </div>
            </div>

            <div class="mb-3">
                <label for="tags">Tags <span class="text-muted">(Optional)</span></label>

                <div>
                @component('components.tagpicker', ['tagtypes' => $tagtypes, 'selectedTagList' => $event->tags])
                @endcomponent
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <label class="label" for="notes">Attendees</label>
                <div>
                @component('components.peoplepicker', ['tagtypes' => $tagtypes, 'people' => $people, 'selectedpeople' => $event->people])
                @endcomponent
                </div>
                <div id="people" class="d-flex flex-wrap">
                    @foreach ($event->people as $person)
                    <div class="p-1">
                        <a href="{{route('event-person.show',$person->id)}}"><input type="hidden" name="people[]" value="{{$person->id}}"> {{$person->first_name}} {{$person->last_name }} </a>
                    </div>
                    @endforeach
                </div>


            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <label class="label" for="notes">Notes</label>

                <textarea class="form-control w-100" type="text" name="notes" id="notes" rows=5>{{ $event->notes }}</textarea>
                <div class="invalid-feedback">Valid first name is required. </div>
            </div>
        </div>

        <hr class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Save</button>
            </div>
        </div>
    </form>

    <div class="row col-md-12 mt-4">
        <div class="col-md-12">
            <form method="POST" action="{{route('events.delete', $event->id)}}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-lg btn-block col-md-6 p-auto" type="submit">Delete</button>
            </form>
        </div>
    </div>
</div>


@endsection

@section('footer')
<script src="{{ asset('js/peoplepicker.js') }}?5"></script>
@endsection