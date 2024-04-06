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
    echo json_encode($data);
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

    if (empty(trim($username))) {
        return error422("Enter your username");

    } else if (empty(trim($password))) {
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
                    'error' => 'Email is not registered.',
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

        // if ($result) {
        //     $data = [
        //         'status' => 201,
        //         'message' => 'User Created Successfully',
        //     ];
        //     header("HTTP/1.0 201 User Created Successfully");
        //     return json_encode($data);

        // } else {
        //     $data = [
        //         'status' => 500,
        //         'message' => 'Internal Serval Error',
        //     ];
        //     header("HTTP/1.0 500 Internal Serval Error");
        //     return json_encode($data);
        // }
    }

}