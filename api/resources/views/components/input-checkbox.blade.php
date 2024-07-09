@props(['value', 'checked' => false])

<label>
    <input type="checkbox" {{ $checked ? 'checked' : '' }} {!! $attributes->merge(['class' => '']) !!}> {{$value ?? ''}}
</label>
