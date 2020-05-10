@extends ('layouts/main')

@section('header')
<style>
.card .card-header {
    padding: 15px 15px 0;
    border: 0;
    background-color: #fff;

}

.card .card-header::not([data-bakground-color]){
    background-color: transparent;
}

.card {
    border-radius: 14px;
    box-shadow: 0 6px 10px -4px rgba(0,0,0,.15);
    margin-bottom: 20px;
    border: 0 none;
}

.table>thead>tr>th {
    font-size:16px;
    text-transform: uppercase;
    border: 0;
}

.table>tbody>tr>td {
    font-size:16px;
    padding: 5px 5px;
    box-sizing: border-box;
    border-top: 1px solid #dee2e6;
}

</style>
@endsection

@section ('content')
    <div class="card">
        <div class="card-header">
            @isset($tag)
            <div class="text-center">
                <h2>{{$tag->name}}</h2>
            </div>
            @endisset
            <div class="row justify-content-between m-auto">
                <h2 class="p-2"> People </h2>
                <div class="p-2">
                    @component('components.tagpicker', ['tagtypes' => $tagtypes])
                    @endcomponent
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-sm" >
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