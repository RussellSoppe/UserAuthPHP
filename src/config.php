<?php
include('./dev/cred.php');
// include('./vendor/autoload.php');

function autoloader($class_name) {
    foreach(glob(__DIR__ . '/*', GLOB_ONLYDIR) as $dir) {
        if (file_exists("$dir/" . $class_name . '.php')) {
            require_once "$dir/" . $class_name . '.php';
            break;
        }
    }
}

spl_autoload_register('autoloader');


$database = new Connect();

$database = $database->connectMySQL($dburl, $dbname, $dbuser, $dbpassword);

if(is_string($database)){
    echo $database;
}






