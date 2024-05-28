<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Medical Reports</title>
        <link rel="icon" href="favicon.ico" sizes="20x20" type="image/png">  
        <link rel="stylesheet" type="text/css" href="styling/dashboard.css">
        <link rel="stylesheet" type="text/css" href="styling/flexboxgrid.css">
        <link rel="stylesheet" type="text/css" href="styling/forms.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.typekit.net/sgr8dvc.css">
        <link href="https://fonts.googleapis.com/css?family=Lato|Montserrat|Open+Sans|Oswald|Raleway|Roboto" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    </head>
    <body style=" height:  100%; background-color: #f5f5f5; padding-bottom: 10px;">
        <div class="dashboard-navbar-light">
            <div class="dashboard-navbar-options-light nav-title" style="width: 100%;">
                <center>
                    <span>
                        <a href="index.php" style="float: left; padding-left: 50px; color: black">Medical Legacy Directory</a>
                    </span>
                    <span style="float: right;">
                        <a href="userHome.php" style="color:#252525"><i class="fas fa-home"></i></a>  
                        <a href="logout.php" style="color:#252525"><i class="fas fa-sign-out-alt" ></i></a>
                    </span> 
                </center>
            </div>
        </div>
        <?php
            // include 'connection.php'; // Include your database connection code
            // session_start();
            //     if (isset($_SESSION['logged_in'])) {
            //         $email = $_SESSION['email'];
            //         $query = "SELECT * FROM users WHERE email = '$email'";
            //         $result = mysqli_query($db, $query);
            //         $row = mysqli_fetch_assoc($result);
            //         $user_id = $row['user_id'];

            //         // Retrieve reports for the user from the database
            //         $query = "SELECT * FROM report";
            //         $result = mysqli_query($db, $query);

            //         if (mysqli_num_rows($result) > 0) {
            //             while ($row = mysqli_fetch_assoc($result)) {
            //                 echo "<h2>" . $row['title'] . "</h2>";
            //                 echo "<p>File Path: " . $row['file_path'] . "</p>";
            //                 echo "<p>Description: " . $row['description'] . "</p>";
            //                 echo "<hr>";
            //             }
            //         } else {
            //             echo "No reports found.";
            //         }
            //     }    
        ?>
    </body>
</html>
<?php
include 'connection.php';
session_start();

if (isset($_SESSION['logged_in']) && isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['user_id'];

        // Retrieve reports for the user from the database
        $query = "SELECT * FROM report WHERE user_id = $user_id";
        $result = mysqli_query($db, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<h2>" . $row['title'] . "</h2>";
                
                // Display the image
                echo "<img src='" . $row['file_path'] . "' alt='Report Image'>";

                echo "<p>Description: " . $row['description'] . "</p>";
                echo "<hr>";
            }
        } else {
            echo "No reports found for the user.";
        }
    } else {
        echo "User not found.";
    }
} else {
    echo "User not logged in.";
}
?>

