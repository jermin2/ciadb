<!--
    People Picker

    Requires $tag (for tagpicker), $people
    Optional $selectedpeople

    Requires the peoplepicker.js script to be included
    Depends on the tagpicker component

-->


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#peoplepickermodal">
  Attendees
</button>

<!-- Modal -->
<div class="modal fade" id="peoplepickermodal" tabindex="-1" role="dialog" aria-labelledby="peoplepickermodal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="peoplepickermodal">Done</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

        @component('components.tagpicker', ['tags' => $tags])
            @slot('pickername')
                peoplepicker_tag
            @endslot
        @endcomponent

        <input type="text" class="form-control" id="myInput" placeholder="Search for names..">
        <div id="people-list" class="list-group">
        @foreach ($people as $person)
            <li 

            @if(isset($selectedpeople) && $selectedpeople->contains($person))
                class="list-group-item list-group-item-action active"
            @else
                class="list-group-item list-group-item-action"
            @endif

            id="{{$person->id}}" 
            data-id="{{$person->id}}" 
            data-name="{{$person->first_name}} {{$person->last_name}}">
            {{$person->first_name}} {{$person->last_name}} 
                @foreach($person->tags as $tag)
                    {{$tag->name}}
                @endforeach
                </li>




        @endforeach
        </div>


    


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="modal-btn-save" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

