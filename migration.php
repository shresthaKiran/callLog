<?php

require('vendor/autoload.php');

use Database\Connections\DB;

$dbConfig = require('config/database.php');

$connection = new DB($dbConfig['host'], $dbConfig['username'], $dbConfig['password']);
$dbConnection = $connection->getConnection();

$createDBQuery = file_get_contents("database/schema/create_database.sql");

$dbConnection->query($createDBQuery);
$dbConnection->query("USE {$dbConfig['db']}");

$createCallHeadersTableQuery = file_get_contents("database/schema/create_call_headers.sql");
$dbConnection->query($createCallHeadersTableQuery);

$createCallDetailsTableQuery = file_get_contents("database/schema/create_call_details.sql");
$dbConnection->query($createCallDetailsTableQuery);
