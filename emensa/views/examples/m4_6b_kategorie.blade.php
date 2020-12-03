<?php
?>
<html>
<head>
    <title>Demo: @yield('title')</title>
</head>
<body>
<table>
@foreach ($data as $object)
    <tr><td>{{ $object['name'] }}</td></tr>
@endforeach
</table>
</body>
</html>