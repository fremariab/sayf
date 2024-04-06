<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Side Navigation Bar</title>
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
                <div class="left-side">
                    <div class="address details">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="topic">Address</div>
                        <div class="text-one">Surkhet, NP12</div>
                        <div class="text-two">Birendranagar 06</div>
                    </div>
                    <div class="phone details">
                        <i class="fas fa-phone-alt"></i>
                        <div class="topic">Phone</div>
                        <div class="text-one">+0098 9893 5647</div>
                        <div class="text-two">+0096 3434 5678</div>
                    </div>
                    <div class="email details">
                        <i class="fas fa-envelope"></i>
                        <div class="topic">Email</div>
                        <div class="text-one">codinglab@gmail.com</div>
                        <div class="text-two">info.codinglab@gmail.com</div>
                    </div>
                </div>
                <div class="right-side">
                    <div class="topic-text">Send us a message</div>
                    <p>If you have any work from me or any types of quries related to my tutorial, you can send me
                        message from here. It's my pleasure to help you.</p>
                    <form action="#">
                        <div class="input-box">
                            <input type="text" placeholder="Enter your name">
                        </div>
                        <div class="input-box">
                            <input type="text" placeholder="Enter your email">
                        </div>
                        <div class="input-box message-box">

                        </div>
                        <div class="button">
                            <input type="button" value="Send Now">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/88061bebc5.js" crossorigin="anonymous"></script>

</body>

</html>