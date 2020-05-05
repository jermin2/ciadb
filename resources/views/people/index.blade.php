@extends ('layouts/main')

@section ('content')

    @isset($tag)
    <div class="text-center">
        <h2>{{$tag->name}}</h2>
    </div>
    @endisset
    <div class="row justify-content-between">
        <h2> People </h2>
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
                <th>First Name</th>
                <th>Last Name</th>
                <th>Tags</th>
            </tr>
        </thead>
        <tbody id="people-table">
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

@section ('footer')

<script>
    $(document).ready()
    {

        $('#tags').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue){

            var values = [$(this).find("option:selected").text()];
            values = values.join(" ").split(' ').filter(Boolean);

            $("#people-table tr").filter(function() 
            {
                var row = $(this);
                var tog = true;
                for(i = 0;i < values.length;i++)
                {
                    if( !row.children().eq(3).text().includes(values[i]) )
                        tog = false;
                }

                row.toggle(tog);    
            });

        });
    }
</script>

@endsection