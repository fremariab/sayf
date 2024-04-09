<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
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
        <li><a href="../view/reviewdriver.php"><i class="fas fa-comments"></i></i>Review Driver</a></li>
        <li><a href="../view/reportinc.php"><i class="fas fa-address-card"></i>Report Incident</a></li>
        <li><a href="../view/sayfforum.php"><i class="fa-solid fa-users"></i> Forum</a></li>
        <li><a href="../login/logout.php"><i class="fa-solid fa-right-from-bracket" style="margin-top: 135px;"></i> Logout</a></li>
      </ul>
    </div>
    <div class="main_content">
      <div class="header">
        <div class="headtext">User Dashboard</div>
      </div>
      <div class="info">
        <div class="dashb" id="dashb">
          <div class="notif" id="notif">
            <div class="head" id="head" style="font-weight:bold; font-size:30px;color:#54177c; margin-bottom: 30px; ">Notifications</div>
            <div class="notif_item like_item">
              <div class="icon">
                <i class="fa-solid fa-heart"></i>
              </div>
              <div class="text">
                <h3>New Like!</h3>
                <p>You received a like on post1.</p>
              </div>

            </div>
            <div class="notif_item cmnt_item">
              <div class="icon">
                <i class="fa-solid fa-comment-dots"></i>
              </div>
              <div class="text">
                <h3>New Comment!</h3>
                <p>You received a comment on post1.</p>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <script src="https://kit.fontawesome.com/88061bebc5.js" crossorigin="anonymous"></script>

</body>

</html>