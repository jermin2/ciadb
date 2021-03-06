  @extends('layouts.main')
  
  @section('content')



  @can('show_people')
  <div class="col col-lg-12 col-md-12 col-sm-12 mx-auto">       
    @component('components.goals', ['goals'=>$user->goals])
      @slot('individual')
        <td>
          <select class="selectpicker form-control" name="person_id">
            @foreach($people as $u_person)
              <option value="{{$u_person->id}}">{{$u_person->name()}}</option>
            @endforeach
          </select>
        </td>
      @endslot
    @endcomponent
    </div>
    
  @endcan



  @can('view_events')
  <div class="col col-md-12 col-lg-12 mx-auto">
    @component('components.lastevents', ['events' => auth()->user()->lastTenEvents() ])
      @slot('title')
        Last Ten Events
      @endslot
    @endcomponent
  </div>
  @endcan

  @endsection

  @section('footer')

<script src="{{ asset('js/peoplepicker.js') }}?5"></script>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />

<script type="text/javascript">
$(function () {
    $('.date').datetimepicker({
      format: "DD-MM-YYYY",
      debug: true,
    } );
});
$(document).ready( function() {

    $('#date').datetimepicker();

    $('#goalTable').DataTable( { 
        orderCellsTop: true,
        dom: 'rt',
        autoWidth: true,
        responsive: true,
        columnDefs: [
          
          { responsivePriority: 1, targets: [0,-1]},
          { responsivePriority: 2, targets: 1},
          { width: "40px", targets: 5},
          { width: "110px", targets: [0, 2,3]},
          { width: "180px", targets: [1]},
        ]
    });

});

</script>

@endsection
