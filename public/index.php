<?php

session_start();

require '../App/core/init.php';

/** Debug usage condition */
DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0);

$app = new App;
$app->loadController();
