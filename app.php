<?php

//  puth  & urls

use TechStore\Classes\Request;
use TechStore\Classes\Session;


define("PATH",__DIR__ . "/");
define("URL", "https://nada-r-mohamed.github.io/techstore/");

define("APATH",__DIR__ . "/admin/");
define("AURL", "https://nada-r-mohamed.github.io/techstore/admin/");


// db credentials
define("DB_SERVERNAME", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "techstore");

// include classes
require_once("vendor/autoload.php");

// objects
$request = new Request();
$session = new Session();
