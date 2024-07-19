<?php
// Set the default timezone
date_default_timezone_set('Asia/Kolkata');

// Get the current date
$current_date = date('Y-m-d');

// Include the database connection file
include('../connect.php');

// Start the session to use session variables
session_start();

// Check if the form data has been posted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['roomtype']) && isset($_POST['roomname']) && isset($_POST['strength'])) {
    // Extract and sanitize the form data
    $roomtype = mysqli_real_escape_string($conn, $_POST['roomtype']);
    $roomname = mysqli_real_escape_string($conn, $_POST['roomname']);
    $strength = intval($_POST['strength']); // Ensure strength is an integer

    // Prepare the SQL query
    $sql = "INSERT INTO `room_type` (`roomtype`, `roomname`, `strength`) VALUES ('$roomtype', '$roomname', $strength)";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        // Set a success message in the session
        $_SESSION['success'] = 'Record Successfully Added';
    } else {
        // Set an error message in the session
        $_SESSION['error'] = 'Something Went Wrong: ' . $conn->error;
    }

    // Redirect to the view_roomtype.php page
    header("Location: ../view_roomtype.php");
    exit();
} else {
    // Set an error message if the form data is not set
    $_SESSION['error'] = 'Invalid Form Submission';
    header("Location: ../view_roomtype.php");
    exit();
}
?>


