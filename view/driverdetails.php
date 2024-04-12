<?php
include "../settings/core.php";
ifLoggedIn();
$user_role = getUserRole();
$user_id = getUserID();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Driver Detail</title>
    <link rel="stylesheet" href="../css/dashstyle.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <?php if ($user_role == 1) { ?>
            <div class="sidebar">
                <div class="logo">
                    <a href="../admin/admindash.php"><img src="../images/logo.png"></a>
                </div>
                <ul>
                    <li><a href="../admin/admindash.php"><i class="fas fa-home"></i>Home</a></li>
                    <li><a href="../view/finddriver.php"><i class="fa-solid fa-magnifying-glass"></i> Find Driver</a></li>
                    <li><a href="../view/viewreports.php"><i class="fas fa-comments"></i></i>View Reports</a></li>
                    <li><a href="../admin/addrhc.php"><i class="fas fa-address-card"></i>Add RH Company</a></li>
                    <li><a href="../view/sayfforum.php"><i class="fa-solid fa-users"></i> Forum</a></li>
                    <li><a href="../login/logout.php"><i class="fa-solid fa-right-from-bracket" style="margin-top: 135px;"></i> Logout</a></li>
                </ul>
            </div>
        <?php } else { ?>
            <div class="sidebar">
                <div class="logo">
                    <a href="../view/userdash.php"><img src="../images/logo.png"></a>
                </div>
                <ul>
                    <li><a href="../view/userdash.php"><i class="fas fa-home"></i>Home</a></li>
                    <li><a href="../view/userprofile.php"><i class="fas fa-user"></i>Profile</a></li>
                    <li><a href="../view/finddriver.php"><i class="fa-solid fa-magnifying-glass"></i> Find Driver</a></li>
                    <li><a href="../view/reviewdriver.php"><i class="fas fa-comments"></i></i>Review Driver</a></li>
                    <li><a href="../view/reportinc.php"><i class="fas fa-address-card"></i>Report Incident</a></li>
                    <li><a href="../view/viewreports.php"><i class="fas fa-eye"></i> View Reports</a></li>
                    <li><a href="../view/sayfforum.php"><i class="fa-solid fa-users"></i> Forum</a></li>
                    <li><a href="../login/logout.php"><i class="fa-solid fa-right-from-bracket" style="margin-top: 15px;"></i> Logout</a></li>
                </ul>
            </div>
        <?php } ?>
        <div class="main_content">
            <div class="header">
                <div class="headtext">Driver Detail</div>
            </div>
            <div class="info">
                <div class="userprof">
                    <div class="username" id="username">
                        <h1 id="drivername"> </h1>
                        <span id="contact"> </span>
                        <span> | </span>
                        <span id="gender"> </span>
                    </div>
                    <div class="profdescription">
                        <p id="cardetails"> </p>
                        <p id="carplate"> </p>
                        <p id="rhcomp"> </p>
                    </div>
                    <ul class="profstats">
                        <li><span id="numreviews"> </span>Review(s)</li>
                        <li><span id="avgrating"> </span>Average Rating</li>
                    </ul>
                    <div class="reviewbutton" id="reviewbutton" style="display:flex;margin-top:10px;justify-content:center;">
                    </div>
                    <div id="reviews">
                    </div>
                    <i class="fas fa-arrow-up" class="backToTopBtn" id="backToTopBtn" style="color:white;background-color:#54177c;float:right;width:30px;height:30px;font-size:27px"></i>

                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://kit.fontawesome.com/88061bebc5.js" crossorigin="anonymous"></script>
    <script src="../js/driverdetails.js"> </script>
    <script src="../js/driverreviews.js"> </script>
    <script>
        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) {
                    $('#backToTopBtn').fadeIn();
                } else {
                    $('#backToTopBtn').fadeOut();
                }
            });

            $('#backToTopBtn').click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 'slow');
            });
        });
    </script>
    <script scr="../js/deletereview.js">

    </script>
</body>

</html>