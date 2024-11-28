<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home1.css">
    <link rel="icon" href="image.ico" type="image/x-icon">
    <title>user home page</title>
    <style>
        body {
            font-family: 'Lora', serif;
            font-weight: 600;
        }
        table {
            position: relative;
            border-collapse: collapse;
            width: 100%;
            height: 30px;
            justify-content: center;
            align-items: center;
        }
        th, td {
            text-align: center; /* Center the cell content */
            font-size: 20px;
            height: 60px;
            padding: 5px;
        }
        th {
            font-weight: 800;
        }
        .profile-photo {
            width: 440px; /* Reduced width to align the table more to the left */
            height: 440px;
            padding: 5px;
            display: inline-block;
            vertical-align: middle;
        }
        .profile-photo img {
            width: 100%;
            height: 100%;
        }

    </style>
</head>
<body>
    <div class="header-nav-container">
        
        <nav class="user-nav">
            <ul>
                <li><a href="user_home.php">Home</a></li>
                <li><a href="detect.html">Detect</a></li>
                <li><a href="aboutus.html">About Us</a></li>
                <li  class="active"><a href="profile.php">Profile</a></li>
            </ul>
        </nav>
    </div>
    <div class="nav-button">
        <button class="btn white" id="register"  onclick="window.location.href='login.php'">LOGOUT</button>
    </div> 
    <div class="back3">
    <table>
        <tr>
            <td class="profile-photo">
                <img src="profile.png" alt="Profile Photo">
            </td>
            <td>
                <?php
                session_start();

                // Connect to the database (replace with your database credentials)
                $conn = mysqli_connect("localhost", "pma", "", "news");

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                if (isset($_SESSION["username"])) {
                    $username = $_SESSION["username"];

                    // Use prepared statements to prevent SQL injection
                    $stmt = $conn->prepare("SELECT id, fname, lname, username, email FROM register WHERE username = ?");
                    $stmt->bind_param("s", $username);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows == 1) {
                        // Display the user details in a table format
                        echo "<table>";
                        $row = $result->fetch_assoc();
                        //echo "<tr><td><strong>User ID:</strong></td><td>" . $row["id"] . "</td></tr>";
                        echo "<tr><td><strong>Full Name:</strong></td><td>" . $row["fname"] ." ". $row["lname"] . "</td></tr>";
                        echo "<tr><td><strong>User Name:</strong></td><td>" . $row["username"] . "</td></tr>";
                        echo "<tr><td><strong>Email:</strong></td><td>" . $row["email"] . "</td></tr>";
                        echo "</table>";
                    } else {
                        echo "User not found"; // User not found
                    }
                } else {
                    echo "Please log in to view user details.";
                }

                $conn->close();
                ?>
            </td>
        </tr>
    </table>
          