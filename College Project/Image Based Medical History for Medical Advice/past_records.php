<!DOCTYPE html>

<?php
include 'connection.php';
session_start();
if (isset($_SESSION['logged_in'])) {
    $email = $_SESSION['email'];
    $query = "SELECT * FROM users WHERE email ='$email'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    //$user_id = $row['user_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the user-mail value is set and not empty
        if (isset($_POST["user-mail"]) && !empty($_POST["user-mail"])) {
            // Retrieve the user-mail value
            $userMail = $_POST["user-mail"];
            
            // Use $userMail variable as needed
            echo "User Mail: " . $userMail;
        } else {
            // Handle case when user-mail value is not set or empty
            echo "User Mail not provided.";
        }
    } else {
        // Handle case when form was not submitted
        echo "Form not submitted.";
    }
?>
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
        <body style=" height:  100%; background-color: #f5f5f5; padding-bottom: 10px;">
            <div class="dashboard-navbar-light">
                <div class="dashboard-navbar-options-light nav-title" style="width: 100%;">
                    <center>
                        <span>
                            <a href="index.php" style="float: left; padding-left: 50px; color: black">Medical Legacy Directory</a>
                        </span>
                        <span style="float: right;">
                            <a href="doctorHome.php" style="color:#252525"><i class="fas fa-home"></i></a>  
                            <a href="logout.php" style="color:#252525"><i class="fas fa-sign-out-alt" ></i></a>
                        </span> 
                    </center>
                </div>
            </div>
            <div class="content-section" style="font-family:'Varela Round' ">
                <?php
                include 'connection.php';

                //error_reporting(error_reporting() & ~E_NOTICE);
                $query = "SELECT * FROM medical_records WHERE user_id = (SELECT user_id FROM users WHERE email ='$userMail')";

                $result = mysqli_query($db, $query);

                $rows = [];

                while ($row = mysqli_fetch_assoc($result)) {
                    $rows[] = $row;
                }
                if (!empty($rows)) {
                    foreach ($rows as $row) {
                        ?>
                        <div class="box col-lg-offset-1 col-lg-10" style="padding: 50px">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div>
                                        <span style="font-size: 25px; color: #1e78ff">Date of Diagnosis</span>
                                        <p> <?php echo $row['Date_of_Diagnosis']; ?></p>  
                                    </div>
                                    <div>
                                        <span style="font-size: 25px; color: #1e78ff">Expert Consulted</span>
                                        <p> <?php echo $row['Specialist_Consulted']; ?></p>  
                                    </div>
                                    <div>
                                        <span style="font-size: 25px; color: #1e78ff">Symptoms</span>
                                        <p> <?php echo $row['Symptoms']; ?></p>   
                                    </div>
                                    <div>
                                        <span style="font-size: 25px; color: #1e78ff">Blood Pressure</span>
                                        <p> <?php echo $row['bp']; ?></p>   
                                    </div>
                                    <div>
                                        <span style="font-size: 25px; color: #1e78ff">Blood Sugar</span>
                                        <p> <?php echo $row['sugar']; ?></p>   
                                    </div>
                                    <div>
                                        <span style="font-size: 25px; color: #1e78ff">Body Temperature</span>
                                        <p> <?php echo $row['temp']; ?></p>   
                                    </div>
                                    <div>
                                        <span style="font-size: 25px; color: #1e78ff">Oxygen</span>
                                        <p> <?php echo $row['oxygen']; ?></p>   
                                    </div>
                                    <div>
                                        <span style="font-size: 25px; color: #1e78ff">Diagnosis</span>
                                        <p> <?php echo $row['Diagnosis']; ?></p>   
                                    </div>
                                    <div>
                                        <span style="font-size: 25px; color: #1e78ff">Treatment Procedure</span>
                                        <p> <?php echo $row['Treatment_Process']; ?></p>   
                                    </div>
                                    <div>
                                        <span style="font-size: 25px; color: #1e78ff">Prescribed Medication</span>
                                        <p> <?php echo $row['Medicine_Prescribed']; ?></p>   
                                    </div>
                                </div>   
                                <!-- <div class="col-lg-9">
                                    
                                </div>  -->
                            </div>                
                        </div> 
                    <?php } 
                }else {
                    echo "No medical records found for the user.";
                }
                ?>
            </div>
        </body>
    </html>
    <?php
}?>