@extends ('layouts/main')

@section ('content')

    @isset($person)
    <div class="text-center">
        <h2>{{$person->first_name}} {{$person->last_name}}</h2>
    </div>
    @endisset
    @isset($tag)
    <div class="text-center">
        <h2>{{$tag->name}}</h2>
    </div>
    @endisset
    <div class="row justify-content-between">
        <h2> Events </h2>
        <select id="tags" name="tags[]" class="selectpicker" multiple> 

            @foreach ($tagtypes as $tagtype)
                <optgroup label="{{ $tagtype->name }}">
                @foreach ($tagtype->tags as $tag)
                    <option value="{{ $tag->id }}" selected> {{ $tag->name }} </option>
                @endforeach
            @endforeach
        </select>
    </div>
    <div class="table-responsive">
    <table class="table table-striped table-sm" >
        <thead>
            <tr>
                <th>id</th>
                <th>Time</th>
                <th>Name</th>
                <th>Location</th>
                <th>Tags</th>
            </tr>
        </thead>
        <tbody id="event-table">
        @foreach($events as $event)
            <tr>
                
                <td> <a href="{{route('events.edit', $event->id)}}"  >{{ $event->id }} </a> </td>
                <td> {{ $event->time }} </td>
                <td> <a href="{{route('events.show', $event->id)}}" >{{ $event->name }}</a> </td>
                <td> {{ $event->location }} </td>
                <td> 
                @foreach ($event->tags as $tag)
                    <a href="{{route('event-tag.show', $tag->id)}}"> {{$tag->name}} </a>
                @endforeach
                 </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>


@endsection

@section ('ready-script')


    $('#tags').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue){

        var values = [$(this).find("option:selected").text()];
        values = values.join(" ").split(' ').filter(Boolean);

        $("#event-table tr").filter(function() 
        {
            var row = $(this);
            var tog = true;
            for(i = 0;i < values.length;i++)
            {
                if( !row.children().eq(4).text().includes(values[i]) )
                    tog = false;
            }

            row.toggle(tog);    
        });

    });

@endsection