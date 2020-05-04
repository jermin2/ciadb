@extends ('layouts/main')

@section ('content')

    <div class="row justify-content-between">
        <h2> Event </h2>
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
        <tbody id="people-table">
        @foreach($events as $event)
            <tr>
                
                <td> <a href="#" >{{ $event->id }} </a> </td>
                <td> {{ $event->time }} </td>
                <td> <a href="#" >{{ $event->name }}</a> </td>
                <td> {{ $event->location }} </td>
                <td> 
                @foreach ($event->tags as $tag)
                    <a href="#">{{$tag->name}}</a>
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

        $("#people-table tr").filter(function() 
        {
            var row = $(this);
            var tog = false;
            for(i = 0;i < values.length;i++)
            {
                if( row.children().eq(3).text().includes(values[i]) )
                    tog = true;
            }

            row.toggle(tog);    
        });

    });

@endsection