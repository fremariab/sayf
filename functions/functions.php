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
                        'message' => 'Incorrect password',
                    ];
                    header("HTTP/1.0 424 Incorrect password");
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