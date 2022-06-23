<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Querypage</title>
    <link rel="stylesheet" href="nav.css" />
    <style>
      * {
        margin: 0px;
        padding: 0px;
      }
      body {
          background-color: rgb(47, 42, 42);
          color: white;
      }
      span {
        text-transform: capitalize;
        color: red;
        margin: 20px;
        cursor: pointer;
      }
      p {
        visibility: hidden;
        margin: 20px 40px;
      }
      input:hover {
        background-color: rgb(215, 178, 250);
      }
      #first {
        margin-top: 50px;
      }
    </style>
  </head>
  <body>
  <?php include 'navbar.php';?>
    <div id="main">
      <div id="first" class="question">
        <span onclick="f1()">Q.How Does This Website Work?</span>
        <p id="f1" class="cl">
          Ans: Create an account using your email,mobile number and others
          necessary information.All booking informations will be sent on your
          e-mail id.You can forwardthe message to your co-passanger or friend,if
          you have booked on behalf of them...
        </p>
      </div>
      <div class="question">
        <span onclick="f2()">Q.How Can I Get My Bus Ticket?</span>
        <p id="f2" class="cl">
          Ans: We will send you e-pdf of your ticket on your e-mail id..
        </p>
      </div>
      <div class="question">
        <span onclick="f3()">Q.Is There Any Registration Fess?</span>
        <p id="f3" class="cl">
          Ans: No,thre is no registration fee on our websites
        </p>
      </div>
      <div class="question">
        <span onclick="f4()">Q.Is My Information Safe?</span>
        <p id="f4" class="cl">
          Ans: Your personal and travel details are safe and we dont't share it
          with any third party agencies...
        </p>
      </div>
      <div class="question">
        <span onclick="f5()">Q.Forgot My Password?What Next?</span>
        <p id="f5" class="cl">
          Ans: At the time of login you will get an option of "forgot password?"
          just click on it and follow the process.You will get your password on
          provided e-mail id..
        </p>
      </div>
      <div class="question">
        <span onclick="f6()">Q.Can I Change The Ticket Deatails?</span>
        <p id="f6" class="cl">
          Ans: No, partial cancellation is not suppported...
        </p>
      </div>
    </div>
    <script>
      function gen() {
        var t = document.querySelectorAll(".cl");
        for (i = 0; i < 6; i++) t[i].style.visibility = "hidden";
      }
      function f1() {
        gen();
        var t = document.getElementById("f1");
        t.style.visibility = "visible";
      }
      function f2() {
        gen();
        var t = document.getElementById("f2");
        t.style.visibility = "visible";
      }
      function f3() {
        gen();
        var t = document.getElementById("f3");
        t.style.visibility = "visible";
      }
      function f4() {
        gen();
        var t = document.getElementById("f4");
        t.style.visibility = "visible";
      }
      function f5() {
        gen();
        var t = document.getElementById("f5");
        t.style.visibility = "visible";
      }
      function f6() {
        gen();
        var t = document.getElementById("f6");
        t.style.visibility = "visible";
      }
    </script>
  </body>
</html>
