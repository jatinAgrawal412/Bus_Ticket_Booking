<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();
$conn = mysqli_connect("localhost", "root", "", "bus_project");
if (isset($_SESSION['ticket'])) {
    $ticket_id = $_SESSION['ticket'];
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
                    $email = $_SESSION['email'];
                    // echo $email;
                    $source = ucfirst($source);
                    $destination = ucfirst($destination);
                    $html =
                        '
                        <div id="logo">
                        <img src="logo.png" alt="">
                        </div>
                        <h1 style="text-align:center;"><b>Your Ticket</b></h1>
                    <br>
                        <h1 style="margin-left:100px; margin-top: 50px; color: black; font-weight:bolder">Name : </h1>
                        
                            <dl>
                            <dt>Name :</dt>
                            <dd>' . $_SESSION['name'] . '</dd>
                            <dt>Mobile No. :</dt>
                            <dd>' . $_SESSION['mobile'] . '</dd>
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

                    $pdf = $mpdf->Output('', 'S');

                    require 'PHPMailer/src/Exception.php';
                    require 'PHPMailer/src/PHPMailer.php';
                    require 'PHPMailer/src/SMTP.php';
                    $mail = new PHPMailer(true);

                    try {


                        $mail->isSMTP();
                        $mail->Host       = 'smtp.gmail.com';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'ajagrawal412@gmail.com';
                        $mail->Password   = 'mqvfanrmivzaoxei';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                        $mail->Port       = 465;


                        $mail->setFrom('ajagrawal412@gmail.com', 'Tickets');

                        $mail->addAddress($email);

                        //Attechments
                        $mail->addStringAttachment($pdf, 'invoice.pdf');



                        $mail->isHTML(true);
                        $mail->Subject = "Happy Bus Ticket booking Service";
                        $mail->Body    = "Enjoy your trip. Your Ticket was attech in this mail.";
                        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                        $mail->send();
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }

                header("location:homepage2.php?pay=true");
            }
        } else {
            echo "SORRY no data was retrive try after some time<br>";
        }
    } else
        echo 'NO DATA FOUND !!';
}
