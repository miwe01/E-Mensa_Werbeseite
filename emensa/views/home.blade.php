<!DOCTYPE html>
<html lang="de">
<head>
    <title>E-Mensa</title>
    <style type="text/css">
        body {background-color: {{$rd->query['bgcolor'] ?? 'ffffff'}} }
    </style>
</head>
<body>
    <header>
        <h1>Hauptseite E-Mensa</h1>
        <img src="./img/test.jpg" alt="Testbild von https://cdn.pixabay.com/photo/2014/06/03/19/38/road-sign-361513_960_720.jpg">
    </header>
    <nav>
        Navigation
        <ul>
            <li><a href="/demo/demo">Demo</a></li>
            <li><a href="/demo/dbconnect">Datenbank: Gerichte</a></li>
        </ul>
    </nav>
    <footer>
        &copy; Team-Name DBWT
    </footer>
</body>
</html>