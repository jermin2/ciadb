<div class="card">
    <div class="card-header">
        <h2 class="card-title">{{$title}}</h2>
    </div>
        <div class="card-body">
            <form method="POST" action="{{ $action ?? '' }}" class="col-md-9" autocomplete="off">
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
                    <input id="{{$cpname ?? 'cp1'}}" type="text" class="form-control cp1" name="color" value=""/>
                </div>

                {{ $tagtype ?? '' }}

                @if($errors->any())
                    {{ implode('', $errors->all('<div>:message</div>')) }}
                @endif


                <button class="btn-round btn-lg btn-primary" type="submit">Create</button>
            </form>
        </div>
    </div>