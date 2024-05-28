<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Upload Reports</title>
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
        <div class="col-lg-offset-1 col-lg-10 box" style="vertical-align: middle; padding: 20px">
            <form enctype="multipart/form-data" class="content-section" action="uploadRecords.php" method="POST">
                <h1 style="font-size: 50px; "><i class="fas fa-file-medical"></i> Upload Reports</h1>
                <label style="text-align: left" for="title">Email:</label>
                <input type="text" id="email" name="email" class="input-box col-lg-12" required>
                <br><br>
                <input type="file" name="uploaded_file"><br />
                <br>
                <label style="text-align: left" for="title">Title:</label>
                <input type="text" id="title" name="title" class="input-box col-lg-12" required>

                <br>
                <br>    
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" class="input-box col-lg-12" required>

                <br>
                <input type="submit" value="Upload" class="form-button-one" style="border-color: #00cf7a; color: #00cf7a">
            </form>
        </div>
    </body>
</html>
<?PHP
// include 'connection.php';
// session_start();
// if (isset($_SESSION['logged_in'])) {
//     $email = $_SESSION['email'];
//     $query = "SELECT * FROM users WHERE email = '$email'";
//     $result = mysqli_query($db, $query);
//     $row = mysqli_fetch_assoc($result);
//     $user_id = $row['user_id'];

//     if (!empty($_FILES['uploaded_file'])) {
//         $uploadDirectory = 'reports/'; // Directory where you want to store files

//         // Create the user-specific directory if it doesn't exist
//         if (!file_exists($uploadDirectory . $user_id)) {
//             mkdir($uploadDirectory . $user_id, 0777, true);
//         }

//         $file_path = $uploadDirectory . $user_id . '/' . basename($_FILES['uploaded_file']['name']);

//         if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
//             // File uploaded successfully. Now, insert a record into the database.
//             $title = mysqli_real_escape_string($db, $_POST['title']); // You can add a title
//             $description = mysqli_real_escape_string($db, $_POST['description']); // You can add a description

//             $insertQuery = "INSERT INTO report (user_id, file_path, title, description) VALUES ('$user_id', '$file_path', '$title', '$description')";
            
//             if (mysqli_query($db, $insertQuery)) {
//                 echo "The file " . basename($_FILES['uploaded_file']['name']) . " has been uploaded and the record has been added to the database.";
//             } else {
//                 echo "Error: " . mysqli_error($db);
//             }
//         } else {
//             echo "There was an error uploading the file, please try again!";
//         }
//     }
// }

?>

<?PHP
include 'connection.php';
session_start();
if (isset($_SESSION['logged_in'])) {
    $email_doc = $_SESSION['email'];
    $query = "SELECT * FROM doctors WHERE email ='$email_doc'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $doctor_id = $row['doctor_id'];
}
if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];
}
    if (!empty($_FILES['uploaded_file'])) {
        $uploadDirectory = 'reports/'; // Directory where you want to store files

        // Create the user-specific directory if it doesn't exist
        if (!file_exists($uploadDirectory . $user_id)) {
            mkdir($uploadDirectory . $user_id, 0777, true);
        }

        $file_path = $uploadDirectory . $user_id . '/' . basename($_FILES['uploaded_file']['name']);

        if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
            // File uploaded successfully. Now, insert a record into the database.
            $title = mysqli_real_escape_string($db, $_POST['title']); // You can add a title
            $description = mysqli_real_escape_string($db, $_POST['description']); // You can add a description

            $insertQuery = "INSERT INTO report (user_id,doctor_id, file_path, title, description)
             VALUES ('$user_id','$doctor_id', '$file_path', '$title', '$description')";
            
            if (mysqli_query($db, $insertQuery)) {
                echo "The file " . basename($_FILES['uploaded_file']['name']) . " has been uploaded and the record has been added to the database.";
            } else {
                echo "Error: " . mysqli_error($db);
            }
        } else {
            echo "There was an error uploading the file, please try again!";
        }
    }


?>
