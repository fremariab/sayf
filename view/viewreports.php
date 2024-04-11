<!-- rhcdisplay.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>All Ride-Hailing Companies</title>
    <link rel="stylesheet" href="../css/dashstyle.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

</head>

<body>
    <div class="wrapper">
        <?php if ($_SESSION['user_role'] == 1) { ?>
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
            <?php } ?>
            <div class="main_content">
                <div class="header">
                    <div class="headtext">View Reports</div>
                </div>
                <div class="info">
                    <table>
                        <thead>
                            <tr>
                                <?php session_start();
                                if ($_SESSION['user_role'] == 1) { ?>
                                    <th>User Email</th>
                                <?php } ?>

                                <th>Driver</th>
                                <th>Company</th>
                                <th>Incident Date</th>
                                <th>Incident Description</th>

                            </tr>
                        </thead>
                        <tbody id="display_report_data">


                        </tbody>
                    </table>
                </div>
            </div>
            </div>
            <script src="https://kit.fontawesome.com/88061bebc5.js" crossorigin="anonymous"></script>
            <script src="../js/viewreport.js">

            </script>
</body>

</html>