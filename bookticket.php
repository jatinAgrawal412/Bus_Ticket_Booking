<?php
    session_start();
    $conn=mysqli_connect("localhost","root","","bus_project");
    $ticket_id=rand(1,112);
    $p_id=$_SESSION['p_id'];
    $date=$_SESSION['date'];
    $bus_id=$_POST['bus_id'];
    $seats=$_POST['noseats'];
    $fare=$_POST['totalfare'];
    echo $bus_id."  ".$p_id;
    $sql="INSERT INTO `ticket_info` (`ticket_id`, `p_id`, `bus_id`, `seats`,`total_fare`, `date`, `bookingdate`) VALUES ('$ticket_id', '$p_id', '$bus_id', '$seats','$fare', '$date', current_timestamp())";
    while($result=mysqli_query($conn,$sql)==false)
    {
        $ticket_id=rand(1,100);
    }
    $_SESSION['ticket']=$ticket_id;

    header("location:sendTicket.php");
?>
