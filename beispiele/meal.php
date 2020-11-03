<?php
const GET_PARAM_MIN_STARS = 'search_min_stars';
const GET_PARAM_SEARCH_TEXT = 'search_text';
const GET_PARAM_LANGUAGE = 'language';
const GET_PARAM_SHOW_DESCRIPTION = 'show_description';

/**
 * Liste aller möglichen Allergene.
 */
$allergens = array(
    11 => 'Gluten',
    12 => 'Krebstiere',
    13 => 'Eier',
    14 => 'Fisch',
    /*
     * 1)
    * "Parse error: syntax error, unexpected ';', expecting ')' in C:\Users\benlo\PhpstormProjects\E-Mensa_Werbeseite\beispiele\meal.php on line 14"
    * Klammer hinzugefügt
    */
    17 => 'Milch')
;

$meal = [ // Kurzschreibweise für ein Array (entspricht = array())
    'name' => 'Süßkartoffeltaschen mit Frischkäse und Kräutern gefüllt',
    'description' => 'Die Süßkartoffeln werden vorsichtig aufgeschnitten und der Frischkäse eingefüllt.',
    'price_intern' => 2.90,
    'price_extern' => 3.90,
    'allergens' => [11, 13],
    'amount' => 42   // Anzahl der verfügbaren Gerichte.
];

$ratings = [
    [   'text' => 'Die Kartoffel ist einfach klasse. Nur die Fischstäbchen schmecken nach Käse. ',
        'author' => 'Ute U.',
        'stars' => 2 ],
    [   'text' => 'Sehr gut. Immer wieder gerne',
        'author' => 'Gustav G.',
        'stars' => 4 ],
    [   'text' => 'Der Klassiker für den Wochenstart. Frisch wie immer',
        'author' => 'Renate R.',
        'stars' => 4 ],
    [   'text' => 'Kartoffel ist gut. Das Grüne ist mir suspekt.',
        'author' => 'Marta M.',
        'stars' => 3 ]
];

$words = [
    'meal' => ['de' => 'Gericht',
            'en' => 'Meal'],
    'external' => ['de' => 'Externer Preis',
            'en' => 'External price'],
    'internal' => ['de' => 'Interner Preis',
        'en' => 'Internal price'],
    'allergens' => ['de' => 'Allergene',
        'en' => 'Allergens'],
    'ratings' => ['de' => 'Bewertungen',
        'en' => 'Ratings'],
    'average' => ['de' => 'Insgesamt',
        'en' => 'Average'],
    'filter' => ['de' => 'Filter',
        'en' => 'Filter'],
    'search' => ['de' => 'Suchen',
        'en' => 'Search'],
    'text' => ['de' => 'Text',
        'en' => 'Text'],
    'author' => ['de' => 'Author',
        'en' => 'Author'],
    'stars' => ['de' => 'Sterne',
        'en' => 'Stars']
];

function setLanguage($word, $words) : void {
    if (isset($_GET[GET_PARAM_LANGUAGE])) {
        echo $words[$word][$_GET[GET_PARAM_LANGUAGE]];
    } else echo $words[$word]['de'];
}

$showRatings = [];
if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) {
    $searchTerm = $_GET[GET_PARAM_SEARCH_TEXT];
    foreach ($ratings as $rating) {
        /*
         * c)
         * stripos anstelle von strpos
         */
        if (stripos($rating['text'], $searchTerm) !== false) {
            $showRatings[] = $rating;
        }
    }
    /*
     * 1)
     * "Parse error: syntax error, unexpected 'if' (T_IF) in C:\Users\benlo\PhpstormProjects\E-Mensa_Werbeseite\beispiele\meal.php on line 51"
     * el if => elseif
     */
} elseif (!empty($_GET[GET_PARAM_MIN_STARS])) {
    $minStars = $_GET[GET_PARAM_MIN_STARS];
    foreach ($ratings as $rating) {
        if ($rating['stars'] >= $minStars) {
            $showRatings[] = $rating;
        }
    }
} else {
    $showRatings = $ratings;
}

function calcMeanStars($ratings) : float { // : float gibt an, dass der Rückgabewert vom Typ "float" ist
    /*
     * d)
     * $sum muss mit 0 inititalisiert werden anstelle von 1
     */
    $sum = 0;
    $i = 1;
    /*
     * 1)
     * "Parse error: syntax error, unexpected 'as' (T_AS), expecting ')' in C:\Users\benlo\PhpstormProjects\E-Mensa_Werbeseite\beispiele\meal.php on line 70"
     * foreah => foreach
     */
    foreach ($ratings as $rating) {
        /*
         * d)
         * "/ $i " darf nicht in der foreach schleife sein
         */
        $sum += $rating['stars'];
        $i++;
    }
    return $sum / count($ratings);
}

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <title>Gericht: <?php echo $meal['name']; ?></title>
    <style type="text/css">
        * {
            font-family: Arial, serif;
        }
        .rating {
            color: darkgray;
        }
    </style>
</head>
<body>
<h1><?php setLanguage('meal',$words); ?>: <?php
    echo $meal['name'];
    ?></h1>
<!-- h) -->
<p><?php setLanguage('external',$words); ?>: <?php
    echo number_format($meal['price_extern'],2);?>&euro;</p>
<p><?php setLanguage('internal',$words); ?>: <?php
    echo number_format($meal['price_intern'],2);?>&euro;</p>
<p><?php
    if (isset($_POST[GET_PARAM_SHOW_DESCRIPTION]) && $_POST[GET_PARAM_SHOW_DESCRIPTION] === true)
        echo $meal['description'];?></p>
<!-- b) -->
<label for="allergens"><?php setLanguage('allergens',$words); ?>: </label>
<ul id="allergens">
    <?php
    foreach ($meal["allergens"] as $allerg){
        echo "<li> $allergens[$allerg] </li>";
    }
    ?>
</ul>
<h1><?php setLanguage('ratings',$words);
?> (<?php setLanguage('average',$words); ?>: <?php echo calcMeanStars($ratings); ?>)</h1>
<form method="get">
    <label for="search_text"><?php setLanguage('filter',$words); ?>: </label>
    <!-- f) -->
    <input id="search_text" type="text" name="search_text" value="<?php if (isset($_GET[GET_PARAM_SEARCH_TEXT])) echo $_GET[GET_PARAM_SEARCH_TEXT]; ?>">
    <input type="submit" value=<?php setLanguage('search',$words); ?>>
</form>
<table class="rating">
    <thead>
    <tr>
        <td><?php setLanguage('text',$words); ?></td>
        <td><?php setLanguage('author',$words); ?></td>
        <td><?php setLanguage('stars',$words); ?></td>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($showRatings as $rating) {
        echo "<tr><td class='rating_text'>{$rating['text']}</td>
                      <!-- a) -->
                      <td class='rating_text'>{$rating['author']}</td> 
                      <td class='rating_stars'>{$rating['stars']}</td>
                </tr>";
    }
    ?>
    </tbody>
</table>
<form method="get">
    <input id="language" name="language" type="hidden">
</form>
<form method="get">
    <input id="show_description" name="show_description" type="hidden">
</form>
</body>
</html>