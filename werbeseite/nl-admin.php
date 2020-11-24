

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Email Tabelle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<style>
    /* general styling */
    *{
        font-family: sans-serif;
    }
    body{
        margin: 20px 20px;
    }
    /* */

    /* table styling */
    table, td, th{
        border: 1px solid black;
        border-collapse: collapse;
    }
    table{
        width: 50%;
        margin-bottom: 10px;
    }
    tr:nth-child(odd) {
        background-color: #dfe4ed;
        color: black;
        width: 40%;
    }
    tr:nth-child(even) {
        background-color: white;
        color: black;
        width: 40%;
    }
    th{
        padding: 4px;
        background-color: #00B5AD;
        color: white;
        font-size: 17px;
        text-align: left;
        font-weight: bold;
    }
    td:nth-child(3){
        width: 50%;
    }
    td{
        padding: 2px;
    }
    /* */

    /* form styling */
    button{
        margin-bottom: 10px;
    }
    /* */
</style>
<table>
        <?php
        // Konstante Datei (Konstante sind automatisch global)
        define("FILE", "data.txt");


        /* zeigt die 10 ersten Seiten an */
        $hit = 10;

        /* funktion um Datei zu öffnen */
        function openFile(){
            $file = fopen(FILE, 'r');
            if (!$file)
                die("Datei nicht gefunden");
            return $file;
        }

        // sortiert Tabelle nach "index" index 0 ist zB Vorname, index 2 email etc ...
        function sortTable($index){
           $file = openFile();


           /*
           darin wird Array aus Datei gespeiert
           $name ist ein assosiatives Array
           der Key ist der index Name. Bei Index 0 wäre der Key ein Vorname wie zB "Tom"
           die Value ist das Array der ganzen Reihe von der Datei zB [Tom,Taler,tom.taler@alumni.fh-aachen.de, Deutsch]
           */
            $name = array();
            $counter = 0;
            while(!feof($file)){
                $line = fgets($file, 1024);
                $array = explode(';',$line);
                // -1 wird benutzt um nach nichts zu sortieren
                // speichert das Array dann numerisch ab
                if ($index == -1)
                    $name[$counter] = $array;

                else
                    $name[$array[$index]] = $array;
                $counter++;
            }

            // Nur Schlüssel werden sortiert vom Array
            ksort($name);

            printTableHeader();
            $counter = 0;
            foreach($name as $key=>$value){
                // Nur 10 Einträge vom Array werden ausgegeben
                if($counter < $GLOBALS['hit'] && $counter > ($GLOBALS['hit'] -11)) {
                    echo '<tr>';
                    for ($i = 0; $i < count($value); $i++) {
                        echo '<td>'. $value[$i] . '</td>';
                    }
                    echo '</tr>';
                }
                $counter++;

            }

            fclose($file);
        }

        function printTableHeader(){
            echo '<th>Vorname</th><th>Nachname</th><th>Email</th><th>Sprache</th>';
        }




        // 3) Nach Namen sortieren
        if (isset($_GET["sortieren-name"]) && $_GET["sortieren-name"] == "asc"){

            sortTable(0);
        }
        // 3) Nach Email sortieren
        else if(isset($_GET["sortieren-email"]) && $_GET["sortieren-email"] == "asc"){
            $email = sortTable(2);
        }

        // 4) Namen filtern
        else if (isset($_GET["filter-name"]) && !empty($_GET["textfeld"])){
            $file = openFile();

            $name = [];

            // Nur Vorname und Nachname abspeichern
            while(!feof($file)){
                $line = fgets($file, 1024);
                $array = explode(';',$line);
                $name[$array[0]] = $array;
            }

            printTableHeader();

            // checkt ob Übereinstimmung. Wenn ja dann gib aus.
            foreach($name as $key=>$value){
                $checkVorname = stripos($key, $_GET["textfeld"]);
                $checkNachname = stripos($value[1], $_GET["textfeld"]);
                if (is_numeric($checkVorname) || is_numeric($checkNachname)){
                    echo '<tr>';
                    for ($i=0;$i<count($value);$i++)
                     echo '<td>' . $value[$i] . '</td>';
                    echo '</tr>';
                }
            }
        }
        // Erhöht Counter oder erniedrigt um 10 wenn Knopf gedrückt wurde
        else if(isset($_GET["counter"])){
            if ($_GET["counter"] == "plus")
                $GLOBALS['hit'] = 10 + $_GET['word'];
            else
                $GLOBALS['hit'] = $_GET['word'] -10;
            sortTable(-1);

        }


        // 2)
        else{
            sortTable(-1);
        }
        ?>
</table>
<form action="nl-admin.php" method="get">
    <button type="submit" value="asc" name="sortieren-name">Sortieren Name Aufsteigend <i class="fa fa-sort-alpha-asc"></i></button>
    <button type="submit" value="asc" name="sortieren-email">Sortieren Email Aufsteigend <i class="fa fa-sort-alpha-asc"></i></button><br>
    <button type="submit" value="plus" name="counter" id="reset">+10</button>
    <!-- button wird disabled wenn nur erste Einträge angezeigt werden -->
    <button type="submit" value="minus" name="counter" id="reset" <?php if ($GLOBALS['hit'] <= 10) echo 'disabled' ?> >-10</button><br>
    <!-- speichert hit in hidden input  -->
    <input type="hidden" name="word" value="<?php echo $GLOBALS['hit']; ?>" />
    <button type="submit" value="" name="sortieren-email" id="reset">Reset</button><br>
    <input type="text" name="textfeld" placeholder="Namen eingeben"> <button name="filter-name" type="submit">Namen filtern <i class="fa fa-search"></i></button>
</form>

</body>
</html>
