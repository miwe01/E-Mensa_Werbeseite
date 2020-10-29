<style>
    tr{
        background-color: blue;
    }
    .test{
        width: 50%;
    }
</style>
<?php

$file_bilder = fopen('v_gerichte.txt', 'r');

if(!$file_bilder)
    die("Unable to open");

echo '<table>';

while(!feof($file_bilder)) {
    $pfad = 'img/';
    $line = fgets($file_bilder, 1024);
    echo '<tr><td><img class="test" src="' . $pfad . $line . '" alt="gericht" width="100px" height="100px"> </td></tr>';
}
echo'</table>';
fclose($file_bilder);

?>