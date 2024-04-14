<?php
/*functions.php */
session_start();

require '../settings/connection.php';
function error422($message)
{
    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header("HTTP/1.0 422 Unprocessable Entity");
    return json_encode($data);
}

function likePost($input_data)
{
    global $conn;

    if (!empty($input_data->posid)) {
        $posid = $input_data->posid;

        // Insert into UserEngagement table
        $uid = getUserId(); // Assuming you have a function to get the user ID
        $createdon = date("Y-m-d H:i:s");
        $sql = "INSERT INTO UserEngagement (uid, posid, createdon) VALUES ('$uid', '$posid', '$createdon')";
        if (!mysqli_query($conn, $sql)) {
            $data = [
                'status' => 500,
                'message' => 'Failed to like the post',
            ];
            http_response_code(500);
            echo json_encode($data);
            return;
        }

        // Count number of engagements for the post
        $sql = "SELECT COUNT(*) AS engagement_count FROM UserEngagement WHERE posid = '$posid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $engagement_count = $row['engagement_count'];

        $data = [
            'status' => 200,
            'message' => 'Post liked successfully',
            'engagement_count' => $engagement_count,
        ];
        http_response_code(200);
        echo json_encode($data);
    } else {
        $data = [
            'status' => 400,
            'message' => 'Missing post ID',
        ];
        http_response_code(400);
        echo json_encode($data);
    }
}

function viewIncidentReport()
{
    global $conn;

    $sql = "SELECT * FROM IncidentReport LEFT JOIN Driver ON  IncidentReport.did = Driver.did 
    LEFT JOIN User ON  IncidentReport.uid = User.uid
    LEFT JOIN DriverServiceAssignment ON  IncidentReport.did = DriverServiceAssignment.did
    LEFT JOIN RideHailingCompany ON  DriverServiceAssignment.comid = RideHailingCompany.comid";
    $result = mysqli_query($conn, $sql);
    $user_role = $_SESSION['user_role'];
    $user_id = $_SESSION['user_id'];

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $final_result = mysqli_fetch_all($result, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'Incident Report List Found',
                'data' => $final_result,
                'user_role' => $user_role,
                'user_id' => $user_id
            ];
            header("HTTP/1.0 200 Incident Report Found");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No Reports Found',
            ];
            header("HTTP/1.0 404 No Reports Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Serval Error',
        ];
        header("HTTP/1.0 500 Internal Serval Error");
        return json_encode($data);
    }
}
function viewDriverList()
{
    global $conn;

    $sql = "SELECT * FROM Driver";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $final_result = mysqli_fetch_all($result, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'Driver List Found',
                'data' => $final_result
            ];
            header("HTTP/1.0 200 Driver List Found");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No Drivers Found',
            ];
            header("HTTP/1.0 404 No Drivers Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Serval Error',
        ];
        header("HTTP/1.0 500 Internal Serval Error");
        return json_encode($data);
    }
}

function deleteReview($input_data)
{
    global $conn;
    $reviewId = $input_data->revid;

    $sql = "DELETE FROM DriverReviews WHERE revid='$reviewId'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $data = [
            'status' => 201,
            'message' => 'Review Deleted Successfully',
        ];
        header("HTTP/1.0 201 Review Deleted Successfully");
        return json_encode($data);
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Serval Errorr',
        ];
        header("HTTP/1.0 500 Internal Serval Errorr");
        return json_encode($data);
    }
}
function editReview($input_data)
{
    global $conn;

    $rating = validate($input_data->rating);
    $reviewDescription = validate($input_data->reviewDescription);
    $reviewId = $input_data->revid;

    if (empty($reviewDescription)) {
        return error422("Review Description can't be blank");
    } else {
        if (empty($rating)) {
            $rating = 1;
        }

        $sql = "UPDATE DriverReviews SET rating='$rating', review_text='$reviewDescription' WHERE revid='$reviewId'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $data = [
                'status' => 201,
                'message' => 'Review Updated Successfully',
            ];
            header("HTTP/1.0 201 Review Updated Successfully");
            return json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Serval Errorr',
            ];
            header("HTTP/1.0 500 Internal Serval Errorr");
            return json_encode($data);
        }
    }
}
function pagereviewDriver($input_data)
{
    global $conn;

    $rating = validate($input_data->rating);
    $driverID = $input_data->driverId;
    $reviewDescription = validate($input_data->reviewDescription);


    if (empty($reviewDescription)) {
        return error422("Review Description can't be blank");
    } else {
        if (empty($rating)) {
            $rating = 1;
        }

        $user_id = $_SESSION['user_id'];
        $sql = "INSERT INTO DriverReviews(uid,did,rating,review_text) VALUES('$user_id','$driverID','$rating','$reviewDescription')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $data = [
                'status' => 201,
                'message' => 'Review Inserted Successfully',
            ];
            header("HTTP/1.0 201 Review Inserted Successfully");
            echo json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Serval Errorr',
            ];
            header("HTTP/1.0 500 Internal Serval Errorr");
            return json_encode($data);
        }
    }
}
function reportIncident($input_data)
{
    global $conn;

    $selectedDriver = validate($input_data->selectedDriver);
    $incidentDate = validate($input_data->incidentDate);
    $incidentDescription = validate($input_data->incidentDescription);


    if (empty($selectedDriver)) {
        return error422("Selected Driver can't be blank");
    } else  if (empty($incidentDescription)) {
        return error422("Incident Description can't be blank");
    } else  if (empty($incidentDate)) {
        return error422("Incident Date can't be blank");
    } else {

        $user_id = $_SESSION['user_id'];
        $sql = "INSERT INTO IncidentReport(uid,did,report_description,incident_date) VALUES('$user_id','$selectedDriver','$incidentDescription','$incidentDate')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $data = [
                'status' => 201,
                'message' => 'Incident Inserted Successfully',
            ];
            header("HTTP/1.0 201 Incident Inserted Successfully");
            echo json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Serval Errorr',
            ];
            header("HTTP/1.0 500 Internal Serval Errorr");
            return json_encode($data);
        }
    }
}

function getDriverReviews($input_data)
{
    global $conn;
    $driverId =  $input_data->driverId;

    $sql = "SELECT * FROM DriverReviews WHERE did='$driverId' ORDER BY did DESC";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $final_result = mysqli_fetch_all($result, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'Driver Reviews Found',
                'data' => $final_result,
                'user_id' => $_SESSION['user_id'],
            ];
            header("HTTP/1.0 200 Driver Reviews Found");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No Reviews Found',
            ];
            header("HTTP/1.0 404 No Reviews Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Serval Error',
        ];
        header("HTTP/1.0 500 Internal Serval Error");
        return json_encode($data);
    }
}
function getDriverDetails($input_data)
{
    global $conn;
    $driverId =  $input_data->driverId;
    $sql = "
    SELECT 
            Driver.did,
            Driver.fname AS driver_fname,
            Driver.lname AS driver_lname,
            Driver.tel AS driver_tel,
            Driver.gender as gender,
            Car.make AS car_make,
            Car.model AS car_model,
            Car.color AS car_color,
            Car.plate_number,
            RideHailingCompany.company_name,
            ROUND(AVG(DriverReviews.rating), 0) AS average_rating,
            COUNT(DriverReviews.rating) AS review_count
        FROM 
            Driver
        LEFT JOIN 
            Car ON Driver.carid = Car.carid
        LEFT JOIN 
            RideHailingCompany ON Driver.comid = RideHailingCompany.comid
        LEFT JOIN 
            DriverReviews ON Driver.did = DriverReviews.did
        WHERE 
            Driver.did='$driverId'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $final_result = mysqli_fetch_assoc($result);

            $data = [
                'status' => 200,
                'message' => 'Driver Details Found',
                'data' => $final_result,
                'driverId' => $driverId
            ];
            header("HTTP/1.0 200 Driver Details Found");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No Driver Found',
            ];
            header("HTTP/1.0 404 No Driver Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Serval Error',
        ];
        header("HTTP/1.0 500 Internal Serval Error");
        return json_encode($data);
    }
}
function getProfile()
{
    global $conn;
    $userid = $_SESSION['user_id'];
    $sql = "SELECT User.*, DriverReviews.*, Post.*, COUNT(DriverReviews.revid) AS reviewcount,
    COUNT(Post.posid) AS postcount
    FROM User 
    LEFT JOIN DriverReviews ON User.uid = DriverReviews.uid 
    LEFT JOIN Post ON User.uid = Post.creator 
    WHERE User.uid = '$userid'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $final_result = mysqli_fetch_assoc($result);

            $data = [
                'status' => 200,
                'message' => 'Profile Details Found',
                'data' => $final_result,
                'user_id' => $userid
            ];
            header("HTTP/1.0 200 Profile Details Found");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No Profile Found',
            ];
            header("HTTP/1.0 404 No Profile Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Serval Error',
        ];
        header("HTTP/1.0 500 Internal Serval Error");
        return json_encode($data);
    }
}

function searchDrivers($input_data)
{
    global $conn;
    $keyword = validate($input_data->keyword);

    if (empty($keyword)) {
        return error422("Search field can't be blank");
    } else {
        $sql = "
        SELECT 
            Driver.did,
            Driver.fname AS driver_fname,
            Driver.lname AS driver_lname,
            Driver.tel AS driver_tel,
            Car.make AS car_make,
            Car.model AS car_model,
            Car.color AS car_color,
            Car.plate_number,
            RideHailingCompany.company_name,
            ROUND(AVG(DriverReviews.rating), 0) AS average_rating,
            COUNT(DriverReviews.rating) AS rating_count,
            COUNT(IncidentReport.repid) AS incident_reports
        FROM 
            Driver
        LEFT JOIN 
            Car ON Driver.carid = Car.carid
        LEFT JOIN 
            RideHailingCompany ON Driver.comid = RideHailingCompany.comid
        LEFT JOIN 
            DriverReviews ON Driver.did = DriverReviews.did
        LEFT JOIN 
    IncidentReport ON Driver.did = IncidentReport.did
        WHERE 
            Driver.fname LIKE '%$keyword%' OR
            Driver.lname LIKE '%$keyword%' OR
            Car.plate_number LIKE '%$keyword%' OR
            CONCAT(Driver.fname, ' ', Driver.lname) LIKE '%$keyword%' OR
            CONCAT(Driver.lname, ' ', Driver.fname) LIKE '%$keyword%'
        GROUP BY 
            Driver.did
        ";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $final_result = mysqli_fetch_all($result, MYSQLI_ASSOC);

                $data = [
                    'status' => 200,
                    'message' => 'Driver List Found',
                    'data' => $final_result
                ];
                header("HTTP/1.0 200 Driver List Found");
                return json_encode($data);
            } else {
                $data = [
                    'status' => 404,
                    'message' => 'No Drivers Found',
                ];
                header("HTTP/1.0 404 No Drivers Found");
                return json_encode($data);
            }
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Serval Error',
            ];
            header("HTTP/1.0 500 Internal Serval Error");
            return json_encode($data);
        }
    }
}

function deletePost($input_data)
{
    global $conn;
    $posid = $input_data->posid;

    $sql = "DELETE FROM Post WHERE posid='$posid'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $data = [
            'status' => 201,
            'message' => 'Post Deleted Successfully',
        ];
        header("HTTP/1.0 201 Post Deleted Successfully");
        return json_encode($data);
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Serval Errorr',
        ];
        header("HTTP/1.0 500 Internal Serval Errorr");
        return json_encode($data);
    }
}

function getPosts()
{
    global $conn;
    $sql = "SELECT * FROM Post ORDER BY posid DESC";
    $result = mysqli_query($conn, $sql);
    $final_result = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if ($result) {
        $data = [
            'status' => 201,
            'message' => 'Post List Found',
            'data' => $final_result,
            'user_id' => $_SESSION['user_id']

        ];
        header("HTTP/1.0 201 Post List Not Found");
        return json_encode($data);
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Serval Errorr',

        ];
        header("HTTP/1.0 500 Internal Serval Errorr");
        return json_encode($data);
    }
}
function reviewDriver($input_data)
{
    global $conn;
    $dfname = validate($input_data->dfname);
    $dlname = validate($input_data->dlname);
    $contactNum = validate($input_data->contactNum);
    $gender = validate($input_data->gender);
    $rating = validate($input_data->rating);
    $rhcomp = validate($input_data->rhcomp);
    $carMake = validate($input_data->carMake);
    $carModel = validate($input_data->carModel);
    $carColor = validate($input_data->carColor);
    $plateNumber = validate($input_data->plateNumber);
    $reviewDescription = validate($input_data->reviewDescription);

    if (empty($dfname)) {
        return error422("Driver First Name can't be blank");
    } else if (empty($dlname)) {
        return error422("Driver Last Name can't be blank");
    } else if (empty($contactNum)) {
        return error422("Phone Number can't be blank");
    } else if (empty($gender)) {
        return error422("Gender can't be blank");
    } else if (empty($rhcomp)) {
        return error422("Ride-Hailing Company Name can't be blank");
    } else if (empty($carMake)) {
        return error422("Car Make can't be blank");
    } else if (empty($carModel)) {
        return error422("Car Model can't be blank");
    } else if (empty($carColor)) {
        return error422("Car Color can't be blank");
    } else if (empty($plateNumber)) {
        return error422("Car Plate Number can't be blank");
    } else if (empty($reviewDescription)) {
        return error422("Review Description can't be blank");
    } else {
        if (empty($rating)) {
            $rating = 1;
        }
        $sql = "SELECT * FROM Car where  make='$carMake' and model='$carModel' and color='$carColor' and plate_number='$plateNumber'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $count_cars = mysqli_num_rows($result);
            if ($count_cars == 0) {
                $sql = "INSERT INTO Car(make,model,color,plate_number) VALUES('$carMake','$carModel', '$carColor','$plateNumber')";
                $result2 = mysqli_query($conn, $sql);
                if ($result2) {
                    $sql = "SELECT * FROM Car ORDER BY carid DESC LIMIT 1";
                    $result3 = mysqli_query($conn, $sql);
                    $car = mysqli_fetch_assoc($result3);
                    $car_id = $car['carid'];


                    if ($result3) {
                        $sql1 = "SELECT carid FROM Driver where comid='$rhcomp'and  carid='$car_id' and fname='$dfname' and lname='$dlname' and tel='$contactNum'";
                        $result4 = mysqli_query($conn, $sql1);

                        $count_drivers = mysqli_num_rows($result4);
                        if ($count_drivers == 0) {

                            $sql2 = "INSERT INTO Driver(gender,fname,lname,tel,carid,comid) VALUES('$gender','$dfname','$dlname', '$contactNum','$car_id','$rhcomp')";
                            $result5 = mysqli_query($conn, $sql2);



                            if ($result5) {

                                $sql = "SELECT did FROM Driver ORDER BY did DESC LIMIT 1";
                                $resultt = mysqli_query($conn, $sql);
                                $driver = mysqli_fetch_assoc($resultt);
                                $did = $driver['did'];

                                $sql3 = "INSERT INTO DriverServiceAssignment(did,comid) VALUES('$did','$rhcomp')";
                                $result6 = mysqli_query($conn, $sql3);
                                $user_id = $_SESSION['user_id'];
                                $sql4 = "INSERT INTO DriverReviews(uid,did,rating,review_text) VALUES('$user_id','$did','$rating','$reviewDescription')";
                                $result7 = mysqli_query($conn, $sql4);

                                if ($result6 && $result7) {
                                    $data = [
                                        'status' => 201,
                                        'message' => 'Driver and Car Data Inserted Successfully',
                                        'driverId' => $did
                                    ];
                                    header("HTTP/1.0 201 Driver and Car Data Inserted Successfully");
                                    echo json_encode($data);
                                }
                            } else {
                                $data = [
                                    'status' => 500,
                                    'message' => 'Internal Server Error',
                                ];
                                header("HTTP/1.0 500 Internal Server Error");
                                echo json_encode($data);
                            }
                        } else {
                            $data = [
                                'status' => 422,
                                'message' => 'Driver already exists',
                            ];
                            header("HTTP/1.0 422 Driver already exists");
                            echo json_encode($data);
                        }
                    }
                } else {
                    $data = [
                        'status' => 500,
                        'message' => 'Internal Server Error',
                    ];
                    header("HTTP/1.0 500 Internal Server Error");
                    echo json_encode($data);
                }
            } else {
                $data = [
                    'status' => 422,
                    'message' => 'Car already exists',
                ];
                header("HTTP/1.0 422 Car already exists");
                echo json_encode($data);
            }
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode($data);
        }
    }
}
function viewRideHailingCompanies()
{
    global $conn;

    $sql = "SELECT * FROM RideHailingCompany";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $final_result = mysqli_fetch_all($result, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'RHC List Found',
                'data' => $final_result
            ];
            header("HTTP/1.0 200 RHC List Found");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No Users Found',
            ];
            header("HTTP/1.0 404 No Users Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Serval Error',
        ];
        header("HTTP/1.0 500 Internal Serval Error");
        return json_encode($data);
    }
}

function validate($data)
{
    global $conn;

    $data = trim($data);
    $data = stripslashes($data);
    $data = mysqli_escape_string($conn, $data);
    return $data;
}

function addPost($input_data)
{
    global $conn;

    $posttext = validate($input_data->postText);
    $creator = $_SESSION['user_id'];

    if (empty($posttext)) {
        return error422("Enter the post text");
    } else {



        $sql = "INSERT INTO Post(creator,post_text,date_posted) VALUES('$creator','$posttext', NOW())";
        $result2 = mysqli_query($conn, $sql);

        $sql = "SELECT * FROM Post";
        $result3 = mysqli_query($conn, $sql);


        $final_result = mysqli_fetch_all($result3, MYSQLI_ASSOC);

        if ($result2) {
            $data = [
                'status' => 201,
                'message' => 'Post Added Successfully',
                'data' => $final_result
            ];
            header("HTTP/1.0 201 Post Added Created Successfully");
            return json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Serval Errorr',
            ];
            header("HTTP/1.0 500 Internal Serval Errorr");
            return json_encode($data);
        }
    }
}


function addRideHailingCompany($input_data)
{
    global $conn;

    $compname = validate($input_data->compname);
    $comploc = validate($input_data->comploc);
    $contactNum = validate($input_data->contactNum);
    $compemail = validate($input_data->compemail);

    if (empty($compname)) {
        return error422("Enter the name");
    } else if (empty($compemail)) {
        return error422("Enter the email");
    } else if (empty($comploc)) {
        return error422("Enter the location");
    } else if (empty($contactNum)) {
        return error422("Enter the contact number");
    } else {
        $sql = "SELECT * FROM RideHailingCompany where company_name='$compname'";
        $result = mysqli_query($conn, $sql);

        if ($result) {

            $count_companies = mysqli_num_rows($result);
            if ($count_companies == 0) {

                $sql = "INSERT INTO RideHailingCompany(company_name,location,contact_number,email) VALUES('$compname','$comploc', '$contactNum','$compemail')";
                $result2 = mysqli_query($conn, $sql);

                $sql = "SELECT * FROM RideHailingCompany";
                $result3 = mysqli_query($conn, $sql);


                $final_result = mysqli_fetch_all($result3, MYSQLI_ASSOC);

                if ($result2) {
                    $data = [
                        'status' => 201,
                        'message' => 'Ride-Hailing Company Created Successfully',
                        'data' => $final_result
                    ];
                    header("HTTP/1.0 201 Ride-Hailing Company Created Successfully");
                    return json_encode($data);
                }
            } else {
                $data = [
                    'status' => 424,
                    'message' => 'This user already exists',
                ];
                header("HTTP/1.0 424 This user already exists");
                return json_encode($data);
            }
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Serval Errorr',
            ];
            header("HTTP/1.0 500 Internal Serval Errorr");
            return json_encode($data);
        }
    }
}
function signupUser($user_data)
{
    global $conn;




    $username = validate($user_data->username);
    $phone_number = validate($user_data->phone_number);
    $register_email = validate($user_data->register_email);
    $register_password = validate($user_data->register_password);
    $register_password1 = validate($user_data->register_password1);
    $gender = validate($user_data->gender);

    if (empty($username)) {
        return error422("Enter your username");
    } else if (empty($phone_number)) {
        return error422("Enter your phone number");
    } else if (empty($register_email)) {
        return error422("Enter your email");
    } else if (empty($register_password)) {
        return error422("Enter your password");
    } else if (empty($register_password1)) {
        return error422("Enter your confirmed password");
    } else if (empty($gender)) {
        return error422("Select a gender");
    } else {
        $sql = "SELECT * FROM User where email='$register_email'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $count_email = mysqli_num_rows($result);
            if ($count_email == 0) {
                if ($register_password == $register_password1) {
                    $hash = password_hash($register_password, PASSWORD_DEFAULT);

                    $sql = "INSERT INTO User(rid,username,gender,tel,email,passwd) VALUES(3,'$username','$gender', '$phone_number','$register_email','$hash')";
                    $result2 = mysqli_query($conn, $sql);

                    if ($result2) {
                        $data = [
                            'status' => 201,
                            'message' => 'User Created Successfully',
                        ];
                        header("HTTP/1.0 201 User Created Successfully");
                        return json_encode($data);
                    }
                } else {
                    $data = [
                        'status' => 424,
                        'message' => 'Passwords do not match',
                    ];
                    header("HTTP/1.0 424 Passwords do not match");
                    return json_encode($data);
                }
            } else {
                $data = [
                    'status' => 424,
                    'message' => 'This user already exists',
                ];
                header("HTTP/1.0 424 This user already exists");
                return json_encode($data);
            }
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Serval Errorr',
            ];
            header("HTTP/1.0 500 Internal Serval Errorr");
            return json_encode($data);
        }
    }
}

function loginUser($user_data)
{
    global $conn;




    $username = validate($user_data->username);
    $password = validate($user_data->password);

    if (empty($username)) {
        return error422("Enter your username");
    } else if (empty($password)) {
        return error422("Enter your password");
    } else {
        $sql = "SELECT * FROM User where username='$username'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                if (password_verify($password, $row['passwd'])) {
                    $_SESSION['user_id'] = $row['uid'];
                    $_SESSION['user_role'] = $row['rid'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['gender'] = $row['gender'];

                    $data = [
                        'status' => 200,
                        'message' => 'User Loggged in Successfully',
                        'user_id' => $_SESSION['user_id'],
                        'user_role' => $_SESSION['user_role']
                    ];
                    header("HTTP/1.0 200 User Created Successfully");
                    return json_encode($data);
                } else {
                    $data = [
                        'error' => 'Incorrect password.',
                        'url' => '../login/login_view.php'
                    ];
                    return json_encode($data);
                }
            } else {
                $data = [
                    'error' => 'Username is not registered.',
                    'url' => '../login/login_view.php'
                ];
                return json_encode($data);
            }
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Serval Errorr',
            ];
            header("HTTP/1.0 500 Internal Serval Errorr");
            return json_encode($data);
        }
    }
}
