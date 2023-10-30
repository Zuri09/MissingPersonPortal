<?php
// Replace with your actual database connection details
$servername = "127.0.0.1:3307";
$username = "admin";
$password = "Test@12345";
$dbname = "missing_person";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve the user's data from the database
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User found, password is correct, redirect to index.html
        header("Location: new_form.html");
        exit();
    } else {
        // User not found or password is incorrect
        echo "Username or password is incorrect.";
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
