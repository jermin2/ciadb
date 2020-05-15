@extends ('layouts/main')

@section('header')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-colvis-1.6.2/b-html5-1.6.2/b-print-1.6.2/cr-1.5.2/r-2.2.4/rr-1.2.7/sc-2.0.2/sp-1.1.0/sl-1.3.1/datatables.min.css"/>

<style>
.dropdown-toggle:after { content: none }
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
            <div class="row justify-content-between m-auto p-2">
                <h2 class="col-md-8"> People </h2>
                <div class="col-md-4">
                    <div class="d-flex justify-content-between ">
                        System Tags
                        @component('components.tagpicker', ['tagtypes' => $tagtypes])
                            @slot('text') System Tags @endslot
                        @endcomponent
                    </div>
                    <div class="d-flex justify-content-between ">
                        User Tags
                        @component('components.tagpicker', ['tags' => $usertags])
                            @slot('text') User Tags @endslot
                            @slot('pickername')
                                usertagpicker
                            @endslot
                        @endcomponent
                    </div>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table id="main-table" class="table-hover table-striped" style="width:100%" >
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        @can ('show_events')
                            <th>Actions</th>
                        @endcan
                        <th>Tags</th>
                        <th>User Tags</th>
                    </tr>
                </thead>
                <tbody id="people-table">
                @foreach($people as $person)
                    <tr>
                        <td> <a href="{{ route('people.edit' , $person->id) }}" >{{ $person->id }} </a> </td>
                        <td> <a href="{{ route('people.edit' , $person->id) }}" >{{ $person->name() }}</a> </td>
                        @can ('show_events')
                        <td>                      
                            <a href="{{ route('event.person.show', $person->id) }}" class="col-lg-8  btn btn-primary btn-round">events
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
                        <td> 
                        @foreach ($person->usertags as $tag)
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
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-colvis-1.6.2/b-html5-1.6.2/b-print-1.6.2/cr-1.5.2/r-2.2.4/rr-1.2.7/sc-2.0.2/sp-1.1.0/sl-1.3.1/datatables.min.js"></script>

<script>
    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            var values = [$('select').find("option:selected").text()];
            values = values.join(" ").split(' ').filter(Boolean);

            var tags = data[3] + " " + data[4]; // use data for the tag column
            
            for(i = 0; i < values.length;i++)
            {
                if( !tags.includes(values[i]) ){
                    return false;
                }
            }
            return true;
        }
    );

    $(document).ready(function() 
    {
        var table = $('#main-table').DataTable( { 
            select: true,
            dom: 'Bfrtip',
            buttons: [
                'colvis', 'excel'
            ],

            colReorder: true,
            responsive: true,

            columnDefs:[
                {
                    targets: [],
                    visible: false,
                    searchable: false,
                },
                {
                    "width":"40%",
                    "targets":1
                }
            ]
        });

        $('#tags').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue){
            $('#main-table').DataTable().draw();
        });

        $('#usertagpicker').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue){
            $('#main-table').DataTable().draw();
        });
    });
</script>

@endsection