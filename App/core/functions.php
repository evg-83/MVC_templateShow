<?php

/** Error output */
ini_set('display_errors', 1);

/** Activating error report */
error_reporting(E_ALL);

/** Display function (verification) */
function show($stuff)
{
    echo '<pre>';
    print_r($stuff);
    echo '</pre>';
}

/** Attack protection */
function esc($str)
{
    return htmlspecialchars($str);
}

/** Redirect function */
function redirect($path)
{
    header("Location: " . ROOT . "/" . $path);
    die;
}
