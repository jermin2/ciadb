@extends ('layouts/main')

@section('header')

@endsection

@section ('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        @component('components.tagindex' )
            @slot('title')
                User Tags
            @endslot

            @slot('content')
                @foreach($usertags as $usertag)
                    <tr>
                        <td>
                            <a href="#"><h2><span class=" tag badge " style="background-color:{{$usertag->color}}">{{$usertag->name}}</span></h2></a>
                        </td>
                        <td>
                            <a href="{{route('usertags.delete', $usertag->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                        {{ $tagtype_content ?? '' }}
                    </tr>
                @endforeach
            @endslot
        @endcomponent
    </div>

    <div class="col-md-6 mx-auto">
        @component('components.tagcreate', ['errors' => $errors] )
        @slot('title')
            Create User Tag
        @endslot

        @slot('action')
            {{ route('usertags.store') }}
        @endslot
        @endcomponent
    </div>

    @can('edit_systemtags')
    <div class="col-md-6 mx-auto">
        @component('components.tagindex' )
            @slot('title')
                System Tags
            @endslot

            @slot('tagtype_header')
                <th>Tagtype</th>
            @endslot

            @slot('content')
                @foreach($tags as $tag)
                    <tr>
                        <td>
                            <a href="#"><h2><span class=" tag badge " style="background-color:{{$tag->color}}">{{$tag->name}}</span></h2></a>
                        </td>
                        <td>
                            <a href="{{route('tags.delete', $tag->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                        <td class="text-center">
                            <label >{{$tag->tagtype->name}}</label>
                        </td>
                    </tr>
                @endforeach
            @endslot
        @endcomponent
    </div>

    <div class="col-md-6 mx-auto">
        @component('components.tagcreate', ['errors' => $errors] )
        @slot('title')
                Create System Tag
        @endslot

        @slot('cpname')
            cp2
        @endslot

        @slot('action')
            {{ route('tags.store') }}
        @endslot

        @slot('tagtype')
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Tagtype</span>
                </div>
                <select class="custom-select" name="tagtype_id">
                    @foreach($tagtypes as $tagtype)
                    <option value="{{$tagtype->id}}">{{$tagtype->name}}</option>
                    @endforeach
                </select>
            </div>
        @endslot
        @endcomponent
    </div>
    @endcan
</div>
@endsection

@section('footer')

<script>
  $(function () {
    $('.cp1').colorpicker();
  });
</script>
@endsection