<style>
    table, td, th {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>
<?php
$link = mysqli_connect("localhost", // Host der Datenbank
    "root",                 // Benutzername zur Anmeldung
    "",    // Passwort
    "emensawerbeseite",     // Auswahl der Datenbanken (bzw. des Schemas)
    3306// optional port der Datenbank
);

if (!$link) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}

$sql = "SELECT name AS 'gerichtsname', erfasst_am FROM gericht ORDER BY gerichtsname asc";

$result = mysqli_query($link, $sql);
if (!$result) {
    echo "Fehler während der Abfrage:  ", mysqli_error($link);
    exit();
}
echo '<table><tr><th>Gerichtsname</th><th>Erfassungsdatum</th></tr>';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr><td>'.$row['gerichtsname'].'</td><td>'.$row['erfasst_am']. '</td></tr>';
}
echo '</table>';

mysqli_free_result($result);
mysqli_close($link);