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
            @component('components.tagpicker', ['tagtypes' => $tagtypes])
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
            @component('components.tagpicker', ['tagtypes' => $tagtypes])
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
                        <tr>
                            <th>Name</th>
                            @foreach($events as $event)                          
                            <th>
                                {{$event->shortdate()}} a
                                <span class="d-none">
                                @foreach($event->tags as $tag)
                                    {{$tag->name}}
                                @endforeach
                                </span>
                            </th>
                            @endforeach
                        </tr>
                            
                    </thead>
                    <tbody id="event-table">
                    @foreach($people as $person)                       
                        <tr>  
                            <td>{{$person->name()}} 
                            <span class="d-none">
                            @foreach($person->tags as $tag)
                                {{$tag->name}}
                            @endforeach
                            @foreach($person->usertags as $tag)
                                {{$tag->name}}
                            @endforeach
                            </span></td>                          
                            @foreach($events as $event)                          
                            <td>
                                @if( $event->people->contains($person))
                                    Yes
                                @else
                                    No
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
    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            var values = [$('.people-filters select').find("option:selected").text()];
            values = values.join(" ").split(' ').filter(Boolean);

            var tags = data[0]; // use data for the tag column

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
        var table = $('#main-table').DataTable( { 
            select: true,
            dom: 'Bfrtip',
            buttons: [
                'colvis', 'excel'
            ],

            colReorder: true,
            responsive: true,

        });


        table
        .on( 'select', function ( e, dt, type, indexes ) {
            var rowData = table.rows( indexes ).data().toArray();           
        } )




        $('.people-filters select').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue){
            $('#main-table').DataTable().draw();
        });

        $('.event-filters select').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue){
            var values = [$('.event-filters select').find("option:selected").text()];
            values = values.join(" ").split(' ').filter(Boolean);
            var len = $('#main-table thead th').length;
            
            
            for(var c = 1; c < len; c++){
                var col_values = table.column(c).header().children[0].innerText;
                //Start with all columns showing
                table.column(c).visible(true);
                for(var i=0; i < values.length; i++){
                    if( col_values.search(values[i]) < 0){ //No match
                        //Hide the column
                        table.column(c).visible(false);
                    }
                }

            }
        });

    });
</script>

@endsection