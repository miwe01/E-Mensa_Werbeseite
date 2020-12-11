<?php
// checkt ob session schon gibt
if(session_id() == '' || !isset($_SESSION)) {
    session_start();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Profil</title>
</head>
<body>
<style>
    table, td, th{
        border:1px solid black;
        border-collapse: collapse;
        margin-bottom: 10px;
    }
</style>

<h1>Hallo {{$_SESSION["name"]}}</h1>
<table>
    <tr><th>Email</th><th>Anzahl Anmeldungen</th><th>Adminkonto</th></tr>
    <tr>
    @foreach($Daten as $d)
        @if($d == '0')
                <td>Nein</td>
            @elseif($d=='1')
                <td>Ja</td>
            @else
            <td>{{$d}}</td>
            @endif
        @endforeach
    </tr>
</table>

<a href="/">Zurück</a>
</body>
</html>