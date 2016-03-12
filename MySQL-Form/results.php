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
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

        <?php

            require_once('database.php');

            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $zip = $_POST['zip'];
            $birthday = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
            $username = $_POST['username'];
            $password = $_POST['password']; // I know this is really bad!
            $sex = $_POST['sex'];
            $relationship = $_POST['relationship'];

            if ($_POST['button_create'] != '')
            {
                if ($first_name == '' || $last_name == '' || $phone == '' || $address == '' || $city == '' || $state == '' || $_POST['year'] == ''
                        || $_POST['month'] == '' || $_POST['day'] == '' || $zip == '' || $username == '' || $password == '' || $sex == '' || $relationship == '') {

                    $message = 'Please fill out all of the fields.';
                    echo $message;

                    die();
                }

                $insert = "insert into Friends.Person(first_name, last_name, phone, address, city, state, zip, birthday, username, password, sex, relationship)
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
            else if ($_POST['button_update'] != '')
            {
                if ($first_name == '' || $last_name == '') {

                    $message = 'Please enter at least the first and last name.';
                    echo $message;

                    die();
                }

                $results = search_people($first_name, $last_name, $connection);
                $results = $results[0];

                /* Figure out whether a new value has been sent for each
                    field. If so, set the result array to use the new value */
                $results['phone'] = $phone == '' ? $results['phone'] : $phone;
                $results['address'] = $address == '' ? $results['address'] : $address;
                $results['city'] = $city == '' ? $results['city'] : $city;
                $results['state'] = $state == '' ? $results['state'] : $state;
                $results['zip'] = $zip == '' ? $results['zip'] : $zip;
                $results['birthday'] = $birthday == '--' ? $results['birthday'] : $birthday;
                $results['username'] = $username == '' ? $results['username'] : $username;
                $results['password'] = $password == '' ? $results['password'] : $password;
                $results['sex'] = $sex == '' ? $results['sex'] : $sex;
                $results['relationship'] = $relationship == '' ? $results['relationship'] : $relationship;

                $query = "update Friends.Person set phone = '{$results['phone']}', address = '{$results['address']}',
                                                      city = '{$results['city']}', state = '{$results['state']}',
                                                      zip = '{$results['zip']}', birthday = '{$results['birthday']}',
                                                      username = '{$results['username']}', password = '{$results['password']}',
                                                      sex = '{$results['sex']}', relationship = '{$results['relationship']}'

                                                      where person_id = {$results['person_id']};";
                $success = mysql_query($query, $connection);


                if (!$success) {
                    $failmessage = "Whole query " . $query . "<br>";
                    echo $failmessage;

                    die('Invalid query: ' . mysql_error());
                } else {
                    echo "<h2>The record was updated for</h2>";
                    echo "<p>First Name: {$results['first_name']}</p>";
                    echo "<p>Last Name: {$results['last_name']}</p>";
                    echo "<p>Phone Number: {$results['phone']}</p>";
                    echo "<p>Address: {$results['address']}</p>";
                    echo "<p>City: {$results['city']}</p>";
                    echo "<p>State: {$results['state']}</p>";
                    echo "<p>Zip: {$results['zip']}</p>";
                    echo "<p>Birthday: {$results['birthday']}</p>";
                    echo "<p>Username: {$results['username']}</p>";
                    echo "<p>Sex: {$results['sex']}</p>";
                    echo "<p>Relationship: {$results['relationship']}</p>";
                }
            }
            else if ($_POST['button_search'] != '') {
                if ($first_name == '' || $last_name == '') {

                    $message = 'Please enter at least the first and last name.';
                    echo $message;

                    die();
                }

                $results = search_people($first_name, $last_name, $connection);

                foreach($results as $result) {
                    echo "<h2>A record was found for</h2>";
                    echo "<p>First Name: {$result['first_name']}</p>";
                    echo "<p>Last Name: {$result['last_name']}</p>";
                    echo "<p>Phone Number: {$result['phone']}</p>";
                    echo "<p>Address: {$result['address']}</p>";
                    echo "<p>City: {$result['city']}</p>";
                    echo "<p>State: {$result['state']}</p>";
                    echo "<p>Zip: {$result['zip']}</p>";
                    echo "<p>Birthday: {$result['birthday']}</p>";
                    echo "<p>Username: {$result['username']}</p>";
                    echo "<p>Sex: {$result['sex']}</p>";
                    echo "<p>Relationship: {$result['relationship']}</p>";
                }
            }

            function search_people($first_name, $last_name, $connection) {
                $first_name = strtolower($first_name);
                $last_name = strtolower($last_name);

                $query = "select * from Person where lower(first_name) like '$first_name' and lower(last_name) like '$last_name'";

                $success = mysql_query($query, $connection);


                    if (!$success) {
                        $failmessage = "Whole query " . $query . "<br>";
                        echo $failmessage;

                        die('Invalid query: ' . mysql_error());
                    } else {
                        $results = array();

                        while($res = mysql_fetch_array($success)) {
                            $results[] = $res;
                    };

                        if (!$results) {
                            echo "<h2>No Results Found</h2>";
                            echo "<p>No results were found for {$first_name} {$last_name}</p>";
                            die();
                        } else {
                            return $results;
                        }

            }
        }


            ?>

        </div>
    </div>

</body>
</html>


