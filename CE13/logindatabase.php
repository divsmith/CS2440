<?php
    $host = 'localhost';
    $user = 'root';
    $password = 'databasepassword';
    $database_name = 'ACME';

    $connection = mysql_connect($host, $user, $password);

    if (!$connection) {
        die('Unable to connect to database [' . mysql_error() . ']');
    }

    $database = mysql_select_db($database_name, $connection);

    if (!$database) {
        die('Can\'t use root at : ' . mysql_error());
    }