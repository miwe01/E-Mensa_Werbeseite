<!DOCTYPE html>
<html>
<head>
    <title>m4 6b</title>
</head>
<style>
    li:nth-child(odd){
        font-weight: bold;
    }
</style>
<body>
<ul>
@foreach($kategorien as $kategorie)
        <li> {{$kategorie['name']}} </li>
@endforeach
</ul>
</body>
</html>
