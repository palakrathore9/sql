<!DOCTYPE html>
<html>
<head>
    <title>SIGN UP</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form action="signup-check.php" method="post" enctype="multipart/form-data" class="form-container">
        <h2>SIGN UP</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>

        <input type="text" name="first_name" placeholder="First Name" required><br>

        <input type="text" name="last_name" placeholder="Last Name" required><br>

        <?php if (isset($_GET['uname'])) { ?>
            <input type="text" name="uname" placeholder="User Name" value="<?php echo $_GET['uname']; ?>" required><br>
        <?php } else { ?>
            <input type="text" name="uname" placeholder="User Name" required><br>
        <?php } ?>

        <?php if (isset($_GET['email'])) { ?>
            <input type="email" name="email" placeholder="Email Id" value="<?php echo $_GET['email']; ?>" required><br>
        <?php } else { ?>
            <input type="email" name="email" placeholder="Email Id" required><br>
        <?php } ?>

        <input type="password" name="password" placeholder="Password" required><br>

        <input type="password" name="re_password" placeholder="Confirm Password" required><br>

        <input type="text" name="address_line1" placeholder="Address Line 1" required><br>

        <input type="text" name="city" placeholder="City" required><br>

        <input type="text" name="state" placeholder="State" required><br>

        <input type="text" name="pincode" placeholder="Pincode" required><br>

        <label for="user_type">User Type:</label>
        <select name="user_type" id="user_type" required>
            <option value="patient">Patient</option>
            <option value="doctor">Doctor</option>
        </select><br>

        <input type="file" name="profile_picture" required><br>

        <button type="submit">Sign Up</button>

        <div class="have-account-container">
            <a href="index.php" class="ca">Already have an account?</a>
        </div>
    </form>
</body>
</html>
