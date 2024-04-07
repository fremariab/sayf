<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Find Driver</title>
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
                <div class="headtext">Find Driver</div>
            </div>
            <div class="info" id="searchinfo">
                <div class="searchboxwrapper" id="searchboxwrapper">
                    <div class="searchboxitem searchboxitem1" style="margin-top:30px;">
                        <div class="searchbox">
                            <input type="text" id="input_search" class="input_search" placeholder="Search Drivers">
                            <span class="icon">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                        </div>
                        <button>Search</button>
                    </div>

                </div>
                <div class="results" id="results"
                    style="width:80%;display: flex;  margin-left:70px;  align-items: center;margin-top:90px;">
                    <center>
                        <h1>
                            Invest in <span class="spec" style="color:#E41D9E">
                                safety
                            </span> today, <br>reap the rewards of tomorrow's peace of mind.
                        </h1>
                    </center>


                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script src="https://kit.fontawesome.com/88061bebc5.js" crossorigin="anonymous"></script>

</body>

</html>