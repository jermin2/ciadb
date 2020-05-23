@extends ('layouts/main')

@section ('content')
<div class=" col-md-12 col-lg-10 mx-auto">
    @component('components.event')
        @slot('title')
            Show Event
        @endslot

        @slot('event_content_header')
        <form class="col-md-12" novalidate>
        @endslot

        @slot('name')
            <input class="form-control" type="text" name="name" id="name" value="{{ $event->name }}" readonly>
        @endslot

        @slot('time')
            <input class="form-control" value="{{$event->time}}" readonly/>
        @endslot

        @slot('location')
            <input class="form-control" type="text" name="location" id="location" value="{{ $event->location }}" readonly>
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
        <span class="input-group-text" for="attendees">Attendees</span>
        @endslot
        @slot('attendees')

                @foreach ($event->people as $person)

                    <a class="px-1" href="{{route('event.person.show',$person->id)}}"><input type="hidden" name="people[]" value="{{$person->id}}" readonly> {{$person->first_name}} {{$person->last_name }} </a>

                @endforeach

        @endslot

        @slot('notes')
            <textarea class="form-control w-100" type="text" name="notes" id="notes" rows=5 readonly>
@if(!$event->private || ($event->author_id == Auth::user()->id) )
{{ $event->notes }} 
@else
*Contents Hidden by Author*
@endif  </textarea>
        @endslot

        @slot('buttons')
            @can('edit_event')
                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-danger btn-lg col-md-6 btn-round" >Edit</a>
            @endcan
            <a href="{{ route('events.index') }}" class="btn btn-primary btn-lg col-md-6 btn-round" >Back</a>
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