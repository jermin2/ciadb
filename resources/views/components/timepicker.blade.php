

<div class="form-group mb-0">
    <div class="input-group date" id="{{$pickername ?? 'datetimepicker1' }}" data-target-input="nearest">
        <div class="input-group-append" data-target="#{{$pickername ?? 'datetimepicker1' }}" data-toggle="datetimepicker">
            <input type="text" name="{{$pickername ?? 'time' }}" class="form-control datetimepicker-input" data-target="#datetimepicker1" value="{{$currentTime ?? ''}}"/> 
        </div>
    </div>
</div>

