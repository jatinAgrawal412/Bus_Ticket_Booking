<!DOCTYPE html>
<html>

<head>
    <title>
        About us
    </title>
    <link rel="stylesheet" href="nav.css">
    <style type="text/css">
        * {
            margin: 0px;
            padding: 0px;
        }

        body {
            background-color: white;
        }

        #div1 {
            font-size: larger;
        }

        #first {
            margin-top: 2vw;
            text-align: center;
            font-size: 60px;
            font-weight: 900;
        }

        .title {
            margin-top: 2vw;
            margin-bottom: 1vw;
            font-size: xx-large;
            font-weight: 900;
            /* text-align: center; */
        }

        #div2 {
            background-color: rgb(53, 55, 56);
            height: 40vh;
            border-radius: 10px;
            padding: 20px 5px;
        }

        #imge {
            display: flex;
        }
        
        #imge .imgee {
            border: 2px solid black;
            padding: 25px;
            margin: 3px 40px;
            border-radius: 23px;
            background-color: rgb(153, 149, 149);
            font-family: "Bree Serif", serif;
            text-align: center;
            font-size: larger;
            font-weight: bold;
        }

        .imgee img {
            border-radius: 50%;
            height: 20vh;
        }

        #div3 {
            font-size: x-large;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 20px;
            /* background-color: white; */
        }

        #div4 {
            width: 1000px;
            margin-left: 150px;
            border-width: 5px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            /* background-color: white; */
        }
        li {
            list-style: none;
        }
        p {
            margin: 10px;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php';?>
    <h1 id="first">About Us</h1>
    <div id="div4">
        <div id="div1">
            <h2 class="title">Our Services...</h2>
            <ul>
                <li>
                    <p>
                        From this website, you can search the buses according to your convenient.
                        Additionally, you will be able to register a bus ticket according to your choice !!!
                        Our buses are full with grand facilities with AC, very comfortable seats, extra space for your
                        important luggage and also TV in our buses to make your journey with full of entertainment !
                        Under any unexpected circumstances, you can also cancel your tickets and get full refund !
                    </p>
                </li>
                <li>
                    <p>
                        We are providing helpfull and disiplined members at each busport they are ready to guide you any
                        time.
                    </p>
                </li>
                <li>
                    <p>
                        In case of any query,
                        Please feel free to contact us even you can talk with us on our Toll-free no...
                    </p>
                </li>
            </ul>
        </div>
        <h2 class="title">What makes us different...</h2>
        <div id="div2">
            <div id="imge">
                <div class="imgee">
                    <img src="../bus/images/safety.jpg" alt="safety" id="img1"><br>
                    <p>Your safety is our priority</p>
                </div>
                <div class="imgee">
                    <img src="../bus/images/clock.png" alt="clock" id="img2"><br>
                   <p> Fast journey</p>
                </div>
                <div class="imgee">
                    <img src="../bus/images/customercare.jfif" alt="" id="img3"><br>
                    <p>We are ready to help</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html