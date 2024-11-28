<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home1.css">
    <link rel="icon" href="image.ico" type="image/x-icon">
    <title>admin proflie page</title>
</head>
<body>
    <div class="header-nav-container">
        
        <nav class="user-nav">
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="addnews.html">Add News</a></li>
                <li><a href="addads.html">Add Advertisement</a></li>
                <li class="active"><a href="userprofile.php">User Profile</a></li>
            </ul>
        </nav>
        <header>
            <!-- Add the h1 heading on the leftmost side -->
            <h1 class="logo">Truth Teller AI News</h1>
        </header>
        
    </div>
    <div class="nav-button">
        <button class="btn white" id="register"  onclick="window.location.href='login.php'">LOGOUT</button>
    </div>

    <section id="dashboard-section">
    <h1 class="nav-menu1">User Profiles</h1>
    <div class="user-card-container">
        <?php
        // Database connection parameters
        $host = "localhost"; // Database host
        $username = "pma"; // Database username
        $password = ""; // Database password
        $database = "news"; // Database name

        // Create a database connection
        $mysqli = new mysqli($host, $username, $password, $database);

        // Check the connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        // SQL query to fetch data for all users (excluding admins) from the "register" table
        $sql = "SELECT * FROM register WHERE usertype != 'admin'";

        // Execute the query
        $result = $mysqli->query($sql);

        // Check if the query was successful
        if ($result) {
            // Display the user data in a card layout
            $count = 0;
            while ($row = $result->fetch_assoc()) {
                if ($count % 3 == 0) {
                    echo "<div class='user-card-row'>";
                }
                echo "
                <div class='user-card'>
                    <h2>User ID : " . $row["id"] . "</h2>
                    <p><strong>Name:</strong> " . $row["fname"] . " " . $row["lname"] . "</p>
                    <p><strong>Email:</strong> " . $row["email"] . "</p>
                    <p><strong>Username:</strong> " . $row["username"] . "</p>
                </div>
                ";
                $count++;
                if ($count % 3 == 0) {
                    echo "</div>";
                }
            }
        } else {
            echo "Error: " . $mysqli->error;
        }

        // Close the database connection
        $mysqli->close();
        ?>
    </div>
</section>
<script src="admin_script.js"></script>
</body>
</html>

