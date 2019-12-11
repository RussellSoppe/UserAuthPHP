<?php
include('./dev/cred.php');

function autoloader($class_name, $starting_dir = __DIR__) {
    foreach(glob($starting_dir . '/*', GLOB_ONLYDIR) as $dir) {

	    if(file_exists("$dir/" . $class_name . '.php')) {
            require_once "$dir/" . $class_name . '.php';
            break;
	    }else{
	    	autoloader($class_name, $dir);
	    }
    }
}

spl_autoload_register('autoloader');

$database = new Connect();
$database = $database->connectMySQL($db_creds);







