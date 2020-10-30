<?php
/**
 * Praktikum DBWT. Autoren:
 * Mika, Weber, 3252173
 * Ben, Loos, 3207009
 */
include_once("m2_4a_standardparameter.php");
    if (isset($_GET["addieren"])){
        if (is_numeric($_GET["ersteZahl"]) && is_numeric($_GET["zweiteZahl"])){
            echo addieren($_GET["ersteZahl"], $_GET["zweiteZahl"]). '<br>';
        }
        else{
            echo 'Error! Keine Zahlen' . '<br>';
        }
    }

    if (isset($_GET["multiplizieren"])){
        if (is_numeric($_GET["ersteZahl"]) && is_numeric($_GET["zweiteZahl"])){
            $produkt = 0;
            $ersteZahl = $_GET["ersteZahl"];
            $zweiteZahl = $_GET["zweiteZahl"];

            for($i=$ersteZahl; $i>0; $i--){
                $produkt += addieren($zweiteZahl, 0);
            }
            echo $produkt . '<br>';
        }
        else{
            echo 'Error! Keine Zahlen' . '<br>';
        }
    }

?>

<form action="m2_4c_addform.php" method="get">
    <label for="ersteZahl">Erste Zahl:<input type="text" placeholder="Erste Zahl" name="ersteZahl"> </label><br>
    <label for="zweiteZahl">Zweite Zahl:<input type="text" placeholder="Zweite Zahl" name="zweiteZahl"></label><br>
    <input type="submit" value="Senden" name="addieren"> <input type="submit" value="Senden" name="multiplizieren">
</form>
