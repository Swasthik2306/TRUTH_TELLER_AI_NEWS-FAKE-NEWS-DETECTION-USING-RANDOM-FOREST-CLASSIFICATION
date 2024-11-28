<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hostname = "localhost";  // Change this if your database is hosted elsewhere
    $username = "pma";       // Your MySQL username
    $password = "";           // Your MySQL password
    $database = "news";      // Your database name

    $conn = new mysqli($hostname, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $user_type = $_POST["user_type"];

    $sql = "INSERT INTO register (fname, lname, username, email, password, usertype)
            VALUES ('$first_name', '$last_name', '$username', '$email', '$password', '$user_type')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the login page with a success message
        header("Location: login.php?registration_success=1");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
