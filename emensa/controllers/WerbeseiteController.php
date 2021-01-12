<?php

require_once("../models/BewertungClass.php");
require_once("../models/GerichtClass.php");

class WerbeseiteController
{
public function index(RequestData $rd){
    return view('werbeseite.layout', ['title' => 'Werbeseite']);
}

public function redirect(RequestData $rd){
    return view('werbeseite.wunschgericht', ['title' => "Wunschgericht"]);
}

// beim laden der Seite oder einfügen einer Bemerkung wird diese Route geladen
public function bewertung(RequestData $rd){
    // wenn nicht authentifiziert
    if (!isset($_SESSION["email"]))
        return view('login.login',[]);

    // session für gerichtid
    if (isset($_GET['gerichtid']))
        $_SESSION['gerichtid'] = $_GET['gerichtid'];

    // Verbindung aufbauen
    $link = mysqli_connect("localhost", // Host der Datenbank
        "root",                 // Benutzername zur Anmeldung
        "test..123",    // Passwort
        "emensawerbeseite",     // Auswahl der Datenbanken (bzw. des Schemas)
        3306// optional port der Datenbank
    );
    if (!$link) {
        echo "Error";
        exit();
    }
    //

    // einfügen einer Bewertung
    if (isset($_GET['senden'])){
        // wenn leer
        if ($_GET['bewertung'] == "" || $_GET['bemerkung'] == "")
              return view('werbeseite.bewertung', ['Fehler' => 'Fehler aufgetreten']);

        $bewertung = mysqli_real_escape_string($link, $_GET['bewertung']);
        $bemerkung = mysqli_real_escape_string($link, $_GET['bemerkung']);
        $email = mysqli_real_escape_string($link, $_SESSION['email']);
        $gerichtid = mysqli_real_escape_string($link, $_SESSION['gerichtid']);

        $sql = "SELECT id FROM benutzer WHERE email='$email'";
        $result = mysqli_query($link, $sql);
        if (!$result) {
            echo "Error";
            exit();
        }

        $row = mysqli_fetch_assoc($result);
        $benutzerID = $row['id'];

        $sql = "INSERT INTO benutzer_bewertet_gericht(IDBenutzer, IDGericht, Sternbewertung, Bemerkung, Hervorgehoben)
                VALUES ('$benutzerID','$gerichtid','$bewertung','$bemerkung', 0)";

        if (!mysqli_query($link, $sql)) {
            echo $benutzerID . ' ' . $gerichtid . ' ' . $bewertung . ' ' . $bemerkung;
            echo "Error";
            exit();
        }
//        return view('werbeseite.layout', []);
//        return view('werbeseite.bewertung', []);
    }

    // Gibt Gerichtname und passendes Bild auf Seite aus
        if (isset($_SESSION["gerichtid"])){
            $id = mysqli_real_escape_string($link, $_SESSION["gerichtid"]);
            /*
            $link = mysqli_connect("localhost", // Host der Datenbank
                "root",                 // Benutzername zur Anmeldung
                "test..123",    // Passwort
                "emensawerbeseite",     // Auswahl der Datenbanken (bzw. des Schemas)
                3306// optional port der Datenbank
            );

            $sql = "SELECT gericht.name, gericht.bildname FROM gericht WHERE gericht.id='$id'";
            $result = mysqli_query($link, $sql);
            if (!$result) {
                echo "Error";
                exit();
            }
            */

            $row = GerichtClass::find($id);

            //while ($row = mysqli_fetch_assoc($result)) {
                echo '<h1>' . $row->name . '</h1> <img src="/img/gerichte/'. $row->bildname . '" alt="' . $row->bildname . '" width="auto" height="300px">';
            //}

            //mysqli_free_result($result);
            //mysqli_close($link);
        }

        if (isset($_GET['highlight'])) {
            $bewertungid = mysqli_real_escape_string($link, $_GET['bewertungid']);

            $bewertung = BewertungClass::query()->find($bewertungid);
            $bewertung->Hervorgehoben = 1;
            $bewertung->timestamps = false;
            $bewertung->save();
        }

        if (isset($_GET['nothighlight'])) {
            $bewertungid = mysqli_real_escape_string($link, $_GET['bewertungid']);

            $bewertung = BewertungClass::query()->find($bewertungid);
            $bewertung->Hervorgehoben = 0;
            $bewertung->timestamps = false;
            $bewertung->save();
        }

    return view('werbeseite.bewertung', []);

}
public function meinebewertungen(RequestData $rd){
    // wenn nicht authentifiziert
    if (!isset($_SESSION["email"]))
        return view('login.login',[]);

    // Wenn Bewertung gelöscht werden soll
    if (isset($_GET['delete']) && isset($_GET['bewertungid'])){

        /*$link = mysqli_connect("localhost", // Host der Datenbank
            "root",                 // Benutzername zur Anmeldung
            "test..123",    // Passwort
            "emensawerbeseite",     // Auswahl der Datenbanken (bzw. des Schemas)
            3306// optional port der Datenbank
        );*/

        //$gid = mysqli_real_escape_string($link, $_GET["gid"]);
        //$bid = mysqli_real_escape_string($link, $_GET["bid"]);
        //$stern = mysqli_real_escape_string($link, $_GET["stern"]);
        //$bemerkung = mysqli_real_escape_string($link, $_GET["bemerkung"]);


        BewertungClass::destroy($_GET["bewertungid"]);


        /*$sql = "DELETE FROM benutzer_bewertet_gericht
        WHERE IDBenutzer='$bid' AND IDGericht='$gid' 
        AND Sternbewertung='$stern' AND Bemerkung='$bemerkung'";

        $result = mysqli_query($link, $sql);
        if (!$result) {
            echo $gid . ' '.  $bid . ' ' . $stern . ' ' . $bemerkung;
            echo "Fehler beim löschen aufgetreten";
            exit();
        }
*/
    }
    return view('werbeseite.meinebewertungen', []);
}

}

?>