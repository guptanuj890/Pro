<!DOCTYPE html>

<?php
// include 'connection.php';
// session_start();
// if (isset($_SESSION['logged_in'])) {
//     $email = $_SESSION['email'];
//     $query = "SELECT * FROM users WHERE email ='$email'";
//     $result = mysqli_query($db, $query);
//     $row = mysqli_fetch_assoc($result);
//     $user_id = $row['user_id'];

//     $medical_records = "medical_records";
//     if (isset($_POST['submit'])) {
//         $record_id = strtoupper(uniqid('MLD'));
//         $sypmtoms = mysqli_real_escape_string($db, $_POST['symptoms']);
//         $diagnosis = mysqli_real_escape_string($db, $_POST['diagnosis']);
//         $date = mysqli_real_escape_string($db, $_POST['date']);
//         $dr = mysqli_real_escape_string($db, $_POST['dr']);
//         $bp = mysqli_real_escape_string($db, $_POST['bp']);
//         $sugar = mysqli_real_escape_string($db, $_POST['sugar']);
//         $temp = mysqli_real_escape_string($db, $_POST['temp']);
//         $oxygen = mysqli_real_escape_string($db, $_POST['oxygen']);
//         $trtmnt = mysqli_real_escape_string($db, $_POST['trtmnt']);
//         $medicines = mysqli_real_escape_string($db, $_POST['medicines']);

//         $query = "INSERT INTO medical_records (record_id,user_id,symptoms, diagnosis, Date_of_Diagnosis, Specialist_Consulted, bp , sugar , temp, oxygen , Treatment_Process, Medicine_Prescribed) 
//   			  VALUES('$record_id','$user_id','$sypmtoms' , '$diagnosis', '$date', '$dr', '$bp','$sugar', '$temp','$oxygen', '$trtmnt', '$medicines')";

//         mysqli_query($db, $query);

//         $message = 'Successfully Added for ';
//     }
    ?>

    <?php
        include 'connection.php';
        session_start();
        $medical_records = "medical_records";
        if (isset($_SESSION['logged_in'])) {
            $email_doc = $_SESSION['email'];
            $query = "SELECT * FROM doctors WHERE email ='$email_doc'";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            $doctor_id = $row['doctor_id'];
        }
        if (isset($_POST['submit'])) {
            $record_id = strtoupper(uniqid('MLD'));
            $email = mysqli_real_escape_string($db, $_POST['Email']);
            $sypmtoms = mysqli_real_escape_string($db, $_POST['symptoms']);
            $diagnosis = mysqli_real_escape_string($db, $_POST['diagnosis']);
            $date = mysqli_real_escape_string($db, $_POST['date']);
            $dr = mysqli_real_escape_string($db, $_POST['dr']);
            $bp = mysqli_real_escape_string($db, $_POST['bp']);
            $sugar = mysqli_real_escape_string($db, $_POST['sugar']);
            $temp = mysqli_real_escape_string($db, $_POST['temp']);
            $oxygen = mysqli_real_escape_string($db, $_POST['oxygen']);
            $trtmnt = mysqli_real_escape_string($db, $_POST['trtmnt']);
            $medicines = mysqli_real_escape_string($db, $_POST['medicines']);

            $query = "SELECT * FROM users WHERE email ='$email'";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            $user_id = $row['user_id'];
            $query = "INSERT INTO medical_records (user_id, doctor_id, symptoms, diagnosis, Date_of_Diagnosis, Specialist_Consulted, bp, sugar, temp, oxygen, Treatment_Process, Medicine_Prescribed) 
          VALUES ('$user_id','$doctor_id', '$sypmtoms', '$diagnosis', '$date', '$dr', '$bp', '$sugar', '$temp', '$oxygen', '$trtmnt', '$medicines')";
            
            mysqli_query($db, $query);

            $message = 'Successfully Added for ';
        }
            ?> 
           
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Add Records</title>
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
            <div class="col-lg-offset-1 col-lg-10 box" style="vertical-align: middle; padding: 20px">
                <form action="addRecords.php" class="content-section" method="POST">
                    <h1 style="font-size: 50px; "><i class="fas fa-clipboard"></i> ADD RECORDS</h1>
                    <?php
                    if (isset($message)) {
                        echo "<p><small><i>".$message."<b>".$user_id."</b> !</p></small></i>";
                    }
                    ?>
                    <div class="row form-input-group">
                        <!-- <label style="text-align: left">Email of User</label><br>
                        <input placeholder="Email" type = "text" name = "email" class="input-box col-lg-12" autocomplete="off"> -->
                        <label style="float: left; vertical-align: middle;" class="col-lg-2">Email of User</label>
                        <textarea name="Email" class="input-box col-lg-4"></textarea>
                    </div>
                    <div class="row form-input-group">
                        <label style="float: left; vertical-align: middle;" class="col-lg-2">Symptoms</label>
                        <textarea name="symptoms" class="input-box col-lg-4"></textarea>
                        <label style="float: left; vertical-align: middle;" class="col-lg-2">Diagnosis</label>
                        <textarea  name="diagnosis" class="input-box col-lg-4"></textarea>
                    </div>
                    <div class="row form-input-group">
                        <label style="float: left; vertical-align: middle;" class="col-lg-2">Date of Diagnosis</label><input name="date" type="date" class="input-box col-lg-4">
                        <label style="" class="col-lg-2">Specialist Consulted</label><input name="dr" type="text" class="input-box col-lg-4">
                    </div>
                    <div class="row form-input-group">
                        <label style="float: left; vertical-align: middle;" class="col-lg-2">Blood Pressure</label>
                        <input type="number" name="bp" class="input-box col-lg-4"></input>
                        <label style="float: left; vertical-align: middle;" class="col-lg-2">Blood Sugar</label>
                        <input type="number" name="sugar" class="input-box col-lg-4"></input>
                    </div>
                    <div class="row form-input-group">
                        <label style="float: left; vertical-align: middle;" class="col-lg-2"> Body Temperature</label>
                        <input type="number" name="temp" class="input-box col-lg-4"></input>
                        <label style="float: left; vertical-align: middle;" class="col-lg-2">Oxygen Level</label>
                        <input type="number" name="oxygen" class="input-box col-lg-4"></input>
                    </div>
                    <div class="row form-input-group">
                        <label style="float: left; vertical-align: middle;" class="col-lg-2">Treatment Process</label>
                        <textarea name="trtmnt" class="input-box col-lg-4"></textarea>
                        <label style="float: left; vertical-align: middle;" class="col-lg-2">Medicines Prescribed</label>
                        <textarea  name="medicines" class="input-box col-lg-4"></textarea>
                    </div>
                    <p><small><i><i class="fas fa-exclamation-circle"></i> Please make sure all inputs are filled correctly.</i></small></p>
                    <button type="submit" name="submit" class="form-button-one" style="background-color: #00cf7a; border-color:#00cf7a; color: white">Add Record</button>
                </form>
            </div>
        </body>
    </html>
