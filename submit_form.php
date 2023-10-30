<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection information
    $db_server = "127.0.0.1:3307"; // Replace with your MySQL server
    $db_username = "admin"; // Replace with your MySQL username
    $db_password = "Test@12345"; // Replace with your MySQL password
    $db_name = "missing_person"; // Replace with your database name

    // Create a database connection
    $conn = new mysqli($db_server, $db_username, $db_password, $db_name);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get data from the form
    $fname = $_POST["fname"];
    $mname = $_POST["mname"];
    $lname = $_POST["lname"];
    $date = $_POST["dob"];
    $dob = date('Y-m-d', strtotime($date));
    $fmname = $_POST["fmname"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $last_seen = $_POST["last_seen"];
    $social_media_accounts = $_POST["socials"];   

    
    $filename = $_FILES["photo"]["name"];
    $tempname = $_FILES["photo"]["tmp_name"];
    $img_folder = "images/".$filename;
    move_uploaded_file($tempname,$img_folder);

    $checkduplicate = mysqli_query($conn,"SELECT * FROM `missingpersondetails` WHERE email = '$email' or phone = '$phone'");
    if(mysqli_num_rows($checkduplicate)>0){
        echo 'Duplicate Entry of email or phone number';
    }
    else{

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO missingpersondetails (fname, mname, lname, dob, family_member_name, address, phone, email, lastseen, socials, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssissss", $fname, $mname, $lname, $dob, $fmname, $address, $phone, $email, $last_seen, $social_media_accounts, $img_folder);

    if ($stmt->execute()) {
        header("Location: thankyou.html");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
}
?>
