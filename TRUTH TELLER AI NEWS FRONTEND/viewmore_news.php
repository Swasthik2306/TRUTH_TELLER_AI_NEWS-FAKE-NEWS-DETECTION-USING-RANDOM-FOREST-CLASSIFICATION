<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home1.css"> <!-- Existing CSS file -->
    <link rel="icon" href="image.ico" type="image/x-icon">
    <title>user home page</title>
    <style>
        body::-webkit-scrollbar {
            width: 1px; /* Adjust the width as needed */
        }
        .news-summary {
            width: 400px; /* Fixed width */
            height: 275px; /* Fixed height */
            overflow: auto; /* Enable scrolling */ 
            padding: 5px; /* Add some padding */
        }
        
    </style>
</head>
<section id="home-section">
        <h2 class="menu">NEWS</h2>
        <h1 class="sub-title">All News</h1>
        <div class="news-section">
            <!-- Your PHP code for displaying news -->
        </div>
    </section>

</body>
</html>





<?php
// Database connection (modify these values as per your database)
$servername = "localhost";
$username = "pma";
$password = "";
$dbname = "news";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all news items ordered by date
$sql = "SELECT news_title, summary, date_time, media FROM addnews ORDER BY date_time DESC";
$result = $conn->query($sql);

// Check if there are rows in the result
if ($result->num_rows > 0) {
    echo '<div class="news-section">';
    $count = 0; // Initialize a counter

    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        if ($count % 3 == 0) {
            echo '<div class="row">'; // Start a new row after every third item
        }

        $imagePath = 'uploads/' . $row['media'];
        echo '<div class="news-card" style="background-image: url(' . $imagePath . ')">';
        echo '<div class="news-content">';
        echo '<h3 class="news-title">' . $row['news_title'] . '</h3>';
        echo '<h4 class="news-date">Date: ' . $row['date_time'] . '</h4>';
        echo '<p class="news-summary">' . $row['summary'] . '</p>';
        echo '</div>';
        echo '</div>';

        if (($count + 1) % 3 == 0) {
            echo '</div>'; // End the row after every third item
        }

        $count++;
    }

    if ($count % 3 != 0) {
        echo '</div>'; // Close the last row if it's not complete
    }

    echo '</div>'; // Close the news-section div
} else {
    echo "No news available.";
}

// Close the database connection
$conn->close();
?>
