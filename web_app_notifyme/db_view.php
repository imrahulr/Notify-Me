<html>

<head>
    <!--meta http-equiv="refresh" content="10"-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script>
        $(document).ready(function() {
            //$('#notification_holder).css({ 'color': 'white', 'face' = 'Comic Sans MS'});
            $('#notification_holder').load('db_check.php');
            setInterval(function() {
                $('#notification_holder').load('db_check.php');
            }, 5000);
            $.ajaxSetup({ cache: false});
        });
    </script>
</head>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_notifyme";

?>

<body style="background-color:black">

    <font face="Comic Sans MS" size="6" color="white"><span id="datetime" style="float:right">
    </span></font>
    
    <script>
    setInterval(function() {
        var dt = new Date();
        document.getElementById("datetime").innerHTML = (("0"+dt.getDate()).slice(-2)) +"/"+ (("0"+(dt.getMonth()+1)).slice(-2)) +"/"+ (dt.getFullYear()) +"<br>"+ (("0"+dt.getHours()).slice(-2)) +":"+ (("0"+dt.getMinutes()).slice(-2));
    }, 1000);
    </script>
    
    <span style="float:left"><font face="Comic Sans MS" size="6" color="white">Notifications</font></span>
    <br><br><br><br><br>

    <!-- weather widget start --><a target="_blank" href="http://www.booked.net/weather/mumbai-26831"><img src="https://w.bookcdn.com/weather/picture/32_26831_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=80015"  alt="booked.net" style="float: right" /></a><!-- weather widget end -->
        
    <span id = "notification_holder" style="float:left"><font face="Comic Sans MS" color="white" >
    </font></span>

</body>

</html>