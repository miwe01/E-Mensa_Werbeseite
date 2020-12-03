<?php
?>
<html>
<head>
    <title>Demo: @yield('title')</title>
</head>
<body>
<table>
    @if (empty($data))
        Es sind keine Gerichte vorhanden;
    @else
        @foreach ($data as $object)
            <tr><td>{{ $object['name'] }}</td><td>{{ $object['preis_intern'] }}</td></tr>
        @endforeach
    @endif
</table>
</body>
</html>