
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add a Person</title>
        <link rel="stylesheet" type="text/css" href="view.css" media="all">
        <script type="text/javascript" src="view.js"></script>
    </head>
    <body>
        <?php
        require_once './../database.php';
        if(isset($_POST['fname'])){
            $first= $_POST['fname'];
            $second= $_POST['lname'];
            $bio= $_POST['bio'];
            $insert = "INSERT INTO `Library`.`Person` (`first_name`, `last_name`, `bio`) VALUES ('$first', '$second', '$bio');";

            //Now we load the result of the query into a variable to make sure we succeeded.
            $success = mysql_query($insert, $connection);
            if ($success == FALSE) {
                $failmess = "Whole query " . $insert . "<br>";
                echo $failmess;
                die('Invalid query: ' . mysql_error());
            } else {
                $message = "insert complete";
            }
        }
        ?>
        <div id="form_container">
            <form action="AddPersonForm.php" method="post">
                <label>First Name: </label><input name="fname" type="text"></br>
                <label>Last Name: </label><input name="lname" type="text"></br>
                <label>Biology: </label><textarea name="bio" type="text"></textarea></br>
                <input type="submit" name="addPerson" value="Add Person">
            </form>
            <?php
            echo $message;
            ?>
        </div>
    </body>
</html>
