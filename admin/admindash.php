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
    <title>Admin Home</title>
    <link rel="stylesheet" href="../css/dashstyle.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <style>
        .quick-actions {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 20px;
        }

        .quick-actions a {
            text-decoration: none;
            color: #333;
        }

        .quick-action {
            width: 200px;
            height: 200px;
            background-color: #f2f2f2;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .quick-action:hover {
            background-color: #e0e0e0;
            transform: translateY(-5px);
        }

        .quick-action i {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .quick-action span {
            font-size: 18px;
            font-weight: bold;
        }
    </style>
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
                <?php if ($gender == 2 || $user_role == 1) { ?> <li><a href="../view/sayfforum.php"><i class="fa-solid fa-users"></i> Forum</a></li>
                <?php } ?> <li><a href="../login/logout.php"><i class="fa-solid fa-right-from-bracket" style="margin-top: 135px;"></i> Logout</a></li>
            </ul>

        </div>
        <div class="main_content">
            <div class="header">
                <div class="headtext">Admin Home</div>
            </div>
            <div class="info">
                <div class="quick-actions">
                    <a href="../view/finddriver.php" class="quick-action">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span>Find Driver</span>
                    </a>
                    <a href="../admin/addrhc.php" class="quick-action">
                        <i class="fas fa-comments"></i>
                        <span>Add RHC Driver</span>
                    </a>
                    <a href="../view/rhcdisplay.php" class="quick-action">
                        <i class="fas fa-address-card"></i>
                        <span>View RHC</span>
                    </a>
                    <a href="../view/sayfforum.php" class="quick-action">
                        <i class="fa-solid fa-users"></i>
                        <span>Forum</span>
                    </a>
                    <a href="../view/viewreports.php" class="quick-action">
                        <i class="fas fa-eye"></i>
                        <span>View Reports</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/88061bebc5.js" crossorigin="anonymous"></script>

</body>

</html>