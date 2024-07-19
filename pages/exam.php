<?php
include('../connect.php');
date_default_timezone_set('Asia/Kolkata');
$current_date = date('Y-m-d');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $exam_type = $_POST['exam_type'];
    $coursecode = $_POST['coursecode'];
    $subjectname = $_POST['subjectname'];
    $name = $_POST['name'];
    $exam_date = $_POST['exam_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $student_total = $_POST['student_total'];
    //$room_id = $_POST['room_id'];

    // Prepare the SQL query
    $sql = "INSERT INTO `exam` (`exam_type`, `coursecode`, `subjectname`, `name`, `exam_date`, `start_time`, `end_time`, `student_total`) 
            VALUES ('$exam_type', '$coursecode', '$subjectname', '$name', '$exam_date', '$start_time', '$end_time', '$student_total')";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        // Set a success message in the session
        $_SESSION['success'] = 'Record Successfully Added';
    } else {
        // Set an error message in the session
        $_SESSION['error'] = 'Something Went Wrong: ' . $conn->error;
    }

    header("Location: ../view_exam.php");
    exit();
} else {
    // Set an error message if the form data is not set
    $_SESSION['error'] = 'Invalid Form Submission';
    header("Location: ../view_exam.php");
    exit();
}
?>
