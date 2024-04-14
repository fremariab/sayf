<?php
include "../settings/core.php";

ifLoggedIn();
$user_role = getUserRole();
$user_id = getUserID();
if ($user_role != 1) {
    header("Location: ../view/userdash.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Ride-Hailing Company</title>
    <link rel="stylesheet" href="../css/dashstyle.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

</head>

<body>
    <div class="wrapper">
        <div class="sidebar">
            <div class="logo">
                <a href="../admin/admindash.php"><img src="../images/logo.png"></a>
            </div>
            <ul>
                <li><a href="../admin/admindash.php"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="../view/finddriver.php"><i class="fa-solid fa-magnifying-glass"></i> Find Driver</a></li>
                <li><a href="../view/viewreports.php"><i class="fas fa-comments"></i></i>View Reports</a></li>
                <li><a href="../admin/addrhc.php"><i class="fas fa-address-card"></i>Add RH Company</a></li>
                <li><a href="../admin/sayfforum.php"><i class="fa-solid fa-users"></i> Forum</a></li>
                <li><a href="../login/logout.php"><i class="fa-solid fa-right-from-bracket" style="margin-top: 135px;"></i> Logout</a></li>
            </ul>
        </div>
        <div class="main_content">
            <div class="header">
                <div class="headtext">Add Ride-Hailing Company</div>
            </div>
            <div class="info">
                <div class="reptform">
                    <div class="left-side">
                        <i class="fa-solid fa-eye" style="color:#54177c; font-size: 200px"></i>
                        <div class="shorttext">
                        </div>
                        <a href="../admin/rhcdisplay.php"><button>
                                View <br> Ride-Hailing Companies
                            </button></a>

                    </div>
                    <div class="right-side">
                        <form class="form" id="form">
                            <div id="error" class="error"></div>
                            <div id="success" class="success"></div>
                            <input type="text" id="compname" name="compname" class="input-field" placeholder="Ride-Hailing Company Name" required>

                            <input type="text" id="comploc" name="comploc" class="input-field" placeholder="Ride-Hailing Company Location" required>
                            <input type="text" name="contactNum" id="contactNum" pattern="^\(?\d{1,3}\)?[- ]?\d{3}[- ]?\d{3}[- ]?\d{4}$" placeholder="Contact Number">

                            <input type="email" name="compemail" id="compemail" pattern="^[\w.-]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}$" placeholder="Email">

                            <button type="submit" id="submit">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    <script src="https://kit.fontawesome.com/88061bebc5.js" crossorigin="anonymous"></script>
    <script src="../js/addrhc.js"></script>
</body>

</html>