<html>
    <head>
        <style>
            .changed {
                background-color: #00bfff;
            }
        </style>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    </head>

    <body class=<?php echo($_POST['sex'] == "male" ? "changed" : ""); ?>>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-4">

                    <h2>Basic Info:</h2>

                    <p><?php

                        $name = $_POST['name'];
                        $age = $_POST['age'];
                        $address = $_POST['address'];
                        $state = $_POST['state'];
                        $sex = $_POST['sex'];

                        printf("You are $name and are a %u year old $sex. <br>" .
                                "Your address is $address in $state", $age);
                    ?></p>


                    <h2>Years to Birth</h2>
                        <ul>
                        <?php

                            $startYear = date("Y");
                            $endYear = $startYear - $age;

                            $years = range($startYear, $endYear);

                            foreach($years as $year) {
                                echo "<li>$year</li>";
                            }
                        ?>
                        </ul>
                </div>
            </div>
        </div>
    </body>
</html>