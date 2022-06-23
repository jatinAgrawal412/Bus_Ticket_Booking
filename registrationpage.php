<?php
$error = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost", "root", "", "bus_project");
    $uname = $_POST['Uname'];
    $sql = "SELECT * FROM `user_info` WHERE `uname`='$uname'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1)
        $error = true;
    else {
        $name = $_POST['Name'];
        $pass = $_POST['Pass1'];
        $gender = $_POST['Gender'];
        $age = $_POST['Age'];
        $email = $_POST['Email'];
        $mobile = $_POST['Mobileno'];
        $sql = "INSERT INTO `user_info` (`name`, `uname`, `password`, `gender`, `age`, `email`, `mobileno`, `date`) VALUES ('$name', '$uname', '$pass', '$gender', '$age', '$email', '$mobile', current_timestamp())";
        $res = mysqli_query($conn, $sql);
        if($res){
            header("location:homepage.php?sign=true");
        }
        else{
            echo '<script>alert("invalid inputs or try again after some time");</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>
        User Registration Page
    </title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js" type="text/javascript">
    </script>
    <script src="registrationpage.js"></script>
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
            background-color: white;
            position: relative;
            padding: 20px;
            border: 2px solid black;
            border-radius: 20px;
            border-width: 2px;
            box-shadow: 5px 5px 0px black;
            height: 70vh;
        }

        #registerbutton,
        #reset_regis_form {
            margin-top: 10px;
            margin-bottom: 20px;
            margin-left: 25px;
            height: 35px;
            width: 100px;
            font-weight: bolder;
            border-radius: 20px;
            border-width: 1px;
            box-shadow: 0 2px #999;
            cursor: pointer;
        }

        #registerbutton {
            margin-left: 25%;
        }

        input,
        select {
            margin: 10px 0px;
            padding: 2px;
            border-radius: 5px;
            font-size: large;
        }

        #registerbutton:hover,
        #reset_regis_form:hover {
            background-color: rgb(158, 188, 226);
        }

        #registerbutton:active,
        #reset_regis_form:active {
            box-shadow: 0 1px #999;
            transform: translateY(4px);
        }

        label {
            font-weight: bolder;
            font-size: larger;
        }

        span {
            color: red;
            margin-left: 120px;
            font-size: 11px;
            font-weight: bolder;
            font-family: sans-serif;
        }

        #echo {
            margin-left: 20px;
            color: red;
            font-weight: bold;
            font-size: 15px;
        }

        #veml {
            display: none;
        }
    </style>
</head>

<body>
    <div ng-app="ctrl" ng-controller="control" ng-init="check=false;" id="main">
        <fieldset>
            <legend style="font-size: x-large; color: black;"><b> Register Your Self </b></legend>
            <?php
            if ($error)
                echo '<span id="echo">Username Has Already Been Taken</span>';
            ?>
            <form action="registrationpage.php" method="POST" name="registrationform" onsubmit="return check_validation()">
                <label for="name">Name:</label>
                <input type="text" placeholder="Enter Your Name" name="Name" id="name" required ng-model="Name" ng-click="show1()"><br>
                <span ng-show="enbl1 && registrationform.Name.$error.required">Required Field<br></span>
                <label for="username">Username:</label>
                <input type="text" id="username" name="Uname" placeholder="Enter Your Username" required ng-click="show2()" ng-model="Uname"><br>
                <span ng-show="enbl2 && registrationform.Uname.$error.required">Required Field<br></span>
                <label for="Password"> Password:</label>
                <input type="password" name="Pass1" placeholder="Enter Your Password" id="Password" required ng-click="show3()" ng-model="Pass1"><br>
                <span ng-show="enbl3 && registrationform.Pass1.$error.required">Required Field<br></span>
                <label for="confirm_Password">Confirm-Password:</label>
                <input type="password" name="Pass2" placeholder="Re-enter Your Password" id="confirm_Password" required ng-click="show4()" ng-model="Pass2"><br>
                <span ng-show="enbl4 && registrationform.Pass2.$error.required">Required Field<br></span>
                <label for="Gender"> Gender:</label>
                <input type="radio" value="Male" name="Gender"> Male
                <input type="radio" value="Female" name="Gender"> Female
                <input type="radio" value="Other" name="Gender"> Other<br>
                <label for="age">Age:</label>
                <input type="number" maxlength="100" name="Age" id="age"> <br>
                <label for="useremail">Email-Address:</label>
                <input type="email" name="Email" id="useremail" ng-model="Email" ng-click="show5()" placeholder="abcd@gmail.com" required onkeyup="validate_email()"><br>
                <span ng-show="enbl5 && registrationform.Email.$error.required">Required Field<br></span>
                <span id="veml">Please,Enter Validate Email</span>
                <label for="countrycode">Mobile number:</label>
                <select name="Countrycode" id="countrycode">
                    <option value="+91" selected>+91</option>
                </select>
                <input type="number" name="Mobileno" id="mobileno" required maxlength="10" ng-click="show6()" ng-model="Mobileno"><br>
                <span ng-show="enbl6 && registrationform.Mobileno.$error.required">Required Field<br></span>
                <span ng-show="enbl6 && registrationform.Mobileno.$error.maxlength">Enter,10 Digit Only<br></span>
                <input type="checkbox" name="Done" ng-model="check"> I hereby declare the above filled information is right.<br>
                <input type="submit" value="Register" id="registerbutton" name="submit_register" ng-disabled="!check">
                <input type="reset" name="Reset" id="reset_regis_form">
            </form>
        </fieldset>
    </div>
    <script>
        function check_validation() {
            var x = confirm("Are You Sure To Continue..?");
            if (x) {
                if (name_lenght()) {
                    if (confirmpass()) {
                        if (radio_checked()) {
                            if (validate_email()) {
                                if (age()) {
                                    return mobileno_length();
                                } else
                                    return false;
                            } else
                                return false;
                        } else
                            return false;
                    } else
                        return false;
                } else
                    return false;
            } else
                return false;
        }

        function confirmpass() {
            var r = /^\d{4,8}$/;
            var x = document.getElementById("Password");
            var y = document.getElementById("confirm_Password");
            if (x.value != y.value) {
                alert("Passwords Are Not Matching!!");
                return false;
            } else if (r.test(x.value) == false) {
                alert("Enter valid Password!!");
                return false;
            } else
                return true;
        }

        function radio_checked() {
            var check = document.getElementsByName("Gender");
            if (check[0].checked == "" && check[1].checked == "" && check[2].checked == "") {
                alert("Please,Select Your Gender");
                return false;
            } else
                return true;
        }

        function validate_email() {
            var eml = document.getElementById("useremail").value;
            var r = /^[a-zA-Z0-9_]+@[a-zA-z0-9_]+\.[a-z]{2,4}$/;
            var t = document.getElementById('veml');
            if (!(eml.match(r))) {
                t.style.display = 'block';
                return false;
            } else {
                t.style.display = 'none';
                return true;
            }
        }

        function mobileno_length() {
            var t = document.getElementById("mobileno").value;
            if (t.length > 10)
                return false;
            return true;
        }

        function name_lenght() {
            var n = document.getElementById('name').value;
            var r = /^[a-zA-Z]+\s[a-zA-Z]+$/;
            if (!n.match(r)) {
                alert('Enter valid name');
                return false;
            } else
                return true;
        }

        function age() {
            var n = document.getElementById('age').value;
            var r = /^(0?[1-9]|[1-9]?[0-9])$/;
            if (!n.match(r)) {
                alert('Enter valid age');
                return false;
            } else
                return true;
        }
    </script>
</body>

</html>