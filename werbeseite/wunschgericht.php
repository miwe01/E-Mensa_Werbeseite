<?php
function is_temp_mail($mail) {
    $mail_domains_ko = array('rcpt.at','damnthespam.at','wegwerfmail.de');

    foreach($mail_domains_ko as $ko_mail) {
        list($mail_domain) = explode('@',$mail);
        if(stripos($mail_domain, $ko_mail) == true){
            return true;
        }
    }
    if(preg_match('/trashmail./',$mail) == 1){
        return true;
    }
    return false;
}

    if (isset($_POST['submit'])) {
        $fehleingabe=false;

        $email = filter_var($_POST['mail'],FILTER_VALIDATE_EMAIL);
        if (empty($_POST['name']))
            $name = 'anonym';
        else $name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
        $wunsch = filter_var($_POST['wunsch'],FILTER_SANITIZE_STRING);
        $beschreibung = filter_var($_POST['beschreibung'],FILTER_SANITIZE_STRING);
        list($mailname, $domain) = explode('@',$email);

        if (is_temp_mail($email)) {
            echo "Wegwerf-Mailadressen werden nicht akzeptiert.";
            $fehleingabe=true;
        }
        if(stripos($domain, ".") == false) {
            echo "Mail Adresse benötigt Top Level Domain";
            $fehleingabe=true;
        }
        if (preg_match('/[\' ‎^£$%&*()}{@#~?><,|=_+¬]/', $name)) {
            echo "Ungültige Eingabe bei: Vorname.";
            $fehleingabe=true;
        }
        if (preg_match('/[\' ‎^£$%&*()}{@#~?><,|=_+¬]/', $wunsch)) {
            echo "Ungültige Eingabe bei: Wunschname.";
            $fehleingabe=true;
        }

        if (!$fehleingabe) {

            $link = mysqli_connect("localhost", // Host der Datenbank
                "root",                 // Benutzername zur Anmeldung
                "",    // Passwort
                "emensawerbeseite",     // Auswahl der Datenbanken (bzw. des Schemas)
                3306// optional port der Datenbank
            );

            $name = mysqli_real_escape_string($link, $name);
            $email = mysqli_real_escape_string($link, $email);
            $wunsch = mysqli_real_escape_string($link, $wunsch);
            $beschreibung = mysqli_real_escape_string($link, $beschreibung);

            if (!$link) {
                echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
                exit();
            }

            $querybenutzerid = "SELECT benutzerid from ersteller WHERE '$name' = name AND '$email' = email";
            $result = mysqli_query($link, $querybenutzerid);
            if (!$result) {
                echo "Fehler.";
                exit();
            }

            $row = mysqli_fetch_assoc($result);
            if (empty($row)) {
                $queryersteller = "INSERT INTO ersteller (name, email) VALUES ('$name', '$email')";
                $result = mysqli_query($link, $queryersteller);
                if (!$result) {
                    echo "Fehler.";
                    exit();
                }

                $result = mysqli_query($link, $querybenutzerid);
                if (!$result) {
                    echo "Fehler.";
                    exit();
                }
                $row = mysqli_fetch_assoc($result);
            }
            $benutzerid = $row['benutzerid'];

            $querywunsch = "INSERT INTO wunschgericht (name, beschreibung, benutzerid) VALUES ('$wunsch', '$beschreibung', '$benutzerid')";
            $result = mysqli_query($link, $querywunsch);
            if (!$result) {
                echo "Fehler.";
                exit();
            }
            header('Location: index.php');


            mysqli_free_result($result);
            mysqli_close($link);
        }
    }
?>
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
<form method="post" id="wunsch">
    <fieldset>
        <legend>Wunschgericht</legend>
        <label for="name">Name</label>
        <br>
        <input type="text" id="name" name="name">
        <br><br>
        <label for="mail">E-Mail*</label>
        <br>
        <input type="email" id="mail" name="mail" required>
        <br><br>
        <label for="wunschgericht">Name des Wunschgerichts*</label>
        <br>
        <input type="text" id="wunschgericht" name="wunsch" required>
        <br><br>
        <label for="beschreibung">Beschreibung</label>
        <br>
        <textarea id="beschreibung" name="beschreibung" rows="4" cols="50" form="wunsch" placeholder="Hinweise für Zubereitung, etc."></textarea>
        <br><br>
        <input type="submit" title="Abschicken" name="submit">
        <br><br>
        *)Eingaben sind Pflicht
        <br>
    </fieldset>
</form>
</body>
</html>
