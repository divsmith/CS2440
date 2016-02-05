<html>
    <head>
        <style>
            /* The .changed class is used for when $_POST['sex'] == 'male'. */
            .changed {
                background-image: url('img/swirl_pattern.png');
            }
        </style>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    </head>

    <body class=<?php echo($_POST['sex'] == "male" ? "changed" : ""); // Change the class to 'changed' when the sex is male ?>>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-4">

                    <h2>Basic Info:</h2>

                    <p><?php

                        // Parameterize all POST variables
                        $name = $_POST['name'];
                        $age = $_POST['age'];
                        $address = $_POST['address'];
                        $state = $_POST['state'];
                        $sex = $_POST['sex'];

                        // Print out POST variables with formatting.
                        printf("You are $name and are a %u year old $sex. <br>" .
                                "Your address is $address in $state", $age);
                    ?></p>


                    <h2>Years to Birth:</h2>
                        <ul>
                        <?php

                            $currentYear = date("Y"); // Get the current year
                            $birthYear = $currentYear - $age; // Calculate the birth year.

                            $years = range($currentYear, $birthYear); // Create an array of years between the current year and the birth year.

                            // Echo each year out in an <li> tag.
                            foreach($years as $year) {
                                echo "<li>$year</li>";
                            }
                        ?>
                        </ul>

                    <h2>PostPage.txt contents:</h2>
                    <?php
                        // Echo out contents of 'PostPage.txt'
                        echo file_get_contents('PostPage.txt');
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>