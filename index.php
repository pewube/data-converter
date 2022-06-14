<?php

declare(strict_types=1);

spl_autoload_register(function (string $classNamespace) {
    $path = str_replace(['\\', 'App/'], ['/', ''], $classNamespace);
    $path = "src/$path.php";
    require_once($path);
});

include_once('./Utils/debug.php');
$config = require_once('./config/config.php');

// error_reporting(0);
// ini_set('display_errors', '0');

use App\Controller;
use App\Request;



Controller::initConfiguration($config);

$request = new Request($_GET, $_POST, $_FILES);

(new Controller($request))->run();
