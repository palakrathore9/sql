<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname) || empty($pass)) {
        header("Location: index.php?error=User Name and Password are required");
        exit();
    } else {
        // Fetch the hashed password from the database
        $sql = "SELECT * FROM users WHERE LOWER(user_name) = LOWER('$uname')";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            // Add error logging
            error_log(mysqli_error($conn));
            header("Location: index.php?error=Database error");
            exit();
        }

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if (password_verify($pass, $row['password'])) {
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['id'] = $row['id'];
				$_SESSION['user_type'] = $row['user_type'];

                header("Location: home.php");
                exit();
            } else {
                header("Location: index.php?error=Incorrect User name or password");
                exit();
            }
        } else {
            header("Location: index.php?error=Incorrect User name or password");
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}
?>
