<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Review Driver</title>
    <link rel="stylesheet" href="../css/dashstyle.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

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
                <div class="headtext">Review Driver</div>
            </div>
            <div class="info">
                <div class="reptform">
                    <div class="left-side">
                        <i class="fa-brands fa-speakap" style="color:#54177c; font-size: 200px"></i>
                        <div class="shorttext">
                            Be a part of something bigger.
                            <br><br>
                            Make others safe by <span class="spec" style="color:#E41D9E">
                                saying if</span>.
                        </div>
                    </div>
                    <div class="right-side">
                        <p>Your feedback is invaluable in ensuring a safe and enjoyable experience for all passengers.
                        </p>
                        <form class="form" id="form" action="../action/reviewdriver_action.php">
                            <input type="text" id="firstName" name="fname" class="input-field" placeholder="Driver First Name" required>

                            <input type="text" id="lastName" name="lname" class="input-field" placeholder="Driver Last Name">
                            <div class="radio">
                                <input type="radio" name="gender" id="gender-male" checked="checked" value="1" />
                                <label for="gender-male">Male</label>
                                <input type="radio" name="gender" id="gender-female" value="2" />
                                <label for="gender-female">Female</label>
                            </div>
                            <input type="text" name="phone_number" id="phone_number" pattern="^\(?\d{1,3}\)?[- ]?\d{3}[- ]?\d{3}[- ]?\d{4}$" placeholder="Phone Number">
                            <select id="rideHailingCompany" name="ride_hailing_company" required>
                                <option value="" selected disabled>Select Ride-Hailing Company</option>
                            </select>
                            <input type="text" id="carMake" name="make" class="input-field" placeholder="Make" required>

                            <input type="text" id="carModel" name="model" class="input-field" placeholder="Model">

                            <input type="text" id="carColor" name="color" class="input-field" placeholder="Color" required>

                            <input type="text" id="plateNumber" name="plate_number" class="input-field" pattern="^[A-Z]{2,3}-\d{1,4}-[A-Z]?$|^[\d]{1,4}-[A-Z]{2,3}-[A-Z]?$|^[A-Z]{1,2}-\d{1,4}$" placeholder="Car Plate Number" required>
                            <div class="ratingsstar">
                                <div class="rating-box">
                                    <header>How was your experience?</header>
                                    <div class="stars">
                                        <i class="fa-solid fa-star" id="star1"></i>
                                        <i class="fa-solid fa-star" id="star2"></i>
                                        <i class="fa-solid fa-star" id="star3"></i>
                                        <i class="fa-solid fa-star" id="star4"></i>
                                        <i class="fa-solid fa-star" id="star5"></i>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <label for="review">Review Description:</label>
                            <br>

                            <textarea id="ReviewDescription" name="review_description" required></textarea>
                            <br>
                            <button type="submit" id="submit">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="../js/rating.js"></script>
    <script>
        $(document).ready(function() {
            // AJAX request to fetch ride-hailing company names
            $.ajax({
                url: '../actions/viewrhc_action.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $.each(response, function(index, comid) {
                        $('#rideHailingCompany').append($('<option>', {
                            value: comid,
                            text: comid
                        }));
                    })


                    response = data;

                    let result = "";

                    response.data.forEach((element) => {
                        result += "<option>";
                        result += element.comid + "</option>";
                    });
                    document.getElementById("#rideHailingCompany").innerHTML += result;;
                },
                error: function(error) {
                    // Handle error
                    console.error('Error fetching ride-hailing companies:', error);
                }
            });
        });
    </script>
    <script src="../js/reviewdriver.js"></script>
    <script src="https://kit.fontawesome.com/88061bebc5.js" crossorigin="anonymous"></script>
</body>

</html>