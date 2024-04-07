<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Ride-Hailing Company</title>
    <link rel="stylesheet" href="../css/dashstyle.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar">
            <div class="logo">
                <a href="../admin/admindash.php"><img src="../images/logo.png"></a>
            </div>
            <ul>
                <li><a href="../admin/admindash.php"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="../admin/finddriver.php"><i class="fa-solid fa-magnifying-glass"></i> Find Driver</a></li>
                <li><a href="../admin/viewreports.php"><i class="fas fa-comments"></i></i>View Reports</a></li>
                <li><a href="../admin/addrhs.php"><i class="fas fa-address-card"></i>Add RH Company</a></li>
                <li><a href="../admin/sayfforum.php"><i class="fa-solid fa-users"></i> Forum</a></li>
                <li><a href="../login/logout.php"><i class="fa-solid fa-right-from-bracket"
                            style="margin-top: 135px;"></i> Logout</a></li>
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
                        <a href="../admin/rhsdisplay.php"><button>
                                View <br> Ride-Hailing Companies
                            </button></a>

                    </div>
                    <div class="right-side">
                        <form class="form" id="form">
                            <input type="text" id="compName" name="compname" class="input-field"
                                placeholder="Ride-Hailing Company Name" required>

                            <input type="text" id="compName" name="compname" class="input-field"
                                placeholder="Ride-Hailing Company Location" required>

                            <input type="text" id="contactNum" name="contactNum" class="input-field"
                                placeholder="Contact Number" required>

                            <input type="email" name="compemail" id="compemail"
                                pattern="^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,}$" placeholder="Email">

                            <button type="submit" id="submit">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    <script src="https://kit.fontawesome.com/88061bebc5.js" crossorigin="anonymous"></script>

</body>

</html>