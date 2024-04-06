<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login </title>
    <link rel="stylesheet" href="../css/loginstyle.css">
</head>

<body>
    <div class="parent">

        <div class="logo">
            <img src="../images/logo.png" alt="site logo" height="150px">
        </div>
        <div class="container" style="float: right;">
            <input type="checkbox" id="check">
            <div class="login form">
                <header>Login</header>
                <form method="post">
                    <input type="text" placeholder="Enter your username" name="username" id="username">
                    <input type="password" placeholder="Enter your password" name="passwrd" id="password">
                    <button type="submit" class="button" id="submit" name="submit_button">Login</button>
                </form>
                <div class="signup">
                    <span class="signup">Don't have an account?
                        <label for="check"><a href="signup.php">Signup<a></label>
                    </span>
                </div>
            </div>

        </div>
    </div>
    <script src="../js/login.js"></script>

</body>

</html>