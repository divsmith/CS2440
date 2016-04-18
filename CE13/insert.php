<?php

require_once 'logindatabase.php';

$sql = "insert into ACME.FriendAndFamily(username, password) values('jake', '" .
                                    hash('ripemd128', 'pass') . "')";
$result = mysql_query($sql);

if (!$result) {
    $message = 'Whole query ' . $sql;
    echo $message;
    die('Invalid query: ' . mysql_error());
}