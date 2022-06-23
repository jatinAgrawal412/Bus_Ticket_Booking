<?php
session_start();
$name = $_SESSION['name'];
$pass = $_SESSION['pass'];
?>
<?php
if (!isset($_GET['login']) && !isset($_GET['changePass']) && !isset($_GET['pay']) && !isset($_GET['cancel'])) {
	header("location:loginpage.php");
}
$message = false;
if (isset($_GET['login'])) {
	$message = 'Success! You Are login';
}
if (isset($_GET['pay'])) {
	$message = 'Success! Your Ticket is book.check your mailbox for tickets OR You can download your ticket from your bookings';
}
if (isset($_GET['cancel'])) {
	$message = 'Success! Your Ticket was successfully calnceld';
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	@$old = $_POST['old'];
	if ($old == $pass) {
		$p_id = $_SESSION['p_id'];
		$newpass = $_POST['new1'];
		$conn = mysqli_connect("localhost", "root", "", "bus_project");
		$sql = "UPDATE `user_info` SET `password`='$newpass' WHERE `p_id`='$p_id'";
		$res = mysqli_query($conn, $sql);
		if ($res) {
			$message = "Success! Your password is successfully changed";
		} else {
			$message = "invalid input";
		}
	}
}
?>
<html>

<head>
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="nav.css">
	<style>
		* {
			margin: 0px;
			padding: 0px;
		}

		body {
			background-size: cover;
		}

		.pro {
			display: none;
			position: absolute;
			background-color: #f1f1f1;
			width: 230px;
			margin-left: 1095px;
			border-radius: 15px;
			overflow: auto;
			box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
			z-index: 1;
		}

		.pro a {
			padding: 12px 16px;
			text-decoration: none;
			display: block;
		}

		#mf {
			display: none;
		}

		#a2:hover,
		#a1:hover {
			background-color: rgb(200, 226, 255);
		}

		#profile {
			margin-left: 400px;
			cursor: pointer;
		}

		input {
			margin: 10px;
			padding: 5px;
			border-radius: 5px;
			border: 2px solid black;
		}

		a {
			text-decoration: none;
			color: blue;
		}

		#changeform {
			display: none;
			position: absolute;
			padding: 10px 20px;
			width: 210px;
			height: 350px;
			background-color: white;
			border: 2px solid black;
			border-radius: 10px;
			top: 200px;
			left: 500px;
			right: 0px;
			bottom: 0px;
			z-index: 3;
		}

		.cform {
			padding: 5px;
			font-size: 15px;
			font-weight: bolder;
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

		#status1,
		#status2 {
			display: none;
			color: red;
			font-size: 15px;
			font-weight: bold;
		}

		#change {
			border-radius: 5px;
			font-size: large;
			font-weight: bolder;
			width: 100px;
			text-align: center;
			padding: 5px 5px;
			cursor: pointer;
		}

		#change:hover {
			background-color: black;
			color: white;
		}
	</style>
</head>

<body background=../bus/images/bus.jpeg onload="alerts('<?php echo $message; ?>')">
	<nav class="nav" id="navbar">
		<div id="logo">
			<img src="../bus/images/logo.png" alt="">
		</div>
		<ul>

			<li><a href="booking.php" class="functions"> Booking </a></li>
			<li><a href="cancelticket.php" class="functions"> Cancellation </a></li>
			<li><a href="showbookings.php" class="functions"> My Bookings</a></li>
			<li><a id="profile" onclick="profile()">Profile</a></li>
		</ul>
	</nav>
	<div id="mf" class="pro">
		<a style="font-size: larger; margin-top: 15px; color: brown;">Name: <?php echo $name ?></a>
		<a id="a1" style="font-size: large;color: tomato; cursor:pointer" onclick="change()">Change Your Password</a>
		<a href="logout.php" id="a2" style="color: tomato; font-size: large;">Logout</a>
	</div>
	<div id="changeform">
		<div id="sform" onclick="closeform()">&#215</div>
		<span id="status1">Old Password WRONG!</span>
		<span id="status2">New Passwords Are Not Matching</span>
		<?php echo '<form action="homepage2.php?changePass=true" method="POST" onsubmit="return validate(' . $pass . ')">';  ?>
		<label for="old" class="cform">Old Password:</label><br>
		<input type="password" id="old" name="old"><br>
		<label for="new1" class="cform">Enter New Password:</label><br>
		<input type="password" name="new1" id="new1"><br>
		<label for="new2" class="cform">Re_enter New Password:</label><br>
		<input type="password" name="new2" id="new2"><br>
		<input type="submit" value="Change" id="change">
		</form>
	</div>
	<!-- <div id="cover"></div> -->
	<script>
		function profile() {
			var x = document.getElementById("mf");
			if (x.style.display === "none") {
				x.style.display = "block";
			} else {
				x.style.display = "none";
			}
		}

		function change() {
			document.getElementById("changeform").style.display = 'block';
			// document.getElementById("cover").style.display = 'block';
		}

		function closeform() {
			document.getElementById("changeform").style.display = 'none';
			// document.getElementById("cover").style.display = 'none';
		}

		function validate(oldpass) {
			var x = document.getElementById("old");
			var y = document.getElementById("new1");
			var z = document.getElementById("new2");
			if (x.value != oldpass) {
				document.getElementById("status1").style.display = 'block';
				return false;
			} else if (y.value != z.value) {
				document.getElementById("status2").style.display = 'block';
				return false;
			} else
				return true;
		}

		function alerts(message) {
			console.log('ready');

			if (message) {
				alert(message);
			}
		}
	</script>
</body>

</html>