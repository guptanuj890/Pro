<!DOCTYPE html>

<?php
include 'connection.php';
session_start();
if (isset($_SESSION['logged_in'])) {
    $email = $_SESSION['email'];

    $query = "SELECT * FROM doctors WHERE email ='$email'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $doctor_id = $row['doctor_id'];
    $name = $row['Name'];
    $state = $row['State'];
    $dob = $row['DOB'];
    $gender = $row['Gender'];
    $phone = $row['Phone'];
    $specialist = $row['Specialist'];
    $medical_degree = $row['Medical_Degree'];
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>HOME | MLD</title>
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
                            <a href="logout.php" style="color:#252525"><i class="fas fa-sign-out-alt" ></i></a>  
                        </span> 
                    </center>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-offset-1 col-lg-10 box" style="vertical-align: middle; padding: 50px; font-family: Varela Round ">
                    <div class="row"> 
                        <div class="col-lg-6">
                        <div class="col-lg-6">
                            <h1 style="font-size: 50px; "><?php echo $name ?></h1>
                            <h2 style="font-size: 30px; "><b><?php echo $doctor_id ?></b></h2>
                            <h3 style="font-size: 20px; "><?php echo $dob ?></h3>
                            <h3 style="font-size: 30px; "><?php echo $gender ?></h3>
                            <h3 style="font-size: 30px; "><?php echo $state ?></h3>
                            <!-- <h3 style="font-size: 30px; "><?php echo $email ?></h3> -->
                            <h3 style="font-size: 30px; "><?php echo $phone ?></h3>
                        </div>
                        </div> 
                        <div class="col-lg-5 box" style="vertical-align: middle; font-family: Varela Round; background-color: #e9e9e9;  border-radius: 20px">
                            <h3 style="font-size: 30px; "><?php echo $specialist ?></h3>
                            <h3 style="font-size: 30px; "><?php echo $medical_degree ?></h3>
                            <br><br>
                            <h1 style="font-size: 25px; ">Medical Legacy Directory</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-offset-1 col-lg-5 box" style="vertical-align: middle; padding: 50px; font-family: Varela Round ">
                    <h1 style="font-size: 50px;color: #00cf7a ">Upload Reports</h1>
                    <a href="uploadRecords.php" class="form-button-one" style="border-color: #00cf7a; color: #00cf7a"><i class="fas fa-file-medical"></i> Upload Reports</a>
                </div>
                <div class="col-lg-5 box" style="vertical-align: middle; padding: 50px; font-family: Varela Round ">
                    <h1 style="font-size: 50px; color: #1e78ff">Add Records</h1>
                    <a href="addRecords.php" class="form-button-one" style="border-color: #1e78ff; color: #1e78ff"><i class="fas fa-clipboard"></i> Add Records</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-offset-1 col-lg-5 box" style="vertical-align: middle; padding: 50px; font-family: Varela Round ">
                    <h1 style="font-size: 50px;color: #00cf7a ">Medical Advice</h1>
                    <a href="http://127.0.0.1:5000" class="form-button-one" style="border-color: #00cf7a; color: #00cf7a"><i class="fas fa-file-medical"></i> Medical Advice</a>
                </div> 
                <div class="col-lg-5 box" style="vertical-align: middle; padding: 50px; font-family: Varela Round ">
                <h1 style="font-size: 50px;color: #00cf7a ">Past Records</h1>
                    <form method="post" action="past_records.php">
                    <input placeholder="user-mail" type="text" name="user-mail" class="input-box col-lg-12" autocomplete="off">
                    <button type="submit" class="form-button-one" style="border-color: #1e78ff; color: #1e78ff">
                    <i class="fas fa-clipboard"></i> Submit
                    </button>
                    </form>

                </div>
            </div>
            <div class="row">
            <div class="col-lg-offset-1 col-lg-5 box" style="vertical-align: middle; padding: 50px; font-family: Varela Round ">
            <h1 style="font-size: 50px;color: #00cf7a ">Past Reports</h1>
                    <form method="post" action="past_reports.php">
                    <input placeholder="user-mail" type="text" name="user-mail" class="input-box col-lg-12" autocomplete="off">
                    <button type="submit" class="form-button-one" style="border-color: #1e78ff; color: #1e78ff">
                    <i class="fas fa-clipboard"></i> Submit
                    </button>
                    </form>
            </div>
                <!-- <div class="col-lg-5 box" style="vertical-align: middle; padding: 50px; font-family: Varela Round ">
                    <h1 style="font-size: 50px; color:#ff0043 ">Face Registration</h1>
                    <a href="face_registration.php" class="form-button-one" style="border-color: #ff0043; color: #ff0043"><i class="fas fa-info-circle"></i> Add your Image</a>
                    <!-- <a href="displayReports.php" class="form-button-one" style="border-color: #ff0043; color: #ff0043"><i class="fas fa-user"></i> Creators</a>
                    <a href="displayReports.php" class="form-button-one" style="border-color: #ff0043; color: #ff0043"><i class="fas fa-at"></i> Contact Us</a> -->
                </div> -->
            </div>
        </body>
    </html>
    <?php
} else {
    header('Location: userLogin.php');
}?>