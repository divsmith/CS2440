<?php

require_once('database.php');

$newAuth = array(
    array("William", "Shakespeare", "", "1564-01-01", "M"),
    array("Dante", "Alighieri", "", "1265-01-01", "M"),
    array("Homer", "--", "", "00-01-01", "M"),
    array("Leo", "Tolstoy", "", "1828-01-01", "M"),
    array("Geoffrey", "Chaucer", "", "1340-01-01", "M"),
    array("Charles", "Dickens", "", "1812-01-01", "M"),
    array("James", "Joyce", "", "1882-01-01", "M"),
    array("John", "Milton", "", "1608-01-01", "M"),
    array("Virgil", "--", "", "00-01-01", "M"),
    array("Johann", "Wolfgang von Goethe", "", "1749-01-01", "M")
);

foreach( $newAuth as $insertArray) {
    $insert = "INSERT INTO `Library` . `Authors` (`First_Name`, `Last_Name`, `Bio`, `Birth_Date`, `Gender`, "
                . "`Active`) VALUES ('$insertArray[0]', '$insertArray[1]', '$insertArray[2]', "
                . "'$insertArray[3]', '$insertArray[4]', 'Y')";

    $success = mysql_query($insert, $connection);

    if ($success == FALSE) {
        $failmessage = "Whole query " . $insert . "<br>";
        echo $failmessage;

        die('Invalid query: ' . mysql_error());
    } else {
        echo "$insertArray[0] $insertArray[1] was added <br>";
    }
}

echo "<br><h2>Now Removing</h2><hr><br>";
for ($i = 0; $i < sizeof($newAuth); $i+=2) {
    $update = "UPDATE `Library` . `Authors` SET `Active`='N' "
                . "WHERE `First_Name`='" . $newAuth[$i][0] . "'";

    $success = mysql_query($update, $connection);

    if ($success == FALSE) {
        $failmessage = "Whole query " . $insert . "<br>";
        echo $failmessage;

        die('Invalid query: ' . mysql_error());
    } else {
        echo "{$newAuth[$i][0]} {$newAuth[$i][1]} was Removed <br>";
    }
}

echo "<br><h2>This is who is left</h2><hr><br>";

$search = "SELECT * FROM Library.Authors WHERE Active='Y'";

$return = mysql_query($search, $connection);

if ($return == FALSE) {
    $failmessage = "Whole query " . $insert . "<br>";
    echo $failmessage;

    die('Invalid query: ' . mysql_error());
}

echo "<table><th>Name</th><th>Bio</th><th>Birthyear</th><th>Gender</th>";
while ($row = mysql_fetch_array($return)) {
    echo "<tr><td>Name: " . $row['First_Name'] . " "
            . $row['Last_Name'] . "</td><td>Bio: " . $row['Bio']
            . "</td><td>Birth Year: " . date('Y', strtotime($row['Birth_Date']))
            . "</td><td>Gender: " . $row['Gender'] . "</td></tr>";
}

echo "</table>";
mysql_close($connection);