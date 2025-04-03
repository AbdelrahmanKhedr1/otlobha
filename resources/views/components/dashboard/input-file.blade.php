@props([
    'label'=>null,
    'name',
    'value' =>null,
    'class' =>null,
    'accept' => 'image',
    'multiple' => false ,

])
<div class="form-group {{$class}}" >
    <label style="font-weight: bold;">{{$label}}</label>
    <input type="file" name="{{$name}}"  accept="{{$accept}}/*" multiple="{{$multiple}}" style="background: #f4f4f4; color: black;"  class="form-control" >
</div>
@error($name)
    <div class="text-danger">
        <p>{{ $message }}</p>
    </div>
@enderror
