<!-- login.php  -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login </title>
    <link rel="stylesheet" href="../css/loginstyle.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
</head>

<body>
    <div class="parent">

        <div class="logo">
            <img src="../images/logo.png" alt="site logo" height="150px">
        </div>
        <div class="container" style="float: right;">
            <input type="checkbox" id="check">
            <div class="form">
                <header>Login</header>
                <form method="post">
                    <div id="error" class="error"></div>

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
    <script>

    </script>
    <script src="../js/login.js"></script>

</body>

</html>