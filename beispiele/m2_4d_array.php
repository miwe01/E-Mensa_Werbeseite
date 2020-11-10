<?php
/**
 * Praktikum DBWT. Autoren:
 * Mika, Weber, 3252173
 * Ben, Loos, 3207009
 */
echo 'a)<br>';
$famousMeal = [
    1 => ['name' => 'Currywurst mit Pommes',
        'winner' => [2001, 2003, 2007, 2010, 2020]],
    2 => ['name' => 'Hähnchencrossies mit Paprikareis',
        'winner' => [2002, 2004, 2008]],
    3 => ['name' => 'Spaghetti Bolognese',
        'winner' => [2011, 2012, 2017]],
    4 => ['name' => 'Jägerschnitzel mit Pommes',
        'winner' => 2019]
];
$counter = 1;
foreach($famousMeal as $key=>$value){
    // print_r($value);

    echo  $counter . ". <span style='margin-left: 8px'>". $value['name'] . "</span>";
    // print_r($value['winner']);
    //echo count($value['winner']);

    //echo $value['winner'][0];
    if (is_array($value['winner']))
    {
        echo "<p style='margin: 0 0 3px 25px'>";
        for ($i=count($value['winner'])-1;$i>=0;$i--){
            echo "". $value['winner'][$i] . "";
            if ($i != 0)
                echo ', ';

        }
        echo "</p><br>";
    }
    else{
        echo "<p style='margin: 0 0 10px 25px'>" . $value['winner'] . '</p>';
    }

    $counter++;
}

// b)
echo '<hr>b)<br>';

nowinner($famousMeal);

function nowinner($meals){
    $fehlendesjahr = false;


    for($i=2001;$i<2021;$i++){
        foreach($meals as $key=>$value){

            if(is_array($value['winner'])) {
                for ($j = 0; $j < count($value['winner']); $j++) {
                    if ($value['winner'][$j] == $i)
                        $fehlendesjahr = true;
                }
            }
            else{
                if ($value['winner'] == $i)
                    $fehlendesjahr = true;
            }
        }

        if (!$fehlendesjahr) {
            echo 'Das Jahr ' . $i . ' fehlt <br>';
        }
        $fehlendesjahr = false;

    }
}


?>