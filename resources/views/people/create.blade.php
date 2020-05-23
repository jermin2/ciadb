@extends ('layouts/main')

@section ('content')
<div class="row">
  <div class="col-lg-8 col-md-12  col-sm-12 mx-auto">
  @component('components.person', ['tagtypes' => $tagtypes, 'usertags' => $usertags])



      @section('content-header')
        <form method="POST" action="{{ route('people.store') }}" class="needs-validation col-md-12" novalidate>
        @csrf 
      @endsection

      @section('content-title')
        <h2>Add a person</h2>
      @endsection

      @section('first_name')
        <input class="form-control" type="text" name="first_name" id="first_name" >
        @error('first_name')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      @endsection

      @section('last_name')
        <input class="form-control" type="text" name="last_name" id="last_name"  >
      @endsection

      @section('email')
        <input type="email" class="form-control" id="email" placeholder="you@example.com"  >
      @endsection

      @section('gender')
        <select class="custom-select" name="gender" id="year">
          <option value="" selected>..</option>
          <option value="m">M</option> 
          <option value="f">F</option> 
        </select>
      @endsection

      @section('number')
        <input type="email" class="form-control" id="number" placeholder="022123456"  >
      @endsection

      @section('year')
        <select class="custom-select" name="year" id="year">
          <option value="" selected>Choose...</option>
          @for($i=1; $i < 14; $i++)
            <option value="{{$i}}">Year {{$i}}</option> 
          @endfor
        </select>
      @endsection

      @section('tags')
        @component('components.tagpicker', ['tagtypes' => $tagtypes, ])   
        @endcomponent
      @endsection

      @section('usertags')
        @component('components.tagpicker', ['tags' => $usertags, 'tagname' => "usertags[]" ])
        @endcomponent
      @endsection

      @section('parents')
        <input type="text" class="form-control" id="parents" placeholder="Mr and Mrs Smith" name="parents">
      @endsection

      @section('school')
        <input type="text" class="form-control" id="school" placeholder="Mt Roskill Primary" name="school">
      @endsection

      @section('baptism')
        @component('components.timepicker', ['pickername'=>'baptism'])
        @endcomponent
      @endsection

      @section('dob')
        @component('components.timepicker', ['pickername'=>'dob'])
        @endcomponent
      @endsection

      @section('notes')
        <textarea class="form-control w-100" type="text" name="notes" id="notes" rows=5 placeholder="Notes"></textarea>
      @endsection

      @section('buttons')
        <button class="col-md-6 btn btn-primary btn-lg btn-round" type="submit">Save</button>
      @endsection

    @endcomponent
  </div>
</div>
@endsection


@section('footer')

<script src="{{ asset('js/peoplepicker.js') }}?5"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.25.3/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />

<script type="text/javascript">
$(document).ready( function() {

    $('.date').datetimepicker({
    format: "DD-MM-YYYY",
    debug: true,
    } );
});

</script>

@endsection