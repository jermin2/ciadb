@extends ('layouts/main')

@section('header')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-colvis-1.6.2/b-html5-1.6.2/b-print-1.6.2/cr-1.5.2/r-2.2.4/rr-1.2.7/sc-2.0.2/sp-1.1.0/sl-1.3.1/datatables.min.css"/>

@endsection

@section ('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h2 class="col-md-8"> People </h2>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="input-group col-md-6 mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" for="tags">Filter</span>
                    </div>
                    @component('components.tagpicker', ['tagtypes' => $tagtypes])
                        @slot('text') System Tags @endslot
                    @endcomponent
                    @component('components.tagpicker', ['tags' => $usertags])
                        @slot('text') User Tags @endslot
                        @slot('pickername')
                            usertagpicker
                        @endslot
                    @endcomponent
                </div>
            </div>
            <div class="table-responsive">
            <table id="main-table" class="table-hover table-striped" style="width:100%" >
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Number</th>
                        <th>Year</th>
                        <th>DOB</th>
                        <th>Baptism</th>
                        <th>Parents</th>
                        <th>School</th>
                        <th>Notes</th>
                        <th>Tags</th>
                        <th>User Tags</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="people-table">
                @foreach($people as $person)
                    <tr>
                        <td> <a href="{{ route('people.edit' , $person->id) }}" >{{ $person->id }} </a> </td>
                        <td> <a href="{{ route('people.edit' , $person->id) }}" >{{ $person->name() }}</a> </td>
                        <td> {{ $person->email}}</td>
                        <td> {{ $person->gender }} </td>
                        <td> {{$person->number }} </td>
                        <td> {{ $person->year }} </td>
                        <td> {{ $person->dob }} </td>
                        <td> {{ $person->baptism }} </td>
                        <td> {{ $person->parents }} </td>
                        <td> {{ $person->school }} </td>
                        <td> {{ $person->notes }} </td>
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

                        <td>
                            <div class="input-class-append row">
                                <a href="{{ route('event.person.show', $person->id) }}" class="btn btn-sm btn-outline-secondary">Events</a>    
                                @can('edit_people')
                                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('people.show', $person->id ) }}">View</a>
                                    <a class="dropdown-item" href="{{ route('people.edit', $person->id ) }}">Edit</a>
                                    @can('delete_people')
                                    <div role="separator" class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('people.delete', $person->id ) }}">Delete</a>
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

<script>
    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            var values = [$('select').find("option:selected").text()];
            values = values.join(" ").split(' ').filter(Boolean);

            var tags = data[10] + " " + data[11]; // use data for the tag column
            
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
            pageLength:50,
            dom: 'Bfrtip',
            buttons: [
                'colvis', 'excel'
            ],

            colReorder: true,
            responsive: true,

            columnDefs:[
                {
                    targets: [0,5,6,7,8],
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