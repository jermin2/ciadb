@extends ('layouts/main')

@section ('content')

<div class="card col-md-6 mx-auto">
  <div class="card-header">
    <div class="card-title">
      <h2>Edit Goal</h2>
    </div>
  </div>

  <div class="card-body">
    <form method="POST" action="{{ route('goals.update', ['person' => $person->id, 'goal' => $goal->id] ) }}">
      @csrf
      @method('PUT')
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Goal</span>
        </div>
        <input type="text" class="form-control" name="goal" value="{{$goal->goal}}">
      </div>

      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Start date</span>
        </div>
        @component('components.timepicker', ['pickername'=>'start_date'])
        @slot('currentTime')
          {{$goal->start_date}}
        @endslot
        @endcomponent
      </div>

      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">End date</span>
        </div>
        @component('components.timepicker', ['pickername'=>'end_date'])
        @slot('currentTime')
          {{$goal->end_date}}
        @endslot
        @endcomponent
      </div>




      <div class="input-group mb-3">
        <span class="input-group-text">Make private</span>
        <div class="input-group-append">
          <div class="input-group-text">

        <div class="custom-control custom-checkbox ">
            <input type="checkbox" class="custom-control-input input-lg" id="customCheck1" name="private" @if($goal->private) checked @endif >
            <label class="custom-control-label" for="customCheck1"></label>
        </div>


          </div>
        </div>
        
      </div>


      <button class="btn btn-success" type="submit">Save</button>
    </form>
  </div>
</div>

@endsection

@section('footer')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.25.3/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />

<script type="text/javascript">
$(document).ready( function() {

    $('.date').datetimepicker({
    format: "DD-MM-Y",
    debug: true,
    } );
});

</script>

@endsection