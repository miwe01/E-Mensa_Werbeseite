<!DOCTYPE html>
<html>
<head>
    <title>m4 6b</title>
</head>
<body>
<ul>
    @if(empty($gerichte))
        Es sind keine Gerichte vorhanden
    @else
    @foreach($gerichte as $gericht)
        <li> {{$gericht["name"]. ", " .  $gericht["preis_intern"]. "€"}} </li>
    @endforeach
    @endif
</ul>
</body>
</html>
