<?php
session_start();
include "db_conn.php";

if (
    isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['re_password']) &&
    isset($_POST['first_name']) && isset($_POST['last_name']) &&
    isset($_POST['email']) && isset($_POST['address_line1']) && isset($_POST['city']) &&
    isset($_POST['state']) && isset($_POST['pincode'])
) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);
    $re_pass = validate($_POST['re_password']);
    $first_name = validate($_POST['first_name']);
    $last_name = validate($_POST['last_name']);
    $email = validate($_POST['email']);
    $address_line1 = validate($_POST['address_line1']);
    $city = validate($_POST['city']);
    $state = validate($_POST['state']);
    $pincode = validate($_POST['pincode']);

    // Handle profile picture upload
    $profile_picture = null;
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
        $profile_picture_name = $_FILES['profile_picture']['name'];
        $profile_picture_tmp = $_FILES['profile_picture']['tmp_name'];
        $profile_picture = 'uploads/' . $profile_picture_name;
        move_uploaded_file($profile_picture_tmp, $profile_picture);
    }

    $user_data = "uname=$uname&first_name=$first_name&last_name=$last_name&email=$email&address_line1=$address_line1&city=$city&state=$state&pincode=$pincode";

    if (
        empty($uname) || empty($pass) || empty($re_pass) || empty($first_name) ||
        empty($last_name) || empty($email) || empty($address_line1) || empty($city) ||
        empty($state) || empty($pincode)
    ) {
        header("Location: signup.php?error=All fields are required&$user_data");
        exit();
    } elseif ($pass !== $re_pass) {
        header("Location: signup.php?error=The confirmation password does not match&$user_data");
        exit();
    } else {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

        // Update the SQL query and table structure
        $sql = "INSERT INTO users(user_name, password, first_name, last_name, email, address_line1, city, state, pincode, profile_picture) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "ssssssssss", $uname, $hashed_password, $first_name, $last_name, $email, $address_line1, $city, $state, $pincode, $profile_picture);

        // Execute the prepared statement
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            header("Location: signup.php?success=Your account has been created successfully");
            exit();
        } else {
            header("Location: signup.php?error=Unknown error occurred&$user_data");
            exit();
        }
    }
} else {
    header("Location: signup.php");
    exit();
}
?>
