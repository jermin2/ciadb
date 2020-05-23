@extends ('layouts/main')

@section ('content')
<div class=" col-md-12 col-lg-10 mx-auto">
    @component('components.event')
        @slot('title')
            Edit Event
        @endslot

        @slot('event_content_header')
        <form method="POST" action="{{ route('events.update', $event->id) }}" class="needs-validation col-md-12" novalidate>
                @csrf 
                @method('PUT')
        @endslot

        @slot('name')
            <input class="form-control" type="text" name="name" id="name" value="{{ $event->name }}">
        @endslot

        @slot('time')
        @component('components.timepicker')
            @slot('currentTime')
                {{$event->time}}
            @endslot
        @endcomponent
        @endslot

        @slot('location')
            <input class="form-control" type="text" name="location" id="location" value="{{ $event->location }}">
        @endslot

        @slot('author')
            <input class="form-control" value="{{$event->author->name}}" readonly/>
        @endslot

        @slot('tags')
            @component('components.tagpicker', ['tagtypes' => $tagtypes, 'selectedTagList' => $event->tags])
                @slot('pickername')
                    event_tag
                @endslot
            @endcomponent
        @endslot

        @slot('usertags')
            @component('components.tagpicker', ['tags' => $usertags, 'selectedTagList' => $event->usertags])
                @slot('pickername')
                    event_usertag
                @endslot
                @slot('tagname')
                    usertags[]
                @endslot
            @endcomponent
        @endslot

        @slot('attendee_button')
            @component('components.peoplepicker', ['tagtypes' => $tagtypes, 'people' => $people, 'selectedpeople' => $event->people])
            @endcomponent
        @endslot
        @slot('attendees')

                @foreach ($event->people as $person)

                    <a class="px-1" href="{{route('event.person.show',$person->id)}}"><input type="hidden" name="people[]" value="{{$person->id}}"> {{$person->first_name}} {{$person->last_name }} </a>

                @endforeach

        @endslot

        @slot('notes')
            <textarea class="form-control w-100" type="text" name="notes" id="notes" rows=5>{{ $event->notes }}</textarea>
        @endslot

        @slot('buttons')
            <button class="btn btn-success btn-lg btn-round col-md-6 p-auto" type="submit">Save</button>
            <a href="{{route('events.delete', $event->id) }}" class="btn btn-danger btn-lg btn-round col-md-6 p-auto">Delete</a>
        @endslot


    @endcomponent
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