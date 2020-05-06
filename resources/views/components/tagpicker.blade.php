    @if(!isset($pickername) )
        <?php $pickername='tags' ?>
    @endif


    <select class="selectpicker" name="tags[]" id="{{$pickername}}" multiple >
    @foreach ($tagtypes as $tagtype)
        <optgroup label="{{ $tagtype->name }}">
        @foreach ($tagtype->tags as $tag)
            
            @isset($selectedTagList)
                <option value="{{ $tag->id }}"  @if($selectedTagList->contains($tag)) selected @endif  > <span class="badge badge-primary">{{$tag->name}}</span> </option>
            @else
                <option value="{{ $tag->id }}" class="tag" data-content='<span  class="badge badge-primary">{{$tag->name}}</span>'>{{$tag->name}} </option>
            @endisset
            

        @endforeach
        </optgroup>
    @endforeach
    </select>
