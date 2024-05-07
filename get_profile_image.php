<?php
// Assuming you have already started the session and have the user ID available
// Replace 'connection.php' with your actual file that contains the database connection code

// Include database connection code
include_once 'connection.php';

// Start session
session_start();

// Check if user ID is set in session
if (!isset($_SESSION['user_id'])) {
    // Handle case where user is not logged in
    echo "User is not logged in.";
    exit();
}

// Get logged-in user's ID
$userID = $_SESSION['user_id']; // Adjust this according to how you store user ID in the session

// Query to fetch the image from the database
$query = "SELECT `file` FROM `files` WHERE file_id='1'";

$result = mysqli_query($connection, $query);

// Check if query executed successfully and returned rows
if ($result && mysqli_num_rows($result) > 0) {
    // Fetch image data
    $imageData = mysqli_fetch_assoc($result)['file'];

    // Output image
    header("Content-type: image/jpeg"); // Adjust content-type according to your image type
    echo $imageData;
} else {
    // Handle case where no image is found for the user
    echo "No image found for the user.";
}

// Close database connection
mysqli_close($connection);
?>
