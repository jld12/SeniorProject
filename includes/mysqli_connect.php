<?php
// This script will be used by each page that requires it, and provides connection to the MySQL database.

// Set variables for database connection.
DEFINE ('DB_USER', 'PhanOnReadWrite');
DEFINE ('DB_PASSWORD', 'PASSWORD');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'PhantasyOnline');

// Connects to the database or dies.
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Failed to connect to MySQL.');

mysqli_set_charset($dbc, 'utf8');

?>
