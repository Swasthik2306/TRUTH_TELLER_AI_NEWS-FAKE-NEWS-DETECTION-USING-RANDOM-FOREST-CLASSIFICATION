<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home1.css">
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
<body>
    <div class="header-nav-container">
      <nav class="user-nav">
            <ul>
                <li  class="active"><a href="user_home.php">Home</a></li>
                <li><a href="detect.html">Detect</a></li>
                <li><a href="aboutus.html">About Us</a></li>
                <li><a href="profile.php">Profile</a></li>
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
    

    <!-- Sections for each navigation menu item -->
    <section id="home-section">
      <h1 class="sub-title">Latest News</h1>
      <div class="news-section">

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

// SQL query to fetch the last 3 uploaded news ordered by date
$sql = "SELECT news_title, summary, date_time, media FROM addnews ORDER BY news_id DESC LIMIT 3";
$result = $conn->query($sql);

// Check if there are rows in the result
if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        $imagePath = 'uploads/' . $row['media'];
        echo '<div class="news-card" style="background-image: url(' . $imagePath . ')">';
        echo '<div class="news-content">';
        echo '<h3 class="news-title">' . $row['news_title'] . '</h3>';
        echo '<h4 class="news-date">Date: ' . $row['date_time'] . '</h4>';
        echo '<p class="news-summary">' . $row['summary'] . '</p>';
        echo '</div>';
        echo '</div>';
       
    }
} else {
    echo "No news available.";
}

// Close the database connection
$conn->close();
?>
</div>    
</section>
<div class="viewmore" id="viewMoreButton">View More!</div>
<div class="line">

</div>
</br></br>


<h1 class="sub-title2">Advertisment</h1>
<?php
$conn = mysqli_connect("localhost", "pma", "", "news");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT * FROM addads ORDER BY ad_id DESC LIMIT 5");
$ads = [];
while ($row = mysqli_fetch_assoc($result)) {
    $ads[] = $row;
}
mysqli_close($conn);

$currentAd = 0;
?>

<div class="ad-container">
    <div class="ad">
        <div class="background-image" style="background-image: url('ad_uploads/<?php echo $ads[$currentAd]['ad_media']; ?>')"></div>
        <div class="ad-content">
            <h3 class="ad-title"><?php echo $ads[$currentAd]['ad_title']; ?></h3>
            <p class="ad-summary"><?php echo $ads[$currentAd]['ad_summary']; ?></p>
        </div>
    </div>
</div>

<script>
  const adContainer = document.querySelector('.ad-container');
  const ads = <?php echo json_encode($ads); ?>;
  let currentAd = 0;

  function showAd() {
    adContainer.innerHTML = '';
    const ad = ads[currentAd];
    adContainer.innerHTML = `
        <div class="ad">
            <div class="background-image" style="background-image: url('ad_uploads/${ad.ad_media}')"></div>
            <div class="ad-content">
                <h3 class="ad-title">${ad.ad_title}</h3>
                <p class="ad-summary">${ad.ad_summary}</p>
            </div>
        </div>
    `;
    currentAd = (currentAd + 1) % ads.length;
    const backgroundImage = adContainer.querySelector('.background-image');
    const adContent = adContainer.querySelector('.ad-content');
    backgroundImage.style.filter = `blur(5px)`;
    backgroundImage.style.transition = `filter 0.3s ease-in-out`;
    setTimeout(() => {
      backgroundImage.style.filter = `blur(0px)`;
      backgroundImage.style.opacity = 0;
      backgroundImage.style.transition = `opacity 5s ease-in-out`;
      setTimeout(() => {
        backgroundImage.style.opacity = 1;
      }, 100);
    }, 1000); 
    adContent.style.opacity = 0;
    setTimeout(() => {
      adContent.style.opacity = 1;
    }, 100);
    setTimeout(() => {
      fadeOut();
    }, 9000);
  }

  function fadeOut() {
    const backgroundImage = adContainer.querySelector('.background-image');
    const adContent = adContainer.querySelector('.ad-content');
    backgroundImage.style.filter = `blur(0px)`;
    backgroundImage.style.transition = `filter 0.3s ease-in-out`;
    backgroundImage.style.opacity = 1;
    backgroundImage.style.transition = `opacity 0.3s ease-in-out`;
    adContent.style.opacity = 1;
    adContent.style.transition = `opacity 0.3s ease-in-out`;
    setTimeout(() => {
      backgroundImage.style.opacity = 1;
      adContent.style.opacity = 1;
      setTimeout(() => {
        showAd();
      }, 5000);
    }, 100);
  }

  adContainer.addEventListener('mouseover', function() {
    clearTimeout(showAdTimeout);
    clearTimeout(fadeOutTimeout);
  });


  let showAdTimeout = setTimeout(showAd, 9000);
  let fadeOutTimeout = setTimeout(fadeOut);

  showAd();
</script>




<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Get the "View More!" element by its ID
    var viewMoreButton = document.getElementById("viewMoreButton");

    // Add a click event listener to the "View More!" element
    viewMoreButton.addEventListener("click", function () {
        // Redirect to the "viewmore_news.html" file
        window.location.href = "viewmore_news.php";
    });
});

</script>
</body>
</html>


