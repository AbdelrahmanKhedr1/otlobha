@props([
    'type' =>'text',
    'label'=>null,
    'name',
    'value' =>null,
    'style' =>null,
    'id' =>null,
    'pattern' =>null,

])
<div id="{{$id}}" style="{{$style}}" class="form-group">
    <label style="font-weight: bold;">{{$label}}</label>
    <input type="{{$type}}" name="{{$name}}"   value="{{ old($name, $value) }}" style="background: #f4f4f4; color: black;"  class="form-control" >
</div>
@error($name)
    <div class="text-danger">
        <p>{{ $message }}</p>
    </div>
@enderror

