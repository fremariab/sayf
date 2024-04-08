<?php
/*functions.php */

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

function viewRideHailingCompanies()
{
    global $conn;

    $sql = "SELECT * FROM People";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $final_result = mysqli_fetch_all($result, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'User List Found',
                'data' => $final_result
            ];
            header("HTTP/1.0 200 User List Found");
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
function addRideHailingCompany($input_data)
{
    global $conn;

    function validate($data)
    {
        global $conn;

        $data = trim($data);
        $data = stripslashes($data);
        $data = mysqli_escape_string($conn, $data);
        return $data;
    }


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

    function validate($data)
    {
        global $conn;

        $data = trim($data);
        $data = stripslashes($data);
        $data = mysqli_escape_string($conn, $data);
        return $data;
    }


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

    function validate($data)
    {
        global $conn;

        $data = trim($data);
        $data = stripslashes($data);
        $data = mysqli_escape_string($conn, $data);
        return $data;
    }


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
                    $data = [
                        'status' => 200,
                        'message' => 'User Loggged in Successfully',
                        'user_id' => $_SESSION['user_role']
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