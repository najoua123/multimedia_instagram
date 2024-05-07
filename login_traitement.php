<?php
// Start a session
session_start();

// Connect to your MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "instagram";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // SQL query to check if the user exists with the provided email and password
    $sql = "SELECT * FROM `user` WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // User exists, fetch user data
        $user = $result->fetch_assoc();
        
        // Store user data in session variables
        $_SESSION['user_id'] = $user['id']; // Assuming 'id' is the column name for user ID in your users table
        $_SESSION['username'] = $user['username']; // Assuming 'username' is the column name for username in your users table
        
        // Redirect to home page or wherever you want
        header("Location: home.html");
        exit();
    } else {
        // Invalid credentials, you can display an error message or redirect to login page again
        echo "Invalid email or password";
    }
}

$conn->close();
?>
