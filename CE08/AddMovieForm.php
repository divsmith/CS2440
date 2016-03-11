<html>
    <head>
        <meta charset="UTF-8">
        <title>Add a Movie</title>
        <?php
        require_once './../database.php';
        $select = "SELECT * FROM Library.Person order by last_name, first_name";
        if(isset($_POST['addMovie'])){
            $title= $_POST['mname'];
            $date= $_POST['year']."-".$_POST['month']."-".$_POST['day'];
            $director= $_POST['Director'];
            $actor = $_POST['Actor'];
            $genre = $_POST['genre'];
            //INSERT INTO `Library`.`Movies` (`Title`, `Director`, `Lead`, `Genre`, `Release`, `rating`) VALUES ('Jaws', '1', '5', 'action', '1975-06-01', '5')
            $insert = "INSERT INTO `Library`.`Movie` (`title`, `director_id`, `lead_id`, `genre_id`, `release_date`) "
                    . "VALUES ('$title', '$director', '$actor', '$genre', '$date')";
echo $insert;
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
        <link rel="stylesheet" type="text/css" href="view.css" media="all">
        <script type="text/javascript" src="view.js"></script>
    </head>
    <body>
        <div id="form_container"><p>
            <form action="AddMovieForm.php" method="post">
                <label>Movie Name: </label><input name="mname" type="text" id="textfield"><br>
                <label>Director:</label><select name="Director">
                    <?php
                    $return = mysql_query($select, $connection);
                    if (!$return) {//here we check to see if we got a result set
                        $message = "Whole query " . $select;
                        echo $message;
                        die('Invalid query: ' . mysql_error());
                    }
                    while ($row = mysql_fetch_array($return)) {//here we are loading the results into the variable row one at a time and printing out the row
                        $fname = $row['first_name']; //you will not we have to use the collum names in the database
                        $lname = $row['last_name'];
                        $theID = $row['person_id'];
                        echo "<option value = '$theID'>$fname $lname</option>";
                    }
                    ?>
                </select><a target="_blank" href="AddPersonForm.php">I do not see my director listed</a><br>
                <label>Actor:</label>
                <select name="Actor">
                    <?php
                    $return = mysql_query($select, $connection);
                    if (!$return) {//here we check to see if we got a result set
                        $message = "Whole query " . $select;
                        echo $message;
                        die('Invalid query: ' . mysql_error());
                    }
                    while ($row = mysql_fetch_array($return)) {//here we are loading the results into the variable row one at a time and printing out the row
                        $fname = $row['first_name']; //you will not we have to use the collum names in the database
                        $lname = $row['last_name'];
                        $theID = $row['person_id'];
                        echo "<option value = '$theID'>$fname $lname</option>";
                    }
                    ?></select><a target="_blank" href="AddPersonForm.php">I do not see my actor listed</a><br>
                    <lable>Release Date</lable><input type="text" name="year" placeholder="yyyy" maxlength="4" size="4">-<input type="text" name="month" placeholder="mm" maxlength="2" size="2">-<input type="text" name="day" placeholder="dd" maxlength="2" size="2"><br>
                    <label value ="Genre">Genre</label>
<!--                        <select name="genre">-->
<!--                            <option value ="action">Action</option>-->
<!--                            <option value ="adventure">Adventure</option>-->
<!--                            <option value ="comedy">Comedy</option>-->
<!--                            <option value ="crime">Crime</option>-->
<!--                            <option value ="fantasy">Fantasy</option>-->
<!--                            <option value ="historical">Historical</option>-->
<!--                            <option value ="horror">Horror</option>-->
<!--                            <option value ="mystery">Mystery</option>-->
<!--                            <option value ="romance">Romance</option>-->
<!--                            <option value ="sci-fi">Sci-Fi</option>-->
<!--                        </select>-->

                        <select name="genre">
                            <?php
                            $return = mysql_query("SELECT * FROM Library.Genre order by name", $connection);
                            if (!$return) {//here we check to see if we got a result set
                                $message = "Whole query " . $select;
                                echo $message;
                                die('Invalid query: ' . mysql_error());
                            }
                            while ($row = mysql_fetch_array($return)) {//here we are loading the results into the variable row one at a time and printing out the row
                                $name = $row['name']; //you will not we have to use the collum names in the database
                                $theID = $row['genre_id'];
                                echo "<option value = '$theID'>$name</option>";
                            }
                            ?>
                        </select>
                    <br>
                <input type="submit" name="addMovie" value="Add Movie">
            </form></p>
            <p>
                <a href="MovieView.php" target="_blank">View Movie List</a>
            </p>
        </div>
    </body>
</html>
