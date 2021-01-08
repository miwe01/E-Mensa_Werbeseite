<?php
if(session_id() == '' || !isset($_SESSION)) {
    session_start();
}
function checkUser($email, $passwort){
    // Zeitzone auswählen und Zeit erstellen
    date_default_timezone_set('Europe/Berlin');
    $datetime = date('Y-m-d H:i:s');

    $salt = "dbwt";
    $link = connectdb();
    // prevent sql injection
    $email = mysqli_real_escape_string($link, $email);

    // transaktion beginnen
    mysqli_begin_transaction($link);
    try{
        $pw = "SELECT passwort FROM benutzer
                     WHERE email = '$email'";
        $result = mysqli_query($link, $pw);
        // wenn passwort gefunden
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // nimmt sich nur Passwort
            $pw = $row["passwort"];

            // Wenn Passwort richtig
            if(password_verify($passwort.$salt, $pw)){
                // letzte Anmeldung +1
                $anmeldung = "UPDATE benutzer SET letzteanmeldung = '$datetime'
                              WHERE email = '$email'";
                if (mysqli_query($link, $anmeldung)){
                    // wenn alles geht ohne DB Probleme etc... -> commit
                    mysqli_commit($link);
                    return true;
                }
            // Wenn Passwort falsch
            } else{
                $letzterFehler = "UPDATE benutzer SET letzterfehler= '$datetime'
                         WHERE email = '$email'";
                if(mysqli_query($link, $letzterFehler)){
                    mysqli_commit($link);
                    return false;
                }
            }
        }
        $_SESSION["fehler_email"] = "Email falsch";
        // Benutzer gibt es nicht in Tabelle Benutzer
        return false;
    // Wenn Fehler bei Sql Statement alles rollbacken
    } catch(mysqli_sql_exception $exception){
        mysqli_rollback($link);
        return false;
    }
}


function anmeldungIncrement($email) {
    $link = connectdb();
    $email = mysqli_real_escape_string($link, $email);
    $sql = "SELECT id FROM benutzer WHERE email='$email'";
    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // nimmt sich nur Passwort
        $id = $row["id"];


        /*$sql = "UPDATE benutzer
                SET anzahlanmeldungen = anzahlanmeldungen +1
                WHERE email = '$email'";
        $result = mysqli_query($link, $sql);*/
        mysqli_query($link, "CALL anmeldungIncrement('$id')");

        mysqli_close($link);
    }
}
?>