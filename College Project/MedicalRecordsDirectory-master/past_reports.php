<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Medical Records</title>
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
    <body style="height: 100%; background-color: #f5f5f5; padding-bottom: 10px;">
        <div class="dashboard-navbar-light">
            <div class="dashboard-navbar-options-light nav-title" style="width: 100%;">
                <center>
                    <span>
                        <a href="index.php" style="float: left; padding-left: 50px; color: black">Medical Legacy Directory</a>
                    </span>
                    <span style="float: right;">
                        <a href="doctorHome.php" style="color:#252525"><i class="fas fa-home"></i></a>  
                        <a href="logout.php" style="color:#252525"><i class="fas fa-sign-out-alt"></i></a>
                    </span> 
                </center>
            </div>
        </div>
        <div class="content-section" style="font-family:'Varela Round' ">
            <?php
            include 'connection.php';
            session_start();

            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                $email = $_SESSION['email'];
                
                // Use prepared statements to prevent SQL injection
                $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Check if the user-mail value is set and not empty
                    if (isset($_POST["user-mail"]) && !empty($_POST["user-mail"])) {
                        // Retrieve the user-mail value
                        $userMail = $_POST["user-mail"];
                        
                        // Display user mail
                        echo "User Mail: " . htmlspecialchars($userMail);

                        // Fetch reports for the given user mail using prepared statements
                        $reportStmt = $db->prepare("SELECT * FROM report WHERE user_id = (SELECT user_id FROM users WHERE email = ?)");
                        $reportStmt->bind_param("s", $userMail);
                        $reportStmt->execute();
                        $reportResult = $reportStmt->get_result();
                        
                        if ($reportResult->num_rows > 0) {
                            while ($reportRow = $reportResult->fetch_assoc()) {
                                echo "<h2>" . htmlspecialchars($reportRow['title']) . "</h2>";
                                echo "<img src='" . htmlspecialchars($reportRow['file_path']) . "' alt='Report Image'>";
                                echo "<p>Description: " . htmlspecialchars($reportRow['description']) . "</p>";
                                echo "<hr>";
                            }
                        } else {
                            echo "No reports found for the user.";
                        }
                    } else {
                        echo "User Mail not provided.";
                    }
                } else {
                    echo "Form not submitted.";
                }
            } else {
                echo "You are not logged in.";
            }
            ?>
        </div>
    </body>
</html>
