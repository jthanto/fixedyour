<?php

//Error reporting only cool for dev ;)
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

// Mail
define('MAILSENDER_API_KEY', '');
define('DEFAULT_CONTACT_RECIPIENT_NAME', '');
define('DEFAULT_CONTACT_RECIPIENT_MAIL', '');
define('DEFAULT_CONTACT_FROM_NAME', 'Kontaktskjema');
define('DEFAULT_FROM_NAME', 'Fixedyour.net');
define('DEFAULT_FROM_MAIL', '');

// Dbstuff
define('DB_MYSQL_HOST', 'localhost');
define('DB_MYSQL_PORT', '3306');
define('DB_MYSQL_USER', '');
define('DB_MYSQL_PASSWORD', '');


?>