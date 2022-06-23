<?php
session_start();
$error = false;
$message = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost", "root", "", "bus_project");
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $sql = "SELECT * FROM `user_info` WHERE `uname`='$uname'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    $data = mysqli_fetch_assoc($result);
    if ($num == 1) {
        if ($data['password'] == $pass) {
            $_SESSION['logged'] = true;
            $_SESSION['p_id'] = $data['p_id'];
            $_SESSION['name'] = $data['name'];
            $_SESSION['pass'] = $data['password'];
            $_SESSION['uname'] = $data['uname'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['mobile'] = $data['mobileno'];
            $login = true;
            header("location:homepage2.php?login=${login}");
        } else
            $error = true;
    } else
        $error = true;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>
        Login Page
    </title>
    <style type="text/css">
        * {
            margin: 0px;
            padding: 0px;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f7f7f7;
            min-height: 100vh;
        }

        fieldset {
            width: 30vw;
            position: relative;
            border: 2px solid black;
            border-radius: 20px;
            border-width: 2px;
            border-style: solid;
            background-color: white;
            font-size: larger;
            box-shadow: 5px 5px 0px black;
            background-color: #fff;
        }

        form {
            padding: 25px 30px;
        }

        #uname,
        #password {
            margin: 20px 10px;
            padding: 5px;
            border-radius: 5px;
            border-width: 1px;
        }

        a {
            text-decoration: none;
        }

        #submitbutton {
            margin-bottom: 20px;
            height: 35px;
            width: 100px;
            border-radius: 20px;
            border-width: 1px;
            box-shadow: 0 2px #999;
            cursor: pointer;
            font-weight: bold;
            font-size: large;
        }

        #submitbutton:hover {
            background-color: rgb(220, 220, 221);
        }

        #submitbutton:active {
            box-shadow: 0 1px #999;
            transform: translateY(2px);
        }

        span {
            color: red;
            font-weight: normal;
            font-size: 20px;
        }

        label {
            font-weight: bolder;
        }
    </style>
</head>

<body>
    <div id="main">
        <fieldset>
            <?php
            if ($error)
                echo '<br><span>&nbsp;&nbsp;&nbsp;Inavalid Username Or Password</span>';
            ?>
            <legend style="font-size: larger; color: black; font-weight: bolder;">Login Your Self</legend>
            <form action="loginpage.php" method="POST" target="_self" name="loginform">
                <div class="field input">
                    <label for="uname">Username:</label>
                    <input type="text" placeholder="Enter Your Username" name="uname" id="uname" required><br>
                </div>

                <div class="field input">
                    <label for="password">Password:</label>
                    <input type="password" placeholder="Enter Your Password" name="pass" id="password" required><br>
                </div>
                <div class="field button">
                    <input type="submit" value="Login" id="submitbutton"><br>
                </div>
                <div class="link">Not yet signed up? <a href="registrationpage.php">Signup Now</a></div>
            </form>
        </fieldset>
    </div>
</body>

</html>