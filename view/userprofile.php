<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="../css/dashstyle.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar">
            <div class="logo">
                <a href="../view/userdash.php"><img src="../images/logo.png"></a>
            </div>
            <ul>
                <li><a href="../view/userdash.php"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="../view/userprofile.php"><i class="fas fa-user"></i>Profile</a></li>
                <li><a href="../view/finddriver.php"><i class="fa-solid fa-magnifying-glass"></i> Find Driver</a></li>
                <li><a href="../view/reportinc.php"><i class="fas fa-address-card"></i>Report Incident</a></li>
                <li><a href="../view/sayfforum.php"><i class="fa-solid fa-users"></i> Forum</a></li>
                <li><a href="../login/logout.php"><i class="fa-solid fa-right-from-bracket"
                            style="margin-top: 135px;"></i> Logout</a></li>

            </ul>

        </div>
        <div class="main_content">
            <div class="header">
                <div class="headtext">User Profile</div>
            </div>
            <div class="info">
                <div class="title">@username</div>
                <table>
                    <tbody>
                        <tr>
                            <td class="label">Full Name</td>
                            <td id="fullname" class="value"> Jacob Azuma</td>
                        </tr>
                        <tr>
                            <td class="label">Gender</td>
                            <td id="gender" class="value"> Male</td>
                        </tr>
                        <tr>
                            <td class="label">Phone Number</td>
                            <td id="number" class="value"> Male</td>
                        </tr>
                        <tr>
                            <td class="label">Email</td>
                            <td id="email" class="value"> Male</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/88061bebc5.js" crossorigin="anonymous"></script>

</body>

</html>