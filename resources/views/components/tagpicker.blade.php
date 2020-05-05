    @if(!isset($pickername) )
        <?php $pickername='tags' ?>
    @endif


    <select class="selectpicker" name="tags[]" id="{{$pickername}}" multiple >
        @foreach ($tags as $tag)

            @isset($selectedTagList)
                <option value="{{ $tag->id }}"  @if($selectedTagList->contains($tag)) selected @endif  > {{ $tag->name }} </option>
            @else
                <option value="{{ $tag->id }}"  > {{ $tag->name }} </option>
            @endisset

        @endforeach
    </select>
