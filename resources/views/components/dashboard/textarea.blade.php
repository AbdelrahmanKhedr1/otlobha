@props([
    'label'=>null,
    'name',
    'value' =>null,
])

<div class="form-group">
    <label for="description" style="font-weight: bold;"> {{$label}} </label>
    <textarea style="background: #f4f4f4; color: black; min-height: 200px" class="form-control" name="{{$name}}" style="height:150px;" >{{$value}}</textarea>
</div>

@error($name)
    <div class="text-danger">
        <p>{{ $message }}</p>
    </div>
@enderror
