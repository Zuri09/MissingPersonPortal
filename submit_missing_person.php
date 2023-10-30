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
    $name = $_POST["name"];
    $address = $_POST["address"];
    $age = $_POST["age"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $family_member_name = $_POST["family_member_name"];
    $last_seen = $_POST["last_seen"];
    $social_media_accounts = $_POST["social_media_accounts"];

    // Handle file upload (photo)
    $file_data = file_get_contents($_FILES["photo"]["tmp_name"]); // Read the binary data of the file

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO missing_person_report (name, address, age, phone, email, family_member_name, last_seen, social_media_accounts, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisssssb", $name, $address, $age, $phone, $email, $family_member_name, $last_seen, $social_media_accounts, $file_data);

    if ($stmt->execute()) {
        header("Location: thankyou.html");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
