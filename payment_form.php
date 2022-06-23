<?php
session_start();
$bus_id = $_POST['bus_id'];
$seats = $_POST['noseats'];
$fare = $_POST['totalfare'];
$name = $_SESSION['name'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="form2.css">
    <title>form2</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            margin: 15px 38px;
            font-size: 17px;
            padding: 8px;
        }

        .container {
            background-color: #f2f2f2;
            padding: 5px 20px 15px 20px;
            border: 3px solid lightgray;
            border-radius: 4px;
        }

        input [type="text"],
        input [type="email"],
        input [type="number"],
        input [type="password"],
        input [type="date"],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 5px;
        }

        fieldset {
            background-color: #fff;
            border: 2px solid black;
        }

        .main_heading {
            text-align: center;
        }

        input[type="submit"] {
            background-color: #4daea1;
            color: white;
            padding: 20px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #4caf84;
        }
    </style>
</head>

<body>
    <form action="bookticket.php" method="POST" class="container" onsubmit="return check_validation(this)">
        <h2 class="main_heading">payment form</h2>
        <h3>contact information</h3>
        <?php

        echo '<p>Name : <input type="text" name="name" value="' . $name . '" readonly/></p><p><label for="busid" class="bform">Bus Id:</label><input type="number" id="bus_id" name="bus_id" value="' . $bus_id . '" readonly></p>
        <p><label for="noseats" class="bform">Number Of Seats:</label><input type="number" name="noseats" id="noseat" value="' . $seats . '" readonly></p>
        <p><label for="totalfare" class="bform">Total Fare:</label><input type="number" name="totalfare" id="fare" value="' . $fare . '" readonly></p>';

        ?>
        <h2>payment information</h2>
        <p>
            card type :
            <select name="card_type" id="card_type" required>
                <option value="">--select a card type--</option>
                <option value="visa">Visa</option>
                <option value="rupey">rupey</option>
                <option value="mastercard">master card</option>
            </select>
        </p>
        <p>
            card Number :
            <input type="number" name="card_number" id="card_number" required placeholder="1111-2222-3333-4444" />
        </p>
        <p>CVV : <input type="password" name="cvv" id="cvv" placeholder="123" /></p>
        <p><input type="submit" value="Pay Now" required /></p>
    </form>
    <script>
        function check_validation() {
            var x = confirm("Are You Sure To Continue..?");
            if (x) {
                if (card()) {
                    if (check()) {
                        return true;
                    } else
                        return false;
                } else
                    return false;
            } else
                return true;
        }

        function card() {
            var t = document.getElementById("card_number").value;
            if (t.length != 16) {
                alert('Enter valid card!!');
                return false;
            } else
                return true;
        }

        function check() {
            var n = document.getElementById('cvv').value;
            console.log(n);
            var r = /^[0-9]{3}$/;
            if (n.match(r)) {
                return true;
            } else {
                alert('Enter valid CVV!!');
                return false;
            }
        }


    </script>
</body>

</html>