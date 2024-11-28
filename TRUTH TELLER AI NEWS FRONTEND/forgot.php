<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="image.ico" type="image/x-icon">
</head>
<body>
<img src="background.png" alt="Background Image" class="background-image">
<img src="background2.png" alt="Background Image" class="background-image2">

    <div class="nav">
        <div class="nav-logo">
            <p>Truth Teller AI News</p>
        </div>
        <div class="nav-button">
            <button class="btn white" id="login"  onclick="window.location.href='login.php'">Sign In</button>
            <button class="btn" id="register" onclick="window.location.href='index.html'">Sign Up</button>
        </div>
    </div>

    <div id="reg">
    <form action="" method="POST">
        <input type="text" name="username" placeholder="Username" id="username" required><br>
        <input type="password" name="new_password"  placeholder="New Password" id="username" required><br>
        <input type="password" name="confirm_password"  placeholder="Confirm Password" id="username" required><br>
        <input type="submit" name="submit" value="Reset Password" style="padding: 15px 70px">
    </form>
    </div>
</body>
</html>

   <?php
    // Establish a database connection (adjust these settings as needed)
    $servername = "localhost";
    $username = "root"; // your database username
    $password = ""; // your database password
    $dbname = "news";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if ($new_password === $confirm_password) {
        
            // Update the password in the database
            $sql = "UPDATE register SET password='$new_password' WHERE username='$username'";
            if ($conn->query($sql) === TRUE) {
                echo '<script>alert("Password updated successfully.");</script>';
            } else {
                echo '<script>alert("Error updating password: ' . $conn->error . '");</script>';
            }
        } else {
            echo '<script>alert("New password and confirm password do not match.");</script>';
        }
    }
    $conn->close();
    ?>

    