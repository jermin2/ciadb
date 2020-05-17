@extends ('layouts/main')

@section ('header')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-colvis-1.6.2/b-html5-1.6.2/b-print-1.6.2/cr-1.5.2/r-2.2.4/rr-1.2.7/sc-2.0.2/sp-1.1.0/sl-1.3.1/datatables.min.css"/>
@endsection

@section ('content')

    <div class="card">
        <div class="card-header">
            <div class="card-title"><h2>Pivot Table</h2></div>

            
            <div class="people-filters">
            People Filters
            @component('components.tagpicker', ['tagtypes' => $tagtypes, 'selectedTagList' => Auth::user()->person->tags])
            @slot('text') Sys Tags @endslot
            @slot('pickername') people_tags @endslot
            @endcomponent

            @component('components.tagpicker', ['tags' => $usertags])
            @slot('text') User Tags @endslot
            @slot('pickername') people_usertags @endslot
            @endcomponent
            </div>

            <div class="event-filters">
            Event Filters
            @component('components.tagpicker', ['tagtypes' => $tagtypes, 'selectedTagList' => Auth::user()->person->tags])
            @slot('text') Sys Tags @endslot
            @slot('pickername') event_tags @endslot
            @endcomponent

            @component('components.tagpicker', ['tags' => $usertags])
            @slot('text') User Tags @endslot
            @slot('pickername') event_usertags @endslot
            @endcomponent
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="main-table" class="table-hover table-striped" style="width:100%">
                    <thead>
                        <!-- First row are the id. Second row is tags used for searching -->
                        <tr class="first" hidden>
                            <th>id</th>
                            <th>Tags</th>
                            <th>Person Name</th>
                            @foreach($events as $event)                          
                            <th data-id="{{$event->id}}">
                                <span hidden>meta data</span>
                                <span class="event-id" data-id="{{$event->id}}"></span>

                                @foreach($event->tags as $tag)
                                    <span class="event-tag" data-tag="{{$tag->name}}"></span>
                                @endforeach

                                {{$event->name}} {{$event->date}}
                            </th>
                            @endforeach
                        </tr>  
                        <tr>
                            <th>id</th>
                            <th>Tags</th>
                            <th>Person Name</th>
                            @foreach($events as $event)                          
                            <th  data-id="{{$event->id}}">
                                <a href="{{ route('events.edit', $event->id )}}"> {{$event->shortdate()}}</a>
                            </th>
                            @endforeach
                        </tr>                           
                    </thead>
                    <tbody id="event-table">
                    @foreach($people as $person)                       
                        <tr>
                            <td>{{$person->id}}</td>
                            <td>
                            <span class="">
                            @foreach($person->tags as $tag)
                                {{$tag->name}}
                            @endforeach
                            @foreach($person->usertags as $tag)
                                {{$tag->name}}
                            @endforeach
                            </span></td>   
                            <td><a href="{{ route('people.edit', $person->id ) }}" >{{$person->name()}}</a> </td>
                         
                            @foreach($events as $event)                          
                            <td>
                                @if( $event->people->contains($person))
                                    Yes
                                @else
                                    -
                                @endif
                            </td>
                            @endforeach

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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });




    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            var values = [$('.people-filters select').find("option:selected").text()];
            values = values.join(" ").split(' ').filter(Boolean);

            var tags = data[1]; // use data for the tag column

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
        var len = $('#main-table thead tr.first th').length;

        var table = $('#main-table').DataTable( { 
            select: {
                style: 'os',
                items: 'cell'
            },
            dom: 'Bfrtip',
            buttons: [
                'colvis', 'excel'
            ],

            colReorder: true,
            responsive: true,

            //Choose the top cell in the header (the one with tags);
            orderCellsTop: true, 

            columnDefs:[
                {
                    targets: [0,1],
                    visible: false,
                    searchable: true
                }
            
            ]

        });


        table
        .on( 'select', function ( e, dt, type, indexes ) {
            var rowData = table.rows( indexes ).data().toArray();
            var row =  indexes[0].row;
            var column = indexes[0].column;

            var event_id = table.column(column).header().getAttribute("data-id"); 
            var person_id = table.row(row).data()[0];
            var state = table.cell(indexes).data() != "Yes"; //New state

            $.ajax({
                type:'POST',
                url:"{{ route('ajaxRequest.post') }}",
                data:{event_id:event_id, person_id:person_id, state:state},
                success:function(data){
                    console.log(data.message);
                    var newstate = state ? "Yes": "-" ;
                    table.cell(indexes).data(newstate) ;
                },
            });
        } )




        $('.people-filters select').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue){
            $('#main-table').DataTable().draw();
        });

        /*
        c
        |0  1   2   3
    i   |-----------------------------
    0   |*  *   *   M  M
    1   |*  *   *   dt  dt
    1   |id ta  Nm  y/n y/n
    2   |id ta  Nm  y/n
        |
        _____________________________
        id= ID, ta=tags, Nm=Person name, dt=event date, y/n = Yes or no

        To get the id
        table.column(x).header().getElementsByClassName("event-id")[0].innerText

        To get Tags
        var tag = table.column(x).header().getElementsByClassName("event-tag")
        var a = Array.from(tag)
        values = a.map( ({innerHTML}) => innerHTML)


        */
        $('.event-filters select').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue){
            var values = [$('.event-filters select').find("option:selected").text()];
            values = values.join(" ").split(' ').filter(Boolean);
            
            
            //For each column (starting with the 4th (1st is id, 2nd is tags, 3rd is the name))
            for(var c = 3; c < len; c++){

                //Get the tags from the header
                var tag = table.column(c).header().getElementsByClassName("event-tag")
                var a = Array.from(tag);
                col_values = a.map( ({dataset:tag}) => tag);
                col_values = col_values.map( ({tag}) => tag);
                //Start with all columns showing
                table.column(c).visible(true);

                //Going through all the tags in the filters
                for(var i=0; i < values.length; i++){
                    if( !col_values.includes(values[i]) ){ //No match
                        //Hide the column
                        table.column(c).visible(false);
                        //console.log(c, values[i], col_values);
                    }
                }

            }
        });

        $('#main-table').DataTable().draw();
        $('.event-filters select').trigger('changed.bs.select',  ["", "", "", ""]);

    });
</script>

@endsection