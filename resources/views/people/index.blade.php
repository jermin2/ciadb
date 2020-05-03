@extends ('layouts/main')

@section ('content')

    <h2> People </h2>
    <div class="table-responsive">
    <table class="table table-striped table-sm">
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
                <td> <a href="{{ route('people.edit' , $person->id) }}" >{{ $person->first_name }}</a> </td>
                <td> {{ $person->last_name }} </td>
                <td> 
                @foreach ($person->tags as $tag)
                    <a href="#"> {{$tag->name}}</a>
                @endforeach
                 </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>


@endsection