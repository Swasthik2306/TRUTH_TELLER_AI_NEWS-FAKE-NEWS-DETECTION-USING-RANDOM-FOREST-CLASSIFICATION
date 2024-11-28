<?php
// Database connection parameters
$host = 'localhost';
$user = 'pma';
$password = '';
$dbname = 'news';

// Create a new database connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check for errors
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// SQL query to fetch the number of users and admins
$sql = 'SELECT usertype, COUNT(*) as count FROM register GROUP BY usertype';

// Execute the query and fetch the results
$result = $conn->query($sql);

// Initialize arrays to hold the data
$data = array();

// Loop through the results and add the data to the array
while ($row = $result->fetch_assoc()) {
    $data[] = array($row['usertype'], $row['count']);
}

// Close the database connection
$conn->close();

// Output the data as JSON
echo json_encode($data);
?>