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
<h1>Meine Bewertungen (<?php echo $_SESSION['email']?>)</h1>

<?php

    $link = mysqli_connect("localhost", // Host der Datenbank
        "root",                // Benutzername zur Anmeldung
        "test..123",    // Passwort
        "emensawerbeseite",     // Auswahl der Datenbanken (bzw. des Schemas)
        3306// optional port der Datenbank
    );
    $email = mysqli_real_escape_string($link, $_SESSION['email']);
    $sql = "SELECT id FROM benutzer WHERE email = '$email'";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo "Error";
        exit();
    }
    $row = mysqli_fetch_assoc($result);
    $benutzerID = $row['id'];

    $sql = "SELECT g.id as gerichtid, b.id as benutzerid, g.name as gerichtname, Sternbewertung, Bemerkung, Hervorgehoben
            FROM benutzer_bewertet_gericht bbg
            INNER JOIN benutzer b
            ON IDBenutzer = b.id
            INNER JOIN gericht g
            ON IDGericht = g.id
            WHERE b.id = '$benutzerID'
            ORDER BY Hervorgehoben DESC, Bewertungszeitpunkt DESC";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo "Error";
        exit();
    }
    echo "<table><tr> <th>Email</th><th>Bewertung</th><th>Bemerkung</th><th>Löschen</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['Hervorgehoben'] == 1){
            echo '<tr><td><b>' . $row['gerichtname'] . '</b></td><td><b>' . $row['Sternbewertung'] . ' Sterne</b></td><td><b>' .
                $row['Bemerkung'] . '</b></td>';

            /* Lösch vorgang */
            echo '<td>
                        <b><a href="/meinebewertungen?gid=' . $row['gerichtid'] .'&bid='. $row['benutzerid']
                    .'&stern=' . $row['Sternbewertung'] .'&bemerkung=' . $row['Bemerkung'] . ' ">
                    Löschen
                    </a></b>
                </td>
                </tr>';
            /* */
        }
        else{
            echo '<tr><td>' . $row['gerichtname'] . '</td><td>' . $row['Sternbewertung'] . ' Sterne</td><td>' .
                $row['Bemerkung'] . '</td>';

            /* Lösch vorgang */
            echo '<td>
                    <b><a href="/meinebewertungen?gid=' . $row['gerichtid'] .'&bid='. $row['benutzerid']
                .'&stern=' . $row['Sternbewertung'] .'&bemerkung=' . $row['Bemerkung'] . ' ">
                    Löschen
                    </a></b>
                </td>
                </tr>';
            /* */
        }

    }
    echo "</table>";

    mysqli_close($link);

?>
<a href="/">Zurück</a>
</body>
</html>