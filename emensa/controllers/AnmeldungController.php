<?php
if(session_id() == '' || !isset($_SESSION)) {
    session_start();
}
require_once('../models/anmeldung.php');
class AnmeldungController{

    public function anmeldung(){
        return view('login.login',[]);
    }
    public function anmeldung_verfizieren(RequestData $rd){
        $email = "";
        $passwort = "";
        if (!empty($_POST["email"]) && !empty($_POST["passwort"])) {
            // Wenn Benutzer mit Passwort stimmt
            if(checkUser($_POST["email"], $_POST["passwort"])) {
                anmeldungIncrement($_POST["email"]);
                // speichert Email in Session
                $_SESSION["email"] = $_POST["email"];
                return view('werbeseite.layout', []);
            }
            $_SESSION["fehler_passwort"] = 'Email falsch';
        }
        if(isset($_SESSION["fehler_email"])){
            $email = 'Email falsch';
            unset($_SESSION["fehler_email"]);
        }
        if(isset($_SESSION["fehler_passwort"])){
            $passwort = 'Passwort falsch';
            unset($_SESSION["fehler_passwort"]);
        }



        // Wenn Email oder Passwort leer ->Fehler zurückgeben(border red)
        if ($_POST["email"] == "")
            $email = 'Email falsch';
        if ($_POST["passwort"] == "")
            $passwort = 'Passwort falsch';
        return view('login.login',['Email'=>$email, 'Passwort'=>$passwort]);
    }

    public function abmeldung(){
        session_destroy();
        return view('werbeseite.layout',[]);
    }

    public function profil(){
        if (!isset($_SESSION['email']))
            return view('werbeseite.layout', []);

        // Benutzerdaten
        $link = connectdb();
        $email = mysqli_real_escape_string($link, $_SESSION['email']);

        $sql = "SELECT email, anzahlanmeldungen, admin FROM benutzer WHERE email='$email' LIMIT 1";
        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            return view('werbeseite.meinProfil', ['Daten'=>$row]);
        }
        return view('werbeseite.layout', []);
    }

}
?>