<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "bus_project");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ticket_id = $_POST['download'];
    if ($ticket_id) {
        $nodata = false;
        $p_id = $_SESSION['p_id'];
        $sql = "SELECT * FROM `ticket_info` WHERE `ticket_id`= ' $ticket_id ' ";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num == 0)
            $nodata = true;
        if (!$nodata) {
            $data = mysqli_fetch_assoc($result);

            $bus_id = $data['bus_id'];
            $total_seats = $data['seats'];
            $fare = $data['total_fare'];
            $date = $data['date'];

            $sql = "SELECT * FROM `bus_route` WHERE `bus_id`='$bus_id'";
            $result2 = mysqli_query($conn, $sql);
            if ($result2) {
                $data2 = mysqli_fetch_assoc($result2);
                $departure = $data2['departure'];
                $dtime = 'AM';
                if ($departure > '12:00') $dtime = 'PM';
                $arrival = $data2['arrival'];
                $atime = 'AM';
                if ($departure > '12:00') $atime = 'PM';
                $route_id = $data2['route_id'];
                $sql = "SELECT * FROM `route_info` WHERE `route_id`='$route_id'";
                $result2 = mysqli_query($conn, $sql);
                if ($result2) {
                    $data2 = mysqli_fetch_assoc($result2);
                    $source = $data2['source'];
                    $destination = $data2['destination'];
                    $source = ucfirst($source);
                    $destination = ucfirst($destination);
                    $html =
                        '
                        <div id="logo">
                        <img src="logo.png" alt="">
                        </div>
                        <h1 style="text-align:center;"><b>Your Ticket</b></h1>
                    <br>
                            <dl>
                            <dt>Name :</dt>
                            <dd>'.$_SESSION['name'].'</dd>
                            <dt>Mobile No. :</dt>
                            <dd>'.$_SESSION['mobile'].'</dd>
                            <dt>Origin :</dt>
                            <dd>' . $source . '</dd>
                            <dt>Destination :</dt>
                            <dd>' . $destination . '</dd>
                            <dt>Departure :</dt>
                            <dd>' . $departure . " " . $dtime . '</dd>
                            <dt>Arrival :</dt>
                            <dd>' . $arrival . " " . $atime . '</dd>
                            <dt>Total Seats :</dt>
                            <dd>' . $total_seats . '</dd>
                            <dt>Fare :</dt> 
                            <dd>' . $fare . '</dd>
                            <dt>Date :</dt>
                            <dd>' . $date . '</dd>
                            </dl>';

                            require_once __DIR__ . '/vendor/autoload.php';

        $mpdf = new \Mpdf\Mpdf();
        $stylesheet = file_get_contents('ticket.css');

        $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);

        $mpdf->WriteHTML($html);

        $mpdf->Output('abc.pdf', 'D');
        header("location:showbookings.php");

                }
            } else {
                echo "SORRY no data was retrive try after some time<br>";
            }
        } else
            echo 'NO DATA FOUND !!';
    }
}
