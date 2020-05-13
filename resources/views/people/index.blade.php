@extends ('layouts/main')

@section ('content')
    <div class="card">
        <div class="card-header">
            @isset($tag)
            <div class="text-center">
                <h2>{{$tag->name}}</h2>
            </div>
            @endisset
            <div class="row justify-content-between m-auto p-2">
                <h2> People </h2>
                <div>
                    @component('components.tagpicker', ['tagtypes' => $tagtypes])
                    @endcomponent
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-striped table-sm" >
                <thead>
                    <tr>
                        <th class="d-none d-md-block">id</th>
                        <th>Name</th>
                        @can ('show_events')
                            <th>Actions</th>
                        @endcan
                        <th>Tags</th>
                    </tr>
                </thead>
                <tbody id="people-table">
                @foreach($people as $person)
                    <tr>
                        <td class="d-none d-md-block"> <a href="{{ route('people.edit' , $person->id) }}" >{{ $person->id }} </a> </td>
                        <td> <a href="{{ route('people.edit' , $person->id) }}" >{{ $person->name() }}</a> </td>
                        @can ('show_events')
                        <td>                      
                            <a href="{{ route('event.person.show', $person->id) }}" class="col-lg-6 col-md-12  btn btn-primary btn-round">events
                        </td>
                        @endcan
                        <td> 
                        @foreach ($person->tags as $tag)
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