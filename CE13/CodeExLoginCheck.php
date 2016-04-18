<?php

session_start();
unset($_SESSION['badPass']);

$username = $_POST['username'];
$password = $_POST['password'];

@ $conndb = mysql_connect('localhost', 'root', 'databasepassword');
if (!$conndb) {
    die('unable to connect to database');
}

$db_selected = mysql_select_db('ACME', $conndb);

if (!$db_selected) {
    die('cannot connect to database');
}

$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
$hashed = hash("ripemd128", $password);

$sql = "select * from ACME.FriendAndFamily where username = '" . $username . "' and password = '" . $hashed . "'";

$result = mysql_query($sql);

if (!$result) {
    $message = 'Whole query ' . $sql;
    echo $message;
    die('Invalid query: ' . mysql_error());
}

$count = mysql_num_rows($result);

if ($count == 1) {
    $_SESSION['user'] = $username;
    $_SESSION['password'] = $password;

    header('Location:CodeWork.php');
} else {
    header('Location:CodeExFail.php');
    $_SESSION['badPass']++;
}
