@props([
    'label' => null,
    'options',
    'name',
    'selected' => null,
    'id' => null,
    'style' =>null,
])


<div class="form-group" style="{{$style}}" id="{{$id}}">
    <label for="category" style="font-weight: bold;">{{ $label }} </label>
    <select  style="background: #f4f4f4; color: black;" class="form-control @error($name) is-invalid @enderror"
        name="{{ $name }}">
        {{-- <option value="">{{ $label }}</option> --}}

        @foreach ($options as $option)
            <option value="{{ $option->id }}" @selected( $selected == $option->id)>
                {{ $option->name }}
            </option>
        @endforeach
        {{-- @foreach ($options as $value => $text)
            <option value="{{ $value }}" @selected($value == $selected)>{{ $text->name ?? $text }}</option>
        @endforeach --}}
    </select>
    @error($name)
        <div class="invalid-feedback">
            <p>{{ $message }}</p>
        </div>
    @enderror
</div>
