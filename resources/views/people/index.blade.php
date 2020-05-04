@extends ('layouts/main')

@section ('content')

    <div class="row justify-content-between">
        <h2> People </h2>
        <select id="tags" name="tags[]" class="selectpicker" multiple> 
            @foreach ($tags as $tag)
            <option value="{{ $tag->id }}" selected> {{ $tag->name }} </option>
            @endforeach
        </select>
    </div>
    <div class="table-responsive">
    <table class="table table-striped table-sm" id="people-table">
        <thead>
            <tr>
                <th>id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Tags</th>
            </tr>
        </thead>
        <tbody>
        @foreach($people as $person)
            <tr>
                <td> <a href="{{ route('people.edit' , $person->id) }}" >{{ $person->id }} </a> </td>
                <td> <a href="{{ route('people.show' , $person->id) }}" >{{ $person->first_name }}</a> </td>
                <td> {{ $person->last_name }} </td>
                <td> 
                @foreach ($person->tags as $tag)
                    <a href="{{route('tag.show', $tag->id)}}">{{$tag->name}}</a>
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
        
        //console.log( $(this).children().eq(3).text() );
        //$(this).children().eq(3).text() ;

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