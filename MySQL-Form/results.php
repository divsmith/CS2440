<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>MySQL Form</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <?php

        require_once('database.php');

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $birthday = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
        $username = $_POST['username'];
        $password = $_POST['password']; // I know this is really bad!
        $sex = $_POST['sex'];
        $relationship = $_POST['relationship'];

        if ($_POST['button_create'] != '')
        {
            if ($first_name == '' || $last_name == '' || $phone == '' || $address == '' || $city = '' || $state == '' || $_POST['year'] == ''
                    || $_POST['month'] == '' || $_POST['day'] == '' || $username == '' || $password == '' || $sex == '' || $relationship == '') {

                $message = 'Please fill out all of the fields.';
                echo $message;

                die();
            }

            $insert = "insert into Friends.Person(first_name, last_name, phone_number, address, city, state, zip, birthdate, username, password, sex, relationship)
                                             values('$first_name', '$last_name', '$phone', '$address', '$city', '$state', '$zip', '$birthday', '$username', '$password', '$sex', '$relationship');";

            $success = mysql_query($insert, $connection);


            if (!$success) {
                $failmessage = "Whole query " . $insert . "<br>";
                echo $failmessage;

                die('Invalid query: ' . mysql_error());
            } else {
                echo "<h2>A record was created for</h2>";
                echo "<p>First Name: {$first_name}</p>";
                echo "<p>Last Name: {$last_name}</p>";
                echo "<p>Phone Number: {$phone}</p>";
                echo "<p>Address: {$address}</p>";
                echo "<p>City: {$city}</p>";
                echo "<p>State: {$state}</p>";
                echo "<p>Zip: {$zip}</p>";
                echo "<p>Birthday: {$birthday}</p>";
                echo "<p>Username: {$username}</p>";
                echo "<p>Sex: {$sex}</p>";
                echo "<p>Relationship: {$relationship}</p>";
            }
        }



    ?>

</body>
</html>


