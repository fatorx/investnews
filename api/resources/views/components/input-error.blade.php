@props(['messages'])

@if ($messages)
    @foreach ((array) $messages as $message)
        <p class="text-danger mb-0">{{ $message }}</p>
    @endforeach
@endif
