<!DOCTYPE html>
<html>
<head>
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <form action="login.php" method="post" class="form-container">
        <h2>LOGIN</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <input type="text" name="uname" placeholder="User Name"><br>
        
        <input type="password" name="password" placeholder="Password"><br>

        <button type="submit">Login</button>
        
        <div class="create-account-container">
            <a href="signup.php" class="ca">Create an account</a>
        </div>
     </form>
</body>
</html>
