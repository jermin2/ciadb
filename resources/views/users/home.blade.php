@extends('layouts/main')


@section('header')
<style>
div.scrollmenu {
  overflow: auto;
  white-space: nowrap;
}

div#scroll-deck {
    overflow: auto;
  white-space: nowrap;
  flex-flow: row nowrap;
}

div.scrollmenu div {
  display: inline-block;
  color: white;
  text-align: left;
  padding: 5px;
  text-decoration: none;
}

div.card {
    white-space: normal;
}

div#scroll-deck div:hover {
  background-color: #AAA;
}
</style>

@endsection

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <h2> Last 5 Events </h2>

            <div id="scroll-deck" class="card-deck">

                @foreach($events as $event)
                <div class="card mx-0" style="min-width: 15rem; max-width:15rem;">
                    <div class="card-body p-3">
                        <a href="{{ route('events.show', $event->id) }}"><h5 class="card-title">{{$event->name}}</h5></a>
                        <h6 class="card-subtitle mb-2 text-muted">{{$event->time}}</h6>
                        <h6 class="card-subtitle mb-2 text-muted">{{$event->location}}</h6>

                        <span class="badge badge-primary">{{count($event->people)}}</span>
                        @foreach($event->people as $person)
                            @if ($loop->iteration < 3) <!-- Only show first 3 names -->
                            <a href="{{ route('people.show', $person->id) }}">{{$person->name()}},</a>
                            @else
                                .
                            
                            @endif

                        @endforeach
                        

                    </div> 

                    <div class="card-footer p-1">
                        <div class="d-flex flex-row-reverse m-auto">
                            @foreach($event->tags as $tag)
                                <span class="badge" style="color:#fff; background-color:{{$tag->color}}">{{$tag->name}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

        </div>
    </div>
</div>
@endsection
