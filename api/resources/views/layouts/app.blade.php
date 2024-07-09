<!doctype html>
<html lang="en">

<head>
    @include('layouts.partials.header')
</head>

<body>
    @include('layouts.partials.navbar')
    {{ $slot }}
    @include('layouts.partials.footer')
    @stack('scripts')
</body>

</html>
