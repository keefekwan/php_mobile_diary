<?php

/**
 * PDO configuration
 *
 * Set user
 * Set password
 * Set host
 * Set database
 *
 */
define('MYSQL_USER', 'your_user');
define('MYSQL_PASSWORD', 'your_password');
define('MYSQL_HOST', 'your_host');
define('MYSQL_DATABASE', 'your_database');

/**
 * PDO options / configuration details
 *
 * Set the error mode to "Exceptions"
 * Turn off emulated prepared statements
 */
$pdoOptions = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
];

/**
 * Connect to MySQL and instantiate the PDO object.
 */
$pdo = new PDO(
    "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE,
    MYSQL_USER,
    MYSQL_PASSWORD,
    $pdoOptions
);