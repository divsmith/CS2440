<html>
    <?php
    require_once './../database.php';
    $select = "SELECT * FROM Library.Person order by last_name, first_name";
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Movie!!!!!</title>
        <link rel="stylesheet" type="text/css" href="view.css" media="all">
        <script type="text/javascript" src="view.js"></script>
    </head>
    <body>
        <div class="form">
            <div id="form_container">
                <form action="MovieView.php" method="post">

                    Sort By:<ul>
                        <li>Director or Actor:<select name="person" id="selector"><?php
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
                                ?> </select></li>
                        <li><input type="submit" value ="Director" name="sort" id="Button_Input"></li>
                        <li><input type="submit" value ="Lead" name ="sort" id="Button_Input"></li>
                        <li> <input type="submit" value ="Title" name="sort" id="Button_Input"> </li>
                        <li><input type="submit" value ="Year" name="sort" id="Button_Input"> </li></ul>
                </form>
                <?php
                $sortMethod = $_POST['sort'];
                $person = $_POST['person'];


                //echo $sortMethod;
                $select = "";
                switch ($sortMethod) {
                    case "Director":
                        $select = "Select Movie.title, Movie.director_id, Movie.lead_id," .
                                "(select Person.first_name from Person where  Movie.director_id = Person.person_id) as dfname, " .
                                "(select Person.last_name from Person where  Movie.director_id = Person.person_id) as dlname," .
                                "(select Person.first_name from Person where  Movie.lead_id = Person.person_id) as afname," .
                                "(select Person.last_name from Person where  Movie.lead_id = Person.person_id) as alname," .
                                "Movie.release_date, " .
                                "(select Genre.name from Genre where Movie.genre_id = Genre.genre_id) as gname" .
                                " from Movie, Person " .
                                "where Movie.director_id = Person.person_id and Person.person_id = $person";

                        break;
                    case "Lead":
                        $select = "Select Movie.title, Movie.director_id, Movie.lead_id," .
                                "(select Person.first_name from Person where  Movie.director_id = Person.person_id) as dfname, " .
                                "(select Person.last_name from Person where  Movie.director_id = Person.person_id) as dlname," .
                                "(select Person.first_name from Person where  Movie.lead_id = Person.person_id) as afname," .
                                "(select Person.last_name from Person where  Movie.lead_id = Person.person_id) as alname," .
                                "Movie.release_date, " .
                                "(select Genre.name from Genre where Movie.genre_id = Genre.genre_id) as gname" .
                                " from Movie, Person " .
                                "where Movie.lead_id = Person.person_id and Person.person_id = $person";

                        break;
                    case "Title":
                        $select = "Select Movie.title, Movie.director_id, Movie.lead_id," .
                                "(select Person.first_name from Person where  Movie.director_id = Person.person_id) as dfname, " .
                                "(select Person.last_name from Person where  Movie.director_id = Person.person_id) as dlname," .
                                "(select Person.first_name from Person where  Movie.lead_id = Person.person_id) as afname," .
                                "(select Person.last_name from Person where  Movie.lead_id = Person.person_id) as alname," .
                                "Movie.release_date, " .
                                "(select Genre.name from Genre where Movie.genre_id = Genre.genre_id) as gname" .
                                " from Movie, Person " .
                                "where Movie.director_id = Person.person_id order by Movie.title";

                        break;
                    case "Year":

                        $select = "Select Movie.title, Movie.director_id, Movie.lead_id," .
                                "(select Person.first_name from Person where  Movie.director_id = Person.person_id) as dfname, " .
                                "(select Person.last_name from Person where  Movie.director_id = Person.person_id) as dlname," .
                                "(select Person.first_name from Person where  Movie.lead_id = Person.person_id) as afname," .
                                "(select Person.last_name from Person where  Movie.lead_id = Person.person_id) as alname," .
                                "Movie.release_date, " .
                                "(select Genre.name from Genre where Movie.genre_id = Genre.genre_id) as gname" .
                                " from Movie, Person " .
                                "where Movie.director_id = Person.person_id order by Movie.release_date";
                        break;
                    default:
                        $select = "Select Movie.title, Movie.director_id, Movie.lead_id," .
                                "(select Person.first_name from Person where  Movie.director_id = Person.person_id) as dfname, " .
                                "(select Person.last_name from Person where  Movie.director_id = Person.person_id) as dlname," .
                                "(select Person.first_name from Person where  Movie.lead_id = Person.person_id) as afname," .
                                "(select Person.last_name from Person where  Movie.lead_id = Person.person_id) as alname," .
                                "Movie.release_date, " .
                                "(select Genre.name from Genre where Movie.genre_id = Genre.genre_id) as gname" .
                                " from Movie, Person " .
                                "where Movie.director_id = Person.person_id";
                        break;
                }
                //echo $select;
                ?>
            </div>
        </div>
        <div class="datagrid">
            <?php
            $result = mysql_query($select, $connection);

            if (!$result) {
                $message = "Whole query " . $select;
                echo $message;
                die('Invalid query: ' . mysql_error());
            }
            echo "<table><tr><th>Title</th><th>Director</th><th>Lead Actor/Actress</th><th>Release Date</th><th>Genre</th></tr>";
            while ($row = mysql_fetch_array($result)) {
                echo "<tr><td> " . $row['title'] . "</td>";
                echo "<td> " . $row['dfname'] . " " . $row['dlname'] . "</td>";
                echo "<td> " . $row['afname'] . " " . $row['alname'] . "</td>";
                echo "<td> " . $row['release_date'] . "</td>";
                echo "<td> " . $row['gname'] . "</td>";
            }
            echo "</table>";
            ?>
        </div>    </body>
</html>
