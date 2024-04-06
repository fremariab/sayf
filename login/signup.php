<!-- signup.php  -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Signup</title>
    <link rel="stylesheet" href="../css/signupstyle.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

</head>

<body>
    <div class="logo">
        <img src="../images/logo.png" alt="site logo" height="150px">
    </div>
    <div class="parent">
        <div class="container">
            <div class="registration form">
                <header>Signup</header>
                <form method="post">
                    <div id="error" class="error"></div>
                    <input type="text" name="uname" id="uname" pattern="[^[a-zA-Z0-9]+([._]?[a-zA-Z0-9]+)*$"
                        placeholder="Username">
                    <div class="radio-container">
                        <label style="color:gray;" for="gender">Gender </label>
                    </div>
                    <div class="radio">
                        <input type="radio" name="gender" id="gender-male" checked="checked" value="1" />
                        <label for="gender-male">Male</label>
                        <input type="radio" name="gender" id="gender-female" value="2" />
                        <label for="gender-female">Female</label>
                    </div>

                    <input type="text" name="phone_number" id="phone_number"
                        pattern="^\(?\d{1,3}\)?[- ]?\d{3}[- ]?\d{3}[- ]?\d{4}$" placeholder="Phone Number">

                    <input type="email" name="register_email" id="register_email"
                        pattern="^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,}$" placeholder="Email">

                    <input type="password" name="register_password" id="register_password"
                        pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                        placeholder="Password">

                    <input type="password" name="register_password1" id="register_password1"
                        pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                        placeholder="Confirm Password">

                    <button type="submit" class="button" name="submit_button" id="submit">Sign Up</button>

                </form>
                <div class="signup">
                    <span class="signup">Already have an account?
                        <label for="check" style="color:#1C402E;"><a href="../login/login.php">Login</a></label>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/signup.js"></script>

</body>

</html>