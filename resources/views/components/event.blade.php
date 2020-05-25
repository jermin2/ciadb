<div class="card">
  <div class="card-header">
    <h2 class="card-title">{{$title ?? ""}}</h2>
  </div>

  <div class="card-body">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
      {{$event_content_header}}
          
        <div class="row">
          <div class="input-group col-md-6 mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" for="name">Name</span>
            </div>
            {{$name}}
          </div>

          <div class="input-group col-md-6  mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" for="time">Time</span>
            </div>
            {{$time}}
          </div>
        </div>

        <div class="row">
          <div class="input-group col-md-6 mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" for="location">Location</span>
            </div>
            {{$location}}
          </div>

          <div class="input-group col-md-6 mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" for="author">Author</span>
            </div>
            {{$author}}
          </div>
        </div>

        <div class="row">
          <div class="input-group col-md-6 mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" for="tags">Tags</span>
            </div>
            {{$tags}}
          </div>

          <div class="input-group col-md-6 mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" for="usertags">User tags</span>
            </div>
            {{$usertags}}
          </div>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend ">
              {{$attendee_button}}
            </div>
            <div id="people" class="form-control d-flex flex-wrap h-auto">
            {{$attendees}}
            </div>
        </div>

        <div class="input-group  mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" for="usertags">Make notes private</span>
            </div>
            {{$private}}
        </div>     

        <div class="input-group  mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" for="usertags">Notes</span>
            </div>
            {{$notes}}
        </div>
        
        <hr class="mb-4">
        {{$content_footer ?? ""}}

        <div class="row">
          {{$buttons}}
        </div>
      </form>


    </div>
</div>