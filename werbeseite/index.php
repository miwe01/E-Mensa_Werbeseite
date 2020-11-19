<?php
session_start();
$_SESSION['besuche']++;

?>
<!DOCTYPE html>
<!--
- Praktikum DBWT. Autoren:
- Mika, Weber, 3252173
- Ben, Loos, 3207009
-->
<html lang="de">
<head>
  <meta charset="utf-8">
  <title>Ihre E-Mensa</title>
  <link rel="stylesheet" href="index.css">
</head>
<body>
  <!-- start header -->
  <header>
    <img src="https://via.placeholder.com/100x30" alt="Mensa Logo">
    <!-- start navigation -->
    <nav>
      <ul id="ul-nav">
        <li><a href="#ankuendigung">Ankündigung</a></li>
        <li><a href="#speisen">Speisen</a></li>
        <li><a href="#zahlen">Zahlen</a></li>
        <li><a href="#newsletter">Kontakt</a></li>
        <li><a href="#wichtig">Wichtig für uns</a></li>
        <li><a href="#">Impressum</a></li>
      </ul>
    </nav>
    <!-- end navigation -->
  </header>
  <!-- end header -->

  <!-- start mensa -->
  <section id="mensa-section">
    <h1>Ihre E-Mensa in Aachen</h1>
    <!-- maybe slideshow -->
    <img src="https://via.placeholder.com/800x250" alt="Bild von Mensa" id="mensa">

    <!-- ankuendigung -->
    <h2 id="ankuendigung">Bald gibt es Essen auch online</h2>
    <p id="ankuendigung-text">
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, <span class="ankuendigung-span">quis nostrud exercitation</span> ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. <span class="ankuendigung-span">Excepteur sint occaecat cupidatat</span> non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
    <!-- end ankuendigung -->
  </section>
  <!-- end mensa -->

  <!-- start speise -->
  <div id="speise-wrapper">
    <div id="speisekarte">
      <h2 id="speisen">Köstlichkeiten, die Sie erwarten</h2>
      <h3>Nicht vegetarische Speisen</h3>
      <!-- nicht vegetarische Karte -->
      <table class="speisen-table">
        <tr>
          <th class="speisen-td-th speisen-th">Speise</th>
            <th class="speisen-td-th speisen-th">Bild</th>
          <th class="speisen-td-th speisen-th">Preis intern</th>
          <th class="speisen-td-th speisen-th">Preis extern</th>
        </tr>
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

          $sql = "SELECT gericht.name,  Group_Concat(allergen.code) AS 'Allergen', gericht.preis_intern, gericht.preis_extern
FROM gericht
LEFT JOIN gericht_hat_allergen
ON gericht.id = gericht_hat_allergen.gericht_id
LEFT JOIN allergen
ON gericht_hat_allergen.code = allergen.code
GROUP BY gericht.name LIMIT 5;";

          /*$result = mysqli_query($link, $sql);
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
          mysqli_close($link);*/
          ?>
      </table>
      <!-- karte ende -->
      <!-- vegetarische Karte -->
      <h3>Vegetarische Speisen</h3>
      <table class="speisen-table">
        <tr>
          <th class="speisen-td-th speisen-th">Speise</th>
            <th class="speisen-td-th speisen-th">Bild</th>
          <th class="speisen-td-th speisen-th">Preis intern</th>
          <th class="speisen-td-th speisen-th">Preis extern</th>
        </tr>
          <!--SELECT gericht.name, Group_Concat(allergen.code) AS "Allergen", gericht.preis_intern, gericht.preis_extern
          FROM gericht
          LEFT JOIN gericht_hat_allergen
          ON gericht.id = gericht_hat_allergen.gericht_id
          LEFT JOIN allergen
          ON gericht_hat_allergen.code = allergen.code
          WHERE gericht.vegetarisch = 1
          GROUP BY gericht.name LIMIT 5;-->
      </table>
        <!-- karte ende -->
        <!-- Liste der Allergene -->
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

        $sql = "SELECT code, name AS 'allergenname' FROM allergen";

        $result = mysqli_query($link, $sql);
        if (!$result) {
            echo "Fehler während der Abfrage:  ", mysqli_error($link);
            exit();
        }
        echo '<table><tr><th>Allergen</th><th>Code</th></tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr><td>'.$row['allergenname'].'</td><td>'.$row['code']. '</td></tr>';
        }
        echo '</table>';

        mysqli_free_result($result);
        mysqli_close($link);
        ?>
      <!-- karte ende -->
    </div>
  </div>
  <!-- end speise -->

    <!-- start Zahlen -->
    <?php
    $anzahlspeisen = 0;
    $file = fopen('gerichte.txt', 'r');

    if(!$file)
        die("Unable to open");

    while(!feof($file)) {
        $pfad = 'img/';
        $anzahlspeisen++;
        $line = fgets($file, 1024);
    }
    fclose($file);
    $file = fopen('data.txt', 'r');
    $anzahlanmeldungen = 0;
    if(!$file)
        die("Unable to open");


    while(!feof($file)) {
        $anzahlanmeldungen++;
        $line = fgets($file, 1024);
    }
    fclose($file);
        $zahlen = [
            'besuche' => $_SESSION['besuche'],
            'anmeldungen' => $anzahlanmeldungen,
            'speisen' => $anzahlspeisen
        ]
    ?>
    <section id="zahlen-section">
      <h2 id="zahlen">E-Mensa in Zahlen</h2>
      <p id="zahlen-text">Dieses Jahr hat die E-Mensa folgende Zahlen erreicht:</p>
      <!-- start stats -->
      <div id="stats">
        <div class="container">
          <div class="zahl-container">
            <span class="span-zahlen"><?php echo $zahlen['besuche'] ?></span>
          </div>
          <p class="zahlen-p">Besuche jeden Tag</p>
        </div>

        <div class="container">
          <div class="zahl-container">
            <span class="span-zahlen"><?php echo $zahlen['anmeldungen'] ?></span>
          </div>
          <p class="zahlen-p">Anmeldungen für Newsletter</p>
        </div>

        <div class="container">
          <div class="zahl-container">
            <span class="span-zahlen"><?php echo $zahlen['speisen'] ?></span>
          </div>
          <p class="zahlen-p">Servierte Speisen</p>
        </div>
      </div>
      <!-- end stats -->

      <!-- start wichtig -->
      <h2 id="wichtig">Das ist uns wichtig!</h2>
      <ul id="wichtig-ul">
        <li class="wichtig-li">- Schnelligkeit</li>
        <li class="wichtig-li">- Qualität</li>
        <li class="wichtig-li">- Zufriedenheit</li>
      </ul>
      <!--end wichtig  -->
    </section>
      <!-- end Zahlen -->

  <!-- start Newsletter -->
  <div id="newsletter-wrapper">
    <form class="form-Newsletter" action="index.php#newsletter-wrapper" method="post">
      <h2 id="newsletter">Newsletter</h2>
      <table>
        <!-- erste Reihe -->
        <tr>
          <td>
            <label for="nachname">Nachname:</label>
          </td>
          <td>
            <label for="vorname">Vorname:</label>
          </td>
        </tr>
        <!-- zweite Reihe -->
        <tr>
          <td>
            <input type="text" id="nachname" name="nachname" required>
          </td>
          <td>
            <input type="text" id="vorname" name="vorname" required>
          </td>
        </tr>
        <!-- dritte Reihe -->
          <tr>
              <td>
                  <label for="email">Email:</label>
              </td>
              <td></td>
          </tr>

          <!-- vierte Reihe -->
          <tr>
              <td colspan="2">
                  <input type="email" name="email" id="email" required>
              </td>
          </tr>


        <!-- vierte Reihe -->
        <tr>
          <td><label for="sprache">Sprache:</label></td>
          <td></td>
        </tr>
        <!-- fünfte Reihe -->
        <tr>
          <td colspan="2">
            <select id="sprache" name="sprache">
              <option>Deutsch</option>
              <option>Englisch</option>
            </select>
          </td>
        </tr>
        <!-- sechste Reihe -->
        <tr>
          <td><label for="check"><span class="newsletter-checkbox"><input type="checkbox" id="check" name="check" required> AGBs akzeptieren</span></label></td><td></td>
        </tr>
        <!--siebte Reihe -->
        <tr>
          <td>
            <input type="submit" value="Bestätigen" name="bestaetigen">
            <input type="reset" value="Reset" name="reset">
          </td>
          <td>
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

              if(isset($_POST['check']) && isset($_POST['bestaetigen'])) {
                  $newsFile = fopen('data.txt','a');

                  if (!$newsFile)
                      die("Unable to open");

                  $sprache = $_POST['sprache'];
                  $nachname = filter_var($_POST['nachname'],FILTER_SANITIZE_STRING);
                  $vorname = filter_var($_POST['vorname'],FILTER_SANITIZE_STRING);
                  $email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
                  list($mail_domain) = explode('@',$email);
                  if(stripos($mail_domain, ".") == false)
                      echo "Mail Adresse benötigt Top Level Domain";
                  elseif (preg_match('/[\' ‎^£$%&*()}{@#~?><,|=_+¬-]/', $vorname))
                      echo "Ungültige Eingabe bei: Vorname.";
                  elseif (preg_match('/[\' ‎^£$%&*()}{@#~?><,|=_+¬-]/', $nachname))
                      echo "Ungültige Eingabe bei: Nachname.";
                  elseif (is_temp_mail($email))
                      echo "Wegwerf-Mailadressen werden nicht akzeptiert.";
                  else {
                      $newsData = "$nachname;$vorname;$email;$sprache\n";
                      fwrite($newsFile, $newsData);
                      fclose($newsFile);
                  }
                  $sprache = null;

              }
              ?>
          </td>
        </tr>
      </table>
    </form>
  </div>
  <!-- end Newsletter -->

  <!-- start footer -->
  <footer>
    <h2>Wir freuen uns auf ihren Besuch!</h2>
    <div id="footer-container">
      <div>&copy; E-Mensa</div>
      <div><span id="autor1">Mika Weber</span>,<span id="autor2"> Ben Loos</span></div>
      <div><a href="#">Impressum</a></div>
    </div>
  </footer>
  <!-- end footer -->

</body>
</html>
