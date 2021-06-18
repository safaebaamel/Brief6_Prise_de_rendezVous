<?php

spl_autoload_register('myAutoloader');

function myAutoloader($className) {

    $path = "../controller/";
    $extension = ".inc.php";

    $fullPath =  $path . $className . $extension;

    if (!file_exists($fullPath)) {
        $path = "../Model/";

        $fullPath = $path . $className . $extension;
    } else {

        $path = "../Controller/config/";

        $fullPath =  $path . $className . $extension;
    }
    
    include_once $fullPath;

}
?>