<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="image.ico" type="image/x-icon">
    <title>Login Form</title>
</head>
<body id="login-page">
<img src="background.png" alt="Background Image" class="background-image">
<img src="background2.png" alt="Background Image" class="background-image2">

    <div class="nav">
        <div class="nav-logo">
            <p>Truth Teller AI News</p>
        </div>
        <div class="nav-button">
            <button class="btn white" id="login">Sign In</button>
            <button class="btn" id="register" onclick="window.location.href='index.html'">Sign Up</button>
        </div>
    </div>

    <div id="reg">
        <form action="login.php" method="post">
            <input type="text" id="username" name="username" placeholder="Username" required><br>
            <input type="password" id="password" name="password" placeholder="Password" required><br>
            <p class="forgot-password">Forgot your password? <a href="forgot.php">Reset Password</a></p>
            <input type="submit" name="login" value="Login">
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js"
    integrity="sha512-gmwBmiTVER57N3jYS3LinA9eb8aHrJua5iQD7yqYCKa5x6Jjc7VDVaEA0je0Lu0bP9j7tEjV3+1qUm6loO99Kw=="
    ></script>
<script src="./loadingscript.js"></script>

</body>
</html>

<?php
session_start();

// Connect to the database (replace with your database credentials)
$conn = mysqli_connect("localhost", "pma", "", "news");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, username, password, usertype FROM register WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    
        if ($password == $row["password"]) {
            // Login successful
            $_SESSION["username"] = $row["username"];
            $_SESSION["usertype"] = $row["usertype"];
    
            if ($_SESSION["usertype"] == "admin") {
                header("Location: dashboard.php");
                exit();
            } else {
                header("Location: user_home.php");
                exit();
            }
        } else {
            echo "Invalid password"; // Passwords do not match
        }
    } else {
        echo "User not found"; // User not found
    }
}

// Close the database connection
mysqli_close($conn);
?>
