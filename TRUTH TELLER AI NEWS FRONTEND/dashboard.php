<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home1.css">
    <link rel="icon" href="image.ico" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>admin dashboard page</title>

    <style>
        body::-webkit-scrollbar {
            width: 1px;
        }

        .count {
            font-size: 20rem;
            font-weight: bold;
            color: #333;

            font-family: 'Lora', serif;
}
    </style>
</head>
<body>
    <div class="header-nav-container">
        <nav class="user-nav">
            <ul>
                <li class="active"><a href="dashboard.html">Dashboard</a></li>
                <li><a href="addnews.html">Add News</a></li>
                <li><a href="addads.html">Add Advertisement</a></li>
                <li><a href="userprofile.php">User Profile</a></li>
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
    <div class="nav-button">
        <button class="btn white" id="register">LOGOUT</button>
    </div> 

    <section id="dashboard-section">
        <h1 class="nav-menu1">Dashboard</h1>
        <div class="back">
            <div class="box">
                <h2 >Users</h2>    
                    <div id="user-pie-chart">
                    <canvas id="userPieChartCanvas" width="400" height="400"></canvas>
                    </div>
            </div>
                <div class="boxa">
                    <h2>Total no, of News Uploaded:</h2>
                    
                    <?php
                        // Connect to the database
                        $db = mysqli_connect('localhost', 'pma', '', 'news');

                        // Fetch the news count
                        $query = "SELECT COUNT(*) FROM addnews";
                        $result = mysqli_query($db, $query);
                        $row = mysqli_fetch_array($result);
                        $num_news = $row[0];

                        // Close the database connection
                        mysqli_close($db);
                        echo"<div class='count'>";
                        // Output the count
                        echo $num_news;
                        echo"</div>";
                    ?>
                    
                    <script>
                        // Connect to the database using AJAX
                        function fetchNewsCount() {
                            // Fetch the news count from the <div> element
                            fetch('dashboard.php')
                            .then(response => response.text())
                            .then(data => {
                                // Extract the count from the HTML response
                                const match = data.match(/<div id="count">(\d+)<\/div>/);
                                const count = match[1];

                                // Update the count element with the new count
                                document.getElementById('count').innerText = count;

                                // Call the function again after 1 second
                                setTimeout(fetchNewsCount, 1000);
                            });
                        }

                        // Start the count
                        fetchNewsCount();
                    </script>
                </div>
                <div class="boxa">
                <h2>Total no, of Ads Uploaded:</h2>
                    <div class="count">
                    <?php
                        // Connect to the database
                        $db = mysqli_connect('localhost', 'pma', '', 'news');

                        // Fetch the news count
                        $query = "SELECT COUNT(*) FROM addads";
                        $result = mysqli_query($db, $query);
                        $row = mysqli_fetch_array($result);
                        $num_news = $row[0];

                        // Close the database connection
                        mysqli_close($db);

                        // Output the count
                        echo $num_news;
                    ?>
                    </div>
                    <script>
                        // Connect to the database using AJAX
                        function fetchNewsCount() {
                            // Fetch the news count from the <div> element
                            fetch('dashboard.php')
                            .then(response => response.text())
                            .then(data => {
                                // Extract the count from the HTML response
                                const match = data.match(/<div id="count">(\d+)<\/div>/);
                                const count = match[1];

                                // Update the count element with the new count
                                document.getElementById('count').innerText = count;

                                // Call the function again after 1 second
                                setTimeout(fetchNewsCount, 1000);
                            });
                        }

                        // Start the count
                        fetchNewsCount();
                    </script>
                </div>
            </div>
        
            
            <br>
    </section>
    <script src="admin_script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
    // Fetch data from data.php
    
    $.get('fetch_data.php', function(data) {
        // Parse the JSON data
        var chartData = JSON.parse(data);
        var canvas = document.getElementById('userPieChartCanvas').getContext('2d');
        // Create a new pie chart
        var chart = new Chart(canvas, {
            type: 'pie',
            data: {
                labels: chartData.map(function(item) { return item[0]; }),
                datasets: [{
                    label: 'Count',
                    data: chartData.map(function(item) { return item[1]; }),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 1000,
                    easing: "easeInOutQuad",
                    animateScale: true
                },
                legend: {
                    display: false
                }
            }
        });
    });
});
</script>

</body>
</html>

