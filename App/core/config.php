<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    /** Config DB */
    define('DBNAME', 'name_your_DB');
    define('DBHOST', 'localhost');
    define('DBUSER', 'name_user');
    define('DBPASS', 'your_password');
    define('DBDRIVER', '');
    
    /** Local */
    define('ROOT', 'http://localhost/MVC_templateShow/public');
} else {
    /** Config DB */
    define('DBNAME', 'name_your_DB');
    define('DBHOST', 'localhost');
    define('DBUSER', 'name_user');
    define('DBPASS', 'your_password');
    define('DBDRIVER', '');

    /** Online */
    define('ROOT', 'www.yourWebsiteName.com');
}

/** Debug usage */
define('DEBUG', 'true');
