<!--
$tagname - tags is reserved, don't use this name for anything other than applying tags directly. i.e peoplepicker should assign this variable


-->


@if(!isset($pickername) )
        <?php $pickername='tags' ?>
    @endif


    <select class="selectpicker border" name="{{ $tagname ?? 'tags[]' }}" id="{{$pickername}}" title="Tag Filter" multiple >
    @foreach ($tagtypes as $tagtype)
        <optgroup label="{{ $tagtype->name }}">
        @foreach ($tagtype->tags as $tag)
            
            @isset($selectedTagList)
                <option value="{{ $tag->id }}"  data-content='<span class="badge" style="color:#fff; background-color:{{$tag->color}} >{{$tag->name}}</span>' @if($selectedTagList->contains($tag)) selected @endif  >{{$tag->name}}</span> </option>
            @else
                <option value="{{ $tag->id }}" class="tag" data-content='<span class="badge" style="color:#fff; background-color:{{$tag->color}}" >{{$tag->name}}</span>'>{{$tag->name}} </option>
            @endisset
            

        @endforeach
        </optgroup>
    @endforeach
    </select>


