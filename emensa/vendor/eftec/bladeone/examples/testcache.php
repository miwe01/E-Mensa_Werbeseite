<?php /** @noinspection AutoloadingIssuesInspection */
/**
 * Copyright (c) 2016 Jorge Patricio Castro Castillo MIT License.
 */
include '../lib/BladeOne.php';

include '../lib/BladeOneCache.php';

use eftec\bladeone\BladeOne;
use eftec\bladeone\BladeOneCache;

$views = __DIR__ . '/views';
$compiledFolder = __DIR__ . '/compiled';

class myBladeCache extends BladeOne
{
    use BladeOneCache;
}

$blade=new myBladeCache($views, $compiledFolder);
define('BLADEONE_MODE', 0); // (optional) 1=forced (test),2=run fast (production), 0=automatic, default value.

//<editor-fold desc="Example data">
$idGet=md5(serialize($_GET)).md5(serialize($_POST));

if ($blade->cacheExpired('TestCache.hellocache', $idGet, 50)) {
    echo '<b>Logic layer</b>: cache expired, re-reading the list<br>';
    $list = [1, 2, 3, 4, 5];
} else {
    echo "<b>Logic layer</b>: cache active, i don't read the list<br>";
    $list=[];
}

$random=mt_rand(0, 9999);
$time=date('h:i:s A', time());
$timeUpTo=date('h:i:s A', time()+5); // plus 5 seconds
//</editor-fold>


try {
    echo $blade->run('TestCache.hellocache', ['random' => $random
            , 'time' => $time
            , 'list' => $list
            , 'timeUpTo' => $timeUpTo
            ,'idGet'=>$idGet]);
} catch (Exception $e) {
    echo 'error found ' .$e->getMessage(). '<br>' .$e->getTraceAsString();
}
