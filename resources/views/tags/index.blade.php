@extends ('layouts/main')

@section('header')

@endsection

@section ('content')
<div class="row">
    <div class="card col-md-5 mx-auto">
        <div class="card-header">
            <div class="card-title">
                <h2>User Tags</h2>
            </div>
        </div>
        <div class="card-body">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($usertags as $usertag)
                    <tr>
                        <td>
                            <a href="#"><h2><span class=" tag badge " style="background-color:{{$usertag->color}}">{{$usertag->name}}</span></h2></a>
                        </td>
                        <td>
                            <a href="{{route('usertags.delete', $usertag->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card col-md-5 mx-auto">
        <div class="card-header">
            <div class="card-title">
                <h2>Create New Tag</h2>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('usertags.store') }}" class="col-md-9" autocomplete="off">
                @csrf

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Name</span>
                    </div>
                    <input type="text" class="form-control" id="name" name="name">
                    
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Color</span>
                    </div>
                    <input id="cp1" type="text" class="form-control" name="color" value=""/>
                </div>

                

                @if($errors->any())
                    {{ implode('', $errors->all('<div>:message</div>')) }}
                @endif
                <button class="btn-round btn-lg btn-primary" type="submit">Create</button>
            </form>
        </div>
    </div>
</div>

@endsection

@section('footer')

<script>
  $(function () {
    $('#cp1').colorpicker();
  });
</script>
@endsection