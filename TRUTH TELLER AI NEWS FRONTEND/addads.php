<?php
// Ensure that the "uploads" directory exists in the same directory as this script
$uploadsDirectory = dirname(__FILE__) . '/ad_uploads';

// Check if the directory exists
if (!file_exists($uploadsDirectory)) {
    // If it doesn't exist, create it
    if (!mkdir($uploadsDirectory, 0777, true)) {
        die('Failed to create the "uploads" directory.');
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form data
    $adTitle = $_POST["news-title"];
    $adSummary = $_POST["news-summary"];

    // Handle file upload (image or video)
    if (isset($_FILES["news-media"])) {
        $file = $_FILES["news-media"];
        $fileName = $file["name"];
        $fileTmpName = $file["tmp_name"];
        $fileType = $file["type"];

        // Define the target directory to store uploaded files
        $targetDirectory = $uploadsDirectory; // Use the previously defined directory

        // Generate a unique filename to avoid overwriting
        $uniqueFileName = uniqid() . "_" . $fileName;

        // Move the uploaded file to the target directory
        move_uploaded_file($fileTmpName, $targetDirectory . '/' . $uniqueFileName);

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

        // SQL query to insert news data into the database
        $sql = "INSERT INTO addads (ad_title, ad_summary, ad_media) VALUES ( ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $adTitle, $adSummary, $uniqueFileName);

        if ($stmt->execute()) {
            // News added successfully
            echo '<script>alert("advertise added successfully!");</script>';

        } else {
            // Error in SQL execution
            echo "Error: " . $stmt->error;
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    }
}
?>
