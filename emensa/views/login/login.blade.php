<!DOCTYPE html>
<!--
- Praktikum DBWT. Autoren:
- Mika, Weber, 3252173
- Ben, Loos, 3207009
-->
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Anmeldung</title>
</head>
<body>

<form method="post" id="wunsch" action="/anmeldung_verfizieren">
    @csrf
    <fieldset>
        <legend>Anmeldung</legend>
        <label for="email">E-Mail*</label>
        <br>
        <input type="email" id="email" name="email"
               value="<?php if(isset($_POST['email']))
                echo htmlentities($_POST['email']);?>"
               class= @if(!empty($Email))"fehler"@else "" @endif >
        <br><br>

        <label for="passwort">Passwort*</label>
        <br>
        <input type="password" id="passwort" name="passwort"
               value="<?php if(isset($_POST['passwort']))
                   echo htmlentities($_POST['passwort']);?>"
               class= @if(!empty($Passwort))"fehler"@else "" @endif >
        <br><br>
        <button type="submit">Anmeldung</button>
    </fieldset>
    <a href="/">Zurück zur Hauptseite</a>
</form>
</body>
</html>
