
<?php
date_default_timezone_set('Asia/Kolkata');
$current_date = date('Y-m-d');
include('../connect.php');
$passw = hash('sha256', $_POST['password']);
function createSalt()
{
    return '2123293dsj2hu2nikhiljdsd';
}
$salt = createSalt();
$pass = hash('sha256', $salt . $passw);
extract($_POST);
   $sql = "INSERT INTO `tbl_student`(`stud_id`,`sfname`, `slname`, `classname`, `semail`,`password`, `sgender`, `sdob`, `scontact`, `saddress`) VALUES ('$stud_id','$sfname', '$slname', '$classname', '$semail','$pass', '$sgender', '$sdob', '$scontact', '$saddress')";

 if ($conn->query($sql) === TRUE) {
      $_SESSION['success']=' Record Successfully Added';
     ?>
<script type="text/javascript">
window.location="../view_student.php";
</script>
<?php
} else {
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="../view_student.php";
</script>
<?php } ?>

<?php
date_default_timezone_set('Asia/Kolkata');
$current_date = date('Y-m-d');
include('../connect.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sfname']) && isset($_POST['semail']) && isset($_POST['matricno']) && isset($_POST['scontact'])) {
      // Extract and sanitize the form data
      $sfname = mysqli_real_escape_string($conn, $_POST['sfname']);
      $semail = mysqli_real_escape_string($conn, $_POST['semail']);
      $matricno = mysqli_real_escape_string($conn, $_POST['matricno']);
      $scontact = intval($_POST['scontact']); 
  
      // Prepare the SQL query
      $sql = "INSERT INTO `tbl_student` (`sfname`, `semail`, `matricno`, `scontact`) VALUES ('$sfname', '$semail', '$matricno', '$scontact')";
  
      // Execute the SQL query
      if ($conn->query($sql) === TRUE) {
          // Set a success message in the session
          $_SESSION['success'] = 'Record Successfully Added';
      } else {
          // Set an error message in the session
          $_SESSION['error'] = 'Something Went Wrong: ' . $conn->error;
      }

      header("Location: ../view_student.php");
      exit();
  } else {
      // Set an error message if the form data is not set
      $_SESSION['error'] = 'Invalid Form Submission';
      header("Location: ../view_student.php");
      exit();
  }
  ?>