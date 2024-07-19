<?php
date_default_timezone_set('Asia/Kolkata');
$current_date = date('Y-m-d');
include('../connect.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['coursecode']) && isset($_POST['subjectname']) && isset($_POST['credit'])) {
      // Extract and sanitize the form data
      $coursecode = mysqli_real_escape_string($conn, $_POST['coursecode']);
      $subjectname = mysqli_real_escape_string($conn, $_POST['subjectname']);
      $credit = intval($_POST['credit']); 
  
      // Prepare the SQL query
      $sql = "INSERT INTO `tbl_subject` (`coursecode`, `subjectname`, `credit`) VALUES ('$coursecode', '$subjectname', $credit)";
  
      // Execute the SQL query
      if ($conn->query($sql) === TRUE) {
          // Set a success message in the session
          $_SESSION['success'] = 'Record Successfully Added';
      } else {
          // Set an error message in the session
          $_SESSION['error'] = 'Something Went Wrong: ' . $conn->error;
      }

      header("Location: ../view_subject.php");
      exit();
  } else {
      // Set an error message if the form data is not set
      $_SESSION['error'] = 'Invalid Form Submission';
      header("Location: ../view_subject.php");
      exit();
  }
  ?>