<?php
    session_start();
    setlocale(LC_MONETARY, 'en_US');
    $product_id = $_POST['Select_Product'];
    $action = $_POST['action'];
    switch($action) {
        case 'Add':
                $_SESSION['cart'][$product_id]++;
                break;
        case 'Remove':
                $_SESSION['cart'][$product_id]--;
                    if ($_SESSION['cart'][$product_id] <= 0) {
                        unset($_SESSION['cart'][$product_id]);
                    }
                break;
        case 'Empty':
                unset($_SESSION['cart']);
                break;

        case 'Info':
                $infonum = $product_id;
                break;
    }

    require_once 'adventuredb.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Adventure Cart</title>
    <script type="text/javascript" src="view.js"></script>
    <script>
        function productInfo(key) {

            //creates the datafile with query string
            var data_file = "AdventureCartInfo.php?prodID=" + key;
            //this is making the http request
            var http_request = new XMLHttpRequest();
            try {
                // Opera 8.0+, Firefox, Chrome, Safari
                http_request = new XMLHttpRequest();
            } catch (e) {
                // Internet Explorer Browsers
                try {
                    http_request = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try {
                        http_request = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e) {
                        // Something went wrong
                        alert("Your browser broke!");
                        return false;
                    }
                }
            }
            http_request.onreadystatechange = function () {
                if (http_request.readyState == 4)
                {
                    var text = http_request.responseText;

                    //this is adding the elements to the HTML in the page
                    document.getElementById("productInformation").innerHTML = text;
                }
            }
            http_request.open("GET", data_file, true);
            http_request.send();
        }
    </script>

    <link href="adventure.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="form" id="form_container">
    <form action="AdventureCart.php" method="Post">
        <div >

            <p><span class="text">Please Select a product:</span>
                <select id="Select_Product" name="Select_Product" class="select">
                    <option value=""></option>
                    <?php
                        $search = 'select * from AdventureGear.AdventureGear order by Item';
                        $return = mysql_query($search);

                        if (!$return) {
                            $message = 'Whole query ' . $search;
                            echo $message;
                            die('Invalid query: ' . mysql_error());
                        }

                        while ($row = mysql_fetch_array($return)) {
                            if ($row['idAdventureGear'] == $product_id) {
                                echo "<option value='" . $row['idAdventureGear'] . "' selected='selected'>"
                                    . $row['Item'] . "</option>";
                            } else {
                                echo "<option value='" . $row['idAdventureGear'] . "'>"
                                    . $row['Item'] . "</option>";
                            }
                        }
                    ?>
                    </select></p>
            <table>
                <tr>
                    <td>
                        <input id="button_Add" type="submit" value="Add" name="action" class="button"/>
                    </td>
                    <td>
                        <input name="action" type="submit" class="button" id="button_Remove" value="Remove"/>
                    </td>
                    <td>
                        <input name="action" type="submit" class="button" id="button_empty" value="Empty"/>
                    </td>
                    <td>
                        <input name="action" type="submit" class="button" id="button_Info" value="Info"/>
                    </td>
                </tr>
            </table>

        </div>
        <div id="productInformation">

        </div>
        <div>
            <?php
                if ($infonum > 0) {
                    $sql = "select Item, Cost, Weight, ItemImage from AdventureGear.AdventureGear where idAdventureGear = " . $infonum;

                    echo "<table align='left' width='100%'><tr><th>Name</th><th>Price</th><th>Weight</th></tr>";

                    $result = mysql_query($sql);

                    if (mysql_num_rows($result) > 0) {
                        list($name, $price, $weight, $image) = mysql_fetch_row($result);
                        echo "<tr>";
                        echo "<td align='left' width='450px'>" . $name . "</td>";
                        echo "<td align='left' width='325px'>" . $money_format('$(#8n', $price) . "</td>";
                        echo "<td align='center'>$weight</td>";
                        echo "<td align='left' width='450px'><img src='images\\$image' height='160' width='160'></td>";
                        echo "</tr>";
                    } else {}

                    echo "</table>";
                }
            ?>
        </div>
        <div>
            <?php

                if ($_SESSION['cart']) {
                    echo "<table border=\"1\" padding=\"3\" width=\"650px\"><tr><th>Name</th><th>Weight</th><th>Price</th>" .
                    "<th width='80px'>Line</th></tr>";

                    foreach ($_SESSION['cart'] as $product_id => $quantity) {
                        $sql = 'select Item, Cost, Weight from AdventureGear.AdventureGear where idAdventureGear = ' . $product_id;

                        $result = mysql_query($sql);

                        if (mysql_num_rows($result) > 0) {
                            list($name, $price, $weight) = mysql_fetch_row($result);

                            $weight = $weight * $quantity;
                            $line_cost = $price * $quantity;
                            $totalWeight = $totalWeight + $weight;
                            $total = $total + $line_cost;
                            echo "<tr>";
                            echo "<td align='left' width='450px'>$name</td>";
                            echo "<td align='center' width='75px'>$weight</td>";
                            echo "<td align=center' width='75px'>" . money_format('%(#8n', $price) . "</td>";
                            echo "<td align='center'>" . money_format('%(#8n', $line_cost) . "</td>";
                            echo "</tr>";
                        }
                    }

                    echo "<tr>";
                    echo "<td align='right'>Total Weight</td><td align='right'>$totalWeight</td><td align='right'>Total</td>";
                    echo "<td align='right'>" . money_format('%(#8n', $total) . "</td>";
                    echo "</tr>";
                    echo "</table>";
                } else {
                    echo "You have no items in your shopping cart.";
                }

            mysql_close($connection);
            ?>
        </div>
    </form>
</div>
</body>
</html>
