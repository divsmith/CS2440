<html>
    <head>
        <title>CE04</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-4">
                    <form action="CE04.php" method="post">
                    <?php
                        if ($_POST['sneaky'] == 0) {
                            print <<<HTML
                        <div class="form-group">
                            <label for="name">Name: </label>
                            <input type="text" id="name" name="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="age">Age: </label>
                            <input type="number" id="age" name="age" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender: </label>
                            <input type="radio" id="gender" name="gender" value="male"> Male
                            <input type="radio" id="gender" name="gender" value="female"> Female
                        </div>

                        <div class="form-group">
                            <label for="class">Class: </label>
                            <select name="class" id="class">
                                <option value="detective">Detective</option>
                                <option value="scientist">Scientist</option>
                                <option value="soldier">Soldier</option>
                                <option value="doctor">Doctor</option>
                            </select>
                        </div>

                        <input type="hidden" name="sneaky" id="sneaky" class="hidden" value=1>

                        <input type="submit" class="btn btn-primary">
HTML;

                        } else {
                            $name = $_POST['name'];
                            $name = strtolower($name);
                            $name = ucwords($name);
                            $age = $_POST['age'];
                            $gender = $_POST['gender'];
                            $class = $_POST['class'];

                            $settings = explode("\n", file_get_contents('settings.txt'));
                            $objectives = explode("\n", file_get_contents('objectives.txt'));
                            $antagonists = explode("\n", file_get_contents('antagonists.txt'));
                            $complications = explode("\n", file_get_contents('complications.txt'));

                            shuffle($settings);
                            shuffle($objectives);
                            shuffle($antagonists);
                            shuffle($complications);

                            if ($gender == "female") {
                                $title = "Lady";
                            } else {
                                $title = "Sir";
                            }

                            printf("This is the story about a %s %s<br> at only the age of %d is a %s<br>"
                                    . "This is the start of the story....<br>", $title, $name, $age, $class);
                            echo $settings[0] . ' ' . $objectives[0] . ' ' . $antagonists[0] . ' '
                                    . $complications[0] . "<br /><input type = 'submit' value='Try again'>"
                                    . "<input type='hidden' value=0/>";
                        }
                    ?>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

<?php

