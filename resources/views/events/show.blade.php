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
        <div class="form-control">
          @foreach ($event->tags as $tag)
          <a href="{{route('event-tag.show', $tag->id)}}">
                  <span class="badge" 
                      style="color:#fff; background-color:{{$tag->color}}" >
                  {{$tag->name}}
              </span> </a>
          @endforeach
        </div>
        @endslot

        @slot('usertags')
        <div class="form-control">
        @foreach ($event->usertags as $tag)
          <a href="{{route('event-usertag.show', $tag->id)}}">
                  <span class="badge" 
                      style="color:#fff; background-color:{{$tag->color}}" >
                  {{$tag->name}}
              </span> </a>
          @endforeach
        </div>
        @endslot

        @slot('attendee_button')
        <span class="input-group-text" for="attendees">Attendees</span>
        @endslot

        @slot('attendees')
                @foreach ($event->people as $person)
                    <a class="px-1" href="{{route('people.show',$person->id)}}"><input type="hidden" name="people[]" value="{{$person->id}}" readonly> {{$person->first_name}} {{$person->last_name }} </a>
                @endforeach
        @endslot

        @slot('private')
        <div class="input-group-text">
            <div class="custom-control custom-checkbox ">
                <input type="checkbox" class="custom-control-input input-lg" id="customCheck1" name="private" @if($event->private) checked @endif >
                <label class="custom-control-label" for="customCheck1"></label>
            </div>
          </div>
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