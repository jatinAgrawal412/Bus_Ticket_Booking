<?php
$login = true;
session_start();
if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true)
   { $login = false;}
$source = $_POST['source'];
$destination = $_POST['destination'];
$date = $_POST['date'];
$_SESSION['date'] = $date;
$source = lcfirst($source);
$destination = lcfirst($destination);
$conn = mysqli_connect("localhost", "root", "", "bus_project");
$sql = "SELECT * FROM `route_info` WHERE `source`='$source' AND `destination`='$destination'";
$source = ucfirst($source);
$destination = ucfirst($destination);
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
$data = mysqli_fetch_assoc($result);
$route_id = $data['route_id'];
$sql = "SELECT * FROM `bus_route` WHERE `route_id`='$route_id'";
$result2 = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result2);
$max_seats;
?>
<!DOCTYPE html>
<html>

<head>
    <title>Search Results</title>
    <link rel="stylesheet" href="nav.css">

    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        #bookform {
            display: none;
            position: absolute;
            padding: 10px 20px;
            width: 210px;
            height: 260px;
            background-color: white;
            border: 2px solid black;
            border-radius: 10px;
            top: 200px;
            left: 500px;
            right: 0px;
            bottom: 0px;
            z-index: 3;
        }

        input {
            margin: 10px;
            padding: 2px;
            border-radius: 5px;
            border: 2px solid black;
        }

        .bform {
            padding: 5px;
            font-size: 15px;
            font-weight: bolder;
        }

        #pay {
            border-radius: 5px;
            font-weight: bolder;
            width: 50px;
            text-align: center;
            padding: 5px 0px;
            cursor: pointer;
        }

        #pay:hover {
            background-color: rgb(215, 178, 250);
        }

        #cover {
            position: absolute;
            width: 100%;
            height: 1000px;
            top: 0px;
            left: 0px;
            right: 0px;
            bottom: 0px;
            opacity: 0.20;
            background: #aaa;
            z-index: 1;
            display: none;
        }

        #sform {
            margin-left: 180px;
            width: 30px;
            text-align: center;
            margin-top: 5px;
            margin-bottom: 10px;
            font-size: 20px;
            font-weight: bolder;
            cursor: default;
        }

        #sform:hover {
            background-color: red;
            color: white;
        }

        #seaterror {
            display: none;
            margin-left: 10px;
            font-size: 10px;
            color: red;
        }

        button {
            font-size: large;
            margin-top: 10px;
            width: 100px;
            padding: 5px;
            border-radius: 20px;
            border-width: 1px;
            box-shadow: 0 2px #999;
            cursor: pointer;
        }

        button:hover {
            background-color: rgb(158, 188, 226);
        }

        button:active {
            box-shadow: 0 1px #999;
            transform: translateY(4px);
        }

        #div1 {
            margin: 40px;
            padding: 8px;
            background-color: black;
        }

        #temp,
        #date {
            margin-top: 25px;
            margin-left: 35px;
            color: white;
            font-size: larger;
        }

        #date {
            margin-left: 655px;
        }

        table {
            width: 94%;
            border: 2px solid black;
            margin: 40px 40px;
            padding: 20px;
        }

        th,
        td {
            margin: 20px 250px;
            padding-left: 65px;
        }

        th {
            font-size: large;
            font-weight: bold;
            color: rgb(155, 77, 77);
        }

        td {
            color: black;
            font-weight: lighter;
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>

<body>
  <?php include 'navbar_log.php'; ?>
    <h1 style="text-align: center; margin-top: 50px; color: black;;">Results</h1>
    <?php
    echo '<div id="div1">
            <label for="trips" id="temp">Total Trips Available: ' . $num . ' </label>  
            <label for="date" id="date">Date: ' . $date . '</label>
            </div> ';
    while ($data = mysqli_fetch_assoc($result2)) {
        $departure = $data['departure'];
        $dtime = 'AM';
        if ($departure >= '12:00') $dtime = 'PM';
        $arrival = $data['arrival'];
        $atime = 'AM';
        if ($arrival >= '12:00') $atime = 'PM';
        $bus_id = $data['bus_id'];
        $fare = $data['fare'];
        $sql = "SELECT * FROM `bus_info` WHERE `bus_id`='$bus_id'";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($result);
        $type = strtoupper($data['type']);

        $sql = "SELECT * FROM `ticket_info` WHERE `bus_id`='$bus_id' AND `date`='$date'";
        $result3 = mysqli_query($conn, $sql);
        $rseats = 0;
        while ($data2 = mysqli_fetch_assoc($result3))
            $rseats = $rseats + $data2['seats'];
        $max_seats = $data['max_seats'] - $rseats;
        // echo $rseats;
        if ($max_seats > 0) {
            echo
            '<table>
                    <tr>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Departure</th>
                    <th>Arrival</th>
                    <th>Available seats</th>
                    <th>Bus Type</th>
                    <th>Fare</th> ';
            if ($login) {
                echo  '<th><button onclick="book(' . $bus_id . ');  farecalculate(' . $fare . ')">Book Now</button></th>';
            } else {
                echo '<th><a href="loginpage.php">FIRST YOU HAVE TO LOGIN TO BOOK A TICKET!</a></th>';
            }

            echo '</tr> 
                    <tr>
                    <td>' . $source . '</td>
                    <td>' . $destination . '</td>
                    <td>' . $departure . " " . $dtime . '</td>
                    <td>' . $arrival . " " . $atime . '</td>
                    <td>' . $max_seats . '</td>
                    <td>' . $type . '</td>
                    <td>' . $fare . '</td>
                    </tr>
                    </table>';
        }
    }
    echo '<div id="bookform">
        <div id="sform" onclick="closeform()">&#215</div>
        <form action="payment_form.php" method="POST" onsubmit="return validate(' . $max_seats . ')">
            <label for="busid" class="bform">Bus Id:</label><br>
            <input type="number" id="bus_id" name="bus_id" readonly><br>
            <label for="noseats" class="bform">Enter Number Of Seats:</label><br>
            <input type="number" name="noseats" id="noseat" onkeyup="price()"><br>
            <span id="seaterror">Enter at leat one or equal to available seats</span>
            <label for="totalfare" class="bform">Total Fare:</label><br>
            <input type="number" name="totalfare" id="fare" readonly><br>
            <input type="submit" value="Pay" id="pay">
        </form>
        </div>
        <div id="cover"></div>';
    ?>
    <script>
        function book(bus_id) {
            document.getElementById("bus_id").value = bus_id;
            document.getElementById("bookform").style.display = 'block';
            document.getElementById("cover").style.display = 'block';
        }

        function closeform() {
            document.getElementById("bookform").style.display = 'none';
            document.getElementById("cover").style.display = 'none';
        }

        function farecalculate(fare) {
            document.getElementById("noseat").value = 1;
            document.getElementById("fare").value = fare;
            x = fare;
        }
        var z = 220;
        k = 1001;

        function price(fare) {
            var x = document.getElementById("noseat").value;
            var bus = document.getElementById("bus_id").value;
            if (bus != k) {
                z = document.getElementById("fare").value;
                k = bus;
            }
            var y = x * z;
            document.getElementById("fare").value = y;
        }

        function validate(max_seats) {
            var x = document.getElementById("noseat").value;
            var y = document.getElementById("seaterror");
            if (x <= 0 || x > max_seats) {
                y.style.display = 'block';
                return false;
            } else {
                y.style.display = 'none';
                return true;
            }
        }
    </script>
</body>

</html>