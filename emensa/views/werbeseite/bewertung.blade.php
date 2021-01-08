<?php
// checkt ob session schon gibt
if(session_id() == '' || !isset($_SESSION)) {
    session_start();
}


?>

@if(isset($Fehler))
{{"Fehler<br>"}}
@endif
        <!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Bewertung</title>
        <style>
            body{
                margin-left: 20px;
            }
            table, td, th{
                border: 1px solid black;
                border-collapse: collapse;
                margin-bottom: 20px;
                text-align: left;
            }
            table{
                height: auto;
                width: 85%;
            }
            td, th{
                padding-left: 5px;
                height: 35px;
            }
        </style>
    </head>
<body>
    <h2>Bewertung des Gerichts</h2>
    <form action="/bewertung">

        <input type="radio" value="4" name="bewertung" checked="checked">Sehr gut<br>
        <input type="radio" value="3" name="bewertung">Gut<br>
        <input type="radio" value="2" name="bewertung">Schlecht<br>
        <input type="radio" value="1" name="bewertung">Sehr schlecht<br>
        <br>
        <input type="text" name="bemerkung" placeholder="Bemerkung" minlength="5" required>
        <input type="submit" value="Senden" name="senden">
    </form>

    <h2>Bewertungen</h2>
    <?php
    // gibt Bewertungen von allen Benutzern zurück
    //
    if (isset($_SESSION["gerichtid"])){
        $link = mysqli_connect("localhost", // Host der Datenbank
            "root",                 // Benutzername zur Anmeldung
            "test..123",    // Passwort
            "emensawerbeseite",     // Auswahl der Datenbanken (bzw. des Schemas)
            3306// optional port der Datenbank
        );
        // 6)
        $id = mysqli_real_escape_string($link, $_SESSION["gerichtid"]);
        $sql = "SELECT b.email, Sternbewertung, Bemerkung, Hervorgehoben
                FROM benutzer_bewertet_gericht bbg
                INNER JOIN benutzer b
                ON IDBenutzer = b.id
                INNER JOIN gericht g
                ON IDGericht = g.id
                WHERE g.id = '$id'
                ORDER BY Hervorgehoben DESC, Bewertungszeitpunkt DESC
                LIMIT 30
                ";
        $result = mysqli_query($link, $sql);
        if (!$result) {
            echo "Error";
            exit();
        }
        if(mysqli_num_rows($result) == 0){
            echo "Es gibt noch keine Bewertungen<br><br>";
        }else{
            echo "<table><tr> <th>Email</th><th>Bewertung</th><th>Bemerkung</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['Hervorgehoben'] == 1){
                    echo '<tr><td><b>' . $row['email'] . '</b></td><td><b>' . $row['Sternbewertung'] . ' Sterne</b></td><td><b>' .
                        $row['Bemerkung'] . '</b></tr>';
                }
                else{
                    echo '<tr><td>' . $row['email'] . '</td><td>' . $row['Sternbewertung'] . ' Sterne</td><td>' .
                        $row['Bemerkung'] . '</tr>';
                }

            }
            echo "</table>";
        }
        mysqli_close($link);
    }
    ?>
    <a href="/">Zurück</a>
</body>
</html>