@extends ('layouts/main')


@section('header')
    <link href="{{ asset('css/content.css?2') }}" rel="stylesheet">
@endsection



@section ('content')
<div class=" col-md-12 col-lg-10 mx-auto">
    @component('components.event')
        @slot('title') Add Event @endslot

        @slot('event_content_header')
            <form method="POST" action="{{ route('events.store') }}" class="needs-validation w-100" novalidate>
            @csrf 
        @endslot

        @slot('name')
            <input class="form-control" type="text" name="name" id="name" placeholder="Event Name">
        @endslot

        @slot('time')
            @component('components.timepicker')
            @endcomponent
        @endslot

        @slot('location')
            <input class="form-control" type="text" name="location" id="location" placeholder="Location">
        @endslot

        @slot('author')
            <input class="form-control" value="{{Auth::user()->name}}" readonly/>
            <input type="hidden" name="author_id" class="form-control" value="{{Auth::user()->id}}" readonly/>
        @endslot

        @slot('tags')
            @component('components.tagpicker', ['tagtypes' => $tagtypes, 'selectedTagList' => Auth::user()->person->tags] )
                @slot('pickername')
                    event_tag
                @endslot
            @endcomponent
        @endslot

        @slot('usertags')
            @component('components.tagpicker', ['tags' => $usertags] )
                @slot('pickername')
                    event_usertag
                @endslot
                @slot('tagname')
                    usertags[]
                @endslot
            @endcomponent
        @endslot

        @slot('attendee_button')
            @component('components.peoplepicker', [
                'tagtypes' => $tagtypes, 
                'people' => $people, 
                'selectedperson' => $user->person
                ])
            
            @endcomponent
        @endslot

        @slot('attendees')

            @if(isset($user->person))
                <a class="px-1" href="{{route('people.show', $user->person->id)}}"><input type="hidden" name="people[]" value="{{$user->person->id}}"> {{ $user->person->name() }} </a>
            @endif

        @endslot

        @slot('private')
        <div class="input-group-text">
            <div class="custom-control custom-checkbox ">
                <input type="checkbox" class="custom-control-input input-lg" id="customCheck1" name="private">
                <label class="custom-control-label" for="customCheck1"></label>
            </div>
          </div>

        @endslot

        @slot('notes')
            <textarea class="form-control w-100" type="text" name="notes" id="notes" rows=5 placeholder="Notes"></textarea>
        @endslot

        @slot('buttons')
            <button class="col-md-4 btn btn-success btn-lg  btn-round p-auto" type="submit">Save</button>
        @endslot
    @endcomponent

</div>
@endsection

@section('footer')
<script src="{{ asset('js/peoplepicker.js') }}?41"></script>

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












                
