@extends ('layouts/main')

@section ('header')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-colvis-1.6.2/b-html5-1.6.2/b-print-1.6.2/cr-1.5.2/r-2.2.4/rr-1.2.7/sc-2.0.2/sp-1.1.0/sl-1.3.1/datatables.min.css"/>
@endsection

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

            <h2 class="col-md-8"> Events </h2>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="input-group col-md-6 mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" for="tags">Filter</span>
                    </div>
                    @isset($selectedTagList)
                        @component('components.tagpicker', ['tagtypes' => $tagtypes, 'selectedTagList'=>$selectedTagList])
                    @else
                        @component('components.tagpicker', ['tagtypes' => $tagtypes])
                    @endisset
                        @slot('text') System Tags @endslot

                    @endcomponent

                    @isset($selectedUsertagList)
                        @component('components.tagpicker', ['tags' => $usertags, 'selectedTagList'=>$selectedUsertagList])
                    @else
                        @component('components.tagpicker', ['tags' => $usertags])
                    @endisset
                        @slot('text') User Tags @endslot
                        @slot('pickername')
                            usertagpicker
                        @endslot
                    @endcomponent
                </div>
            </div>
            <div class="table-responsive">
                <table id="main-table" class="table-hover table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>url</th>
                            <th scope="col" data-priority="1">Time</th>
                            <th scope="col" data-priority="1">Name</th>                          
                            <th scope="col" data-priority="3">Location</th>
                            <th scope="col">Notes</th>
                            <th scope="col" data-priority="2">Tags</th>
                            <th scope="col" data-priority="2">User Tags</th>
                            <th scope="col" data-priority="0">Actions</th>
                            
                        </tr>
                    </thead>
                    <tbody id="event-table">
                        @foreach($events as $event)
                        <tr>   
                            <td>{{ $event->id }} </td>
                            <td>{{route('events.edit', $event->id)}}</td>
                            <td> {{ $event->time }} </td>    
                            <td> <a href="{{route('events.edit', $event->id)}}" >{{ $event->name }}</a> </td>                           
                            <td class=""> {{ $event->location }} </td>
                                <!-- If event is NOT private OR it is private, but author is current user -->
                            <td class="notes"> @if(!$event->private || ($event->author_id == Auth::user()->id) )
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
                            <td> 
                                @foreach ($event->usertags as $tag)
                                    <a href="{{route('event-usertag.show', $tag->id)}}">
                                        <span class="badge" 
                                            style="color:#fff; background-color:{{$tag->color}}" >
                                        {{$tag->name}}
                                        </span> </a>
                                @endforeach
                            </td>
                            <td>
                                <div class="input-class-append row">
                                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-outline-secondary">View</a>  
                                    @can('edit_events')  
                                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        
                                        <a class="dropdown-item" href="{{ route('events.edit', $event->id ) }}">Edit</a>
                                        
                                        @can('delete_events')
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('events.delete', $event->id ) }}">Delete</a>
                                        @endcan
                                    </div> 
                                    @endcan
                                </div>
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


<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.21/sorting/datetime-moment.js"></script>
<script>
    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            var values = [$('select').find("option:selected").text()];
            values = values.join(" ").split(' ').filter(Boolean);

            var tags = data[6] + " " + data[7]; // use data for the tag column
            
            for(i = 0;i < values.length;i++)
            {
                if( !tags.includes(values[i])){
                    return false;
                }
            }
            return true;
        }
    );

    $(document).ready(function()
    {
        $.fn.dataTable.moment( 'ddd, Do MMM HH:mm YYYY' );
        var table = $('#main-table').DataTable( { 
            pageLength:50,
            dom: 'Bfrtip',
            buttons: [
                'colvis', 'excel'
            ],

            colReorder: true,
            responsive: true,
            order: [[2, "desc" ]],
            columnDefs:[
                {
                    targets: [0,1],
                    visible: false,
                    searchable: false,
                }
            ]
        });


        table
        .on( 'select', function ( e, dt, type, indexes ) {
            var rowData = table.rows( indexes ).data().toArray();
            var id= rowData[0][1];
            //console.log(rowData[0][0]);
            //window.location.href = id;
            
        } )

        $('#tags').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue){
            $('#main-table').DataTable().draw();
        });

        $('#usertagpicker').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue){

            $('#main-table').DataTable().draw();
        });

    });
</script>

@endsection