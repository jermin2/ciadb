@extends ('layouts/main')

@section ('content')

    <div class="card">
        <div class="card-header">
            @isset($tag)
            <div class="text-center">
                <h2>{{$tag->name}}</h2>
            </div>
            @endisset

            @isset($person)
            <div class="text-center">
                <h2>{{$person->first_name}} {{$person->last_name}}</h2>
                <h2>
                    @foreach($person->tags as $tag)
                    <span  class="badge badge-primary" style="color:#fff; background-color:{{$tag->color}}">{{$tag->name}}</span>
                    @endforeach
                </h2>
            </div>
            @endisset

            <div class="row justify-content-between m-auto p-2">
                <h2> Events </h2>
                <div>
                    @component('components.tagpicker', ['tagtypes' => $tagtypes])
                    @endcomponent

                    @component('components.tagpicker', ['tagtypes' => $tagtypes])
                        @slot('pickername')
                            tagss
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-sm" >
                    <thead>
                        <tr>
                            <th class="d-none d-md-block">#</th>
                            <th>Time</th>
                            <th>Name</th>
                            <th class="d-none d-md-block">Location</th>
                            <th>Notes</th>
                            <th>Tags</th>
                            
                        </tr>
                    </thead>
                    <tbody id="event-table">
                        @foreach($events as $event)
                        <tr>       
                            <td class="d-none d-md-block"> <a href="{{route('events.edit', $event->id)}}"  >{{ $event->id }} </a> </td>
                            <td> {{ $event->time }} </td>
                            <td> <a href="{{route('events.edit', $event->id)}}" >{{ $event->name }}</a> </td>
                            <td class="d-none d-md-block"> {{ $event->location }} </td>
                                <!-- If event is NOT private OR it is private, but author is current user -->
                            <td> @if(!$event->private || ($event->author_id == Auth::user()->id) )
                                    {{ $event->notes }} 
                                @else
                                    <span class="text-muted">*Private*</span>
                                @endif
                                    </td>
                            <td> 
                                @foreach ($event->tags as $tag)
                                    <a href="{{route('event-tag.show', $tag->id)}}">
                                        <span class="badge" 
                                            style="color:#fff; background-color:{{$tag->color}}" >
                                        {{$tag->name}}
                                        </span> </a>
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

@section ('footer')

<script>
    $(document).ready()
    {

        $('#tags').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue){

            console.log(e);
            var values = [$(this).find("option:selected").text()];
            values = values.join(" ").split(' ').filter(Boolean);

            $("#event-table tr").filter(function() 
            {
                var row = $(this);
                var tog = true;
                for(i = 0;i < values.length;i++)
                {
                    if( !row.children().eq(5).text().includes(values[i]) )
                        tog = false;
                }

                row.toggle(tog);    
            });

        });

        $('#tagss').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue){

console.log(e);
console.log($(this));
var values = [$(select).find("option:selected").text()];
values = values.join(" ").split(' ').filter(Boolean);

$("#event-table tr").filter(function() 
{
    var row = $(this);
    var tog = true;
    for(i = 0;i < values.length;i++)
    {
        if( !row.children().eq(5).text().includes(values[i]) )
            tog = false;
    }

    row.toggle(tog);    
});

});

    }
</script>

@endsection