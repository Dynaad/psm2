<?php
date_default_timezone_set('Asia/Kolkata');
$current_date = date('Y-m-d');
include('../connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['subjectname']) && isset($_POST['class_section']) && isset($_POST['tfname'])) {
    // Extract and sanitize the form data
    $subjectname = mysqli_real_escape_string($conn, $_POST['subjectname']);
    $class_section = mysqli_real_escape_string($conn, $_POST['class_section']);
    $tfname = mysqli_real_escape_string($conn, $_POST['tfname']);

    // Prepare the SQL queries
    $sql = "INSERT INTO `tbl_subject` (`subjectname`, `class_section`) VALUES ('$subjectname', '$class_section')";
    $sql2 = "INSERT INTO `tbl_teacher` (`tfname`) VALUES ('$tfname')";

    // Execute the SQL query for inserting into tbl_teacher first
    if ($conn->query($sql2) === TRUE) {
        // Now execute the query to insert into tbl_subject
        if ($conn->query($sql) === TRUE) {
            // Set a success message in the session
            $_SESSION['success'] = 'Record Successfully Added';
        } else {
            // Set an error message in the session
            $_SESSION['error'] = 'Something Went Wrong: ' . $conn->error;
        }
    } else {
        // Set an error message in the session
        $_SESSION['error'] = 'Something Went Wrong: ' . $conn->error;
    }

    header("Location: ../view_class.php");
    exit();
} else {
    // Set an error message if the form data is not set
    $_SESSION['error'] = 'Invalid Form Submission';
    header("Location: ../view_class.php");
    exit();
}
?>