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
          /**
           * Praktikum DBWT. Autoren:
           * Mika, Weber, 3252173
           * Ben, Loos, 3207009
           */

          $file = fopen('gerichte.txt', 'r');

          if(!$file)
              die("Unable to open");

          while(!feof($file)) {
              $pfad = 'img/';

              $line = fgets($file, 1024);
              $array = explode(';',$line);
              echo '<tr><td class="speisen-td-th speisen-td">' . $array[0] . '</td><td class="speisen-td-th speisen-td"> <img class="gericht-img" src="' . $pfad . $array[1] . '" alt="gericht"> </td>  <td class="speisen-td-th speisen-td">' . $array[2] . '</td><td class="speisen-td-th speisen-td">'. $array[3] .'</td></tr>';
          }
          fclose($file);

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
          <?php


          $file = fopen('v_gerichte.txt', 'r');

          if(!$file)
              die("Unable to open");

          while(!feof($file)) {
              $line = fgets($file, 1024);
              $array = explode(';',$line);
              echo '<tr><td class="speisen-td-th speisen-td">' . $array[0] . '</td><td class="speisen-td-th speisen-td"> <img class="gericht-img" src="' . $pfad . $array[1] . '" alt="gericht"> </td>  <td class="speisen-td-th speisen-td">' . $array[2] . '</td><td class="speisen-td-th speisen-td">'. $array[3] .'</td></tr>';
          }
          fclose($file);

          ?>
      </table>
      <!-- karte ende -->
    </div>
  </div>
  <!-- end speise -->

    <!-- start Zahlen -->
    <section id="zahlen-section">
      <h2 id="zahlen">E-Mensa in Zahlen</h2>
      <p id="zahlen-text">Dieses Jahr hat die E-Mensa folgende Zahlen erreicht:</p>
      <!-- start stats -->
      <div id="stats">
        <div class="container">
          <div class="zahl-container">
            <span class="span-zahlen">X</span>
          </div>
          <p class="zahlen-p">Besuche jeden Tag</p>
        </div>

        <div class="container">
          <div class="zahl-container">
            <span class="span-zahlen">Y</span>
          </div>
          <p class="zahlen-p">Anmeldungen für Newsletter</p>
        </div>

        <div class="container">
          <div class="zahl-container">
            <span class="span-zahlen">Z</span>
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
    <form class="form-Newsletter" action="index.php" method="post">
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
            <input type="text" id="vorname" name="vorname" required>
          </td>
          <td>
            <input type="text" id="nachname" name="nachname" required>
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
              <?php
              $newsletterDaten = ['newsNachname' => $_POST['nachname'],
                  'newsVorname' => $_POST['vorname'],
                  'newsEmail' => $_POST['email'],
                  'newsSprache' => $_POST['sprache']];

              if (isset($_POST['submit'])) {
                  $newsletterDaten[0] = FILTER_SANITIZE_STRING($newsletterDaten[0]);
                  $newsletterDaten[1] = FILTER_SANITIZE_STRING($newsletterDaten[1]);
                  if ($newsletterDaten[0] = null || $newsletterDaten[1] = null) {
                      die('Fehlende Daten.');
                  }
                  $newsletterDaten[2] = FILTER_SANITIZE_EMAIL($newsletterDaten[2]);
                  if(isset($_POST['check']) && isset($_POST['bestaetigen'])) {
                      $newsFile = fopen('./werbeseite/data.txt','w');
                      if (!newsFile)
                          die("Unable to open");

                      $newsData = "$newsletterDaten[0];$newsletterDaten[1];$newsletterDaten[2];$newsletterDaten[3]\n";
                      fwrite($newsFile,$newsData);

                      fclose($newsFile);
                  }
              }
              ?>
            <input type="reset" value="Reset" name="reset">
          </td>
          <td></td>
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
