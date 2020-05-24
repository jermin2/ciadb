<div class="card">
  <div class="card-header">
    <div class="card-title">
      <h2>{{$title}}</h2>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive-md">
    <table class="table table-hover table-sm">
      <thead>
        <tr>
          <th>Date</th>
          <th>Event</th>
          <th>Notes</th>
          <th>Tags</th>
          <th>UserTags</th>
        </tr>
      </thead>
      @foreach( $events as $event)
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