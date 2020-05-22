@extends ('layouts/main')

@section ('content')

<div class="card">
  <div class="card-header">
    <div class="card-title">
      <h2>Edit Goal</h2>
    </div>
  </div>

  <div class="card-body">
    <form method="POST" action="{{ route('goals.update', ['person' => $person->id, 'goal' => $goal->id] ) }}">
      @csrf
      @method('PUT')
      <div class="row">
      
      <input type="text" name="goal" value="{{$goal->goal}}">
      @component('components.timepicker', ['pickername'=>'start_date'])
      @slot('currentTime')
      {{$goal->start_date}}
      @endslot

      @endcomponent
      @component('components.timepicker', ['pickername'=>'end_date'])
      @endcomponent
      <input type="checkbox" name="private" @if($goal->private) checked @endif >

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