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
        <div class="sidebar">
            <div class="logo">
                <a href="../admin/admindash.php"><img src="../images/logo.png"></a>
            </div>
            <ul>
                <li><a href="../admin/admindash.php"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="../admin/finddriver.php"><i class="fa-solid fa-magnifying-glass"></i> Find Driver</a></li>
                <li><a href="../admin/viewreports.php"><i class="fas fa-comments"></i></i>View Reports</a></li>
                <li><a href="../admin/addrhc.php"><i class="fas fa-address-card"></i>Add RH Company</a></li>
                <li><a href="../admin/sayfforum.php"><i class="fa-solid fa-users"></i> Forum</a></li>
                <li><a href="../login/logout.php"><i class="fa-solid fa-right-from-bracket"
                            style="margin-top: 135px;"></i> Logout</a></li>
            </ul>

        </div>
        <div class="main_content">
            <div class="header">
                <div class="headtext">All Ride-Hailing Companies</div>
            </div>
            <div class="info">
                <table>
                    <thead>
                        <tr>
                            <th>Ride-Hailing Company Name</th>
                            <th>Location</th>
                            <th>Contact Number</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody id="display_rhc_data">

                        <!-- <tr>
                            <td colspan=4>
                                <center> No results found.
                                </center>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    <script src="https://kit.fontawesome.com/88061bebc5.js" crossorigin="anonymous"></script>
    <script src="../js/viewrhc.js">
        // const urlParams = new URLSearchParams(window.location.search);
        // const data = decodeURIComponent(urlParams.get('data'));

    </script>
</body>

</html>