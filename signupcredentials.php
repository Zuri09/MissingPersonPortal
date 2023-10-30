
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
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];


    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        header("Location: signupconfirm.html");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
