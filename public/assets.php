<?php
/**
 * Created by Matteo Antoci
 * Date: 14/12/13
 * Time: 16.34
 */

require('assets/Plassets.php');

$assetsBuilder = new Plassets($_GET['path'], $_GET['ext']);

if(!$assetsBuilder->isSafe()){
    header('HTTP/1.0 404 Not Found');
    echo "<h1>404 Not Found</h1>";
    echo "The file that you have requested could not be found. Check file path and name.";
    die();
}

if(!$assetsBuilder->isBinary() && !ob_start("ob_gzhandler")){
    ob_start();
}

foreach($assetsBuilder->getHeaders() as $key => $value){
    header("$key: $value");
}

$assetsBuilder->render();