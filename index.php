<?php

declare(strict_types=1);

include_once('./Utils/debug.php');
require_once('./src/Controller.php');

// error_reporting(0);
// ini_set('display_errors', '0');

use App\Controller;
use App\Request;

$config = require_once('./config/config.php');

Controller::initConfiguration($config);

$request = new Request($_GET, $_POST, $_FILES);

(new Controller($request))->run();
