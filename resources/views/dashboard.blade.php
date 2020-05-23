  @extends('layouts.main')
  
  @section('content')



  <div class="col col-lg-12 col-md-12 col-sm-12 mx-auto">
    <div class=" ">
            
    @component('components.goals', ['goals'=>$user->goals])
      @slot('individual')
        <td>
          <select class="selectpicker" name="person_id">
            @foreach($people as $u_person)
              <option value="{{$u_person->id}}">{{$u_person->name()}}</option>
            @endforeach
          </select>
        </td>
      @endslot
    @endcomponent
    </div>
  </div>




  <div class="row col-md-12 col-lg-12 mx-auto">
    <div class="card">
      <div class="card-header">
        <div class="card-title">
          <h2>Last 10 Events</h2>
        </div>
      </div>
      <div class="card-body">
        <table>
          <thead>
            <tr>
              <th>Date</th>
              <th>Event</th>
              <th>Notes</th>
              <th>Tags</th>
              <th>UserTags</th>
            </tr>
          </thead>
          @foreach($person->lastTenEvents() as $event)
            <tr>  
              <td><a href="{{ route('events.edit', $event->id) }}">{{$event->time}}</a></td>
              <td>{{$event->name}}</td>
              <td class="notes">{{$event->notes}}</td>
              <td>
                @foreach($event->tags as $tag)
                <a href="{{route('event-tag.show', $tag->id)}}"><span class="badge" style="color:#fff; background-color:{{$tag->color}}" >{{$tag->name}}</span> </a>
                @endforeach
              </td>
              <td>
                @foreach($event->usertags as $tag)
                <a href="{{route('event-tag.show', $tag->id)}}"><span class="badge" style="color:#fff; background-color:{{$tag->color}}" >{{$tag->name}}</span> </a>
                @endforeach
              </td>
            </tr>
            @endforeach
          <tbody>

          </tbody>
        </table>
      </div>


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
