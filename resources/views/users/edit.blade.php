@extends ('layouts/main')

@section ('content')

<div class="d-flex justify-content-center col-md-12 mx-auto">

<div class="col-md-12">
    <div class="row" >
    <form method="POST" class="col-md-8 m-auto" action="{{route('users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="email">Email <span class="text-muted"></span></label>

            <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com" value="{{$user->email}}">
            <div class="invalid-feedback">
                Please enter a valid email address.
            </div>
        </div>


        <div class="mb-3">
            <label class="label" for="notes">Associated Person</label>

            <select class="selectpicker border w-100" name="person" id="person" data-live-search="true" title="Select a person">
            @foreach ($people as $person)
                @if(isset($user->person) && $user->person == $person)
                    <option value="{{ $person->id }}" class="tag" selected>{{$person->name()}} </option>
                @else
                    <option value="{{ $person->id }}" class="tag">{{$person->name()}} </option>
                @endif
                
            @endforeach
            </select>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>


        <hr class="mb-4">

        <button class="btn btn-primary btn-lg btn-block " type="submit">Save</button>
    </form>
    </div>

    <div class="row mt-4" >
    <form method="POST" class="col-md-8 m-auto" action="{{route('users.delete', $user->id)}}">
    @csrf
    @method('DELETE')
        <button class="btn btn-danger btn-lg btn-block" type="submit">Delete</button>
    </form>
    </div>
</div>
</div>


@endsection

@section('footer')
<script src="{{ asset('js/peoplepicker.js') }}?5"></script>
@endsection