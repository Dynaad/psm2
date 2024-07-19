
<?php include('head.php');?>

<?php include('header.php');?>
<?php include('sidebar.php');?>

 <?php
 include('connect.php');
 date_default_timezone_set('Asia/Kolkata');
 $current_date = date('Y-m-d');

if(isset($_POST["btn_update"]))
{
    extract($_POST);
    $image = $_FILES['image']['name'];
  $target = "uploadImage/Profile/".basename($image);

 if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  @unlink("uploadImage/Profile/".$_POST['old_image']);
      $msg = "Image uploaded successfully";
    }else{
      $msg = "Failed to upload image";
    }
   
      $q1="UPDATE `admin` SET `fname`='$fname',`lname`='$lname',`email`='$email',`address`='$address',`gender`='$gender',`contact`='$contact',`dob`='$dob' ,`image`='$image' WHERE `id`='".$_GET['id']."'";
  
    if ($conn->query($q1) === TRUE) {
      $_SESSION['success']=' Record Successfully Updated';
     ?>
<script type="text/javascript">
window.location="view_user.php";
</script>
<?php
} else {
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="view_user.php";
</script>
<?php
}
}

?>

<?php
$que="select * from admin where id='".$_GET["id"]."'";
$query=$conn->query($que);
while($row=mysqli_fetch_array($query))
{
   
    extract($row);
$fname = $row['fname'];
$lname = $row['lname'];
$email = $row['email'];
$address = $row['address'];
$gender = $row['gender'];
$contact = $row['contact'];
$dob = $row['dob'];
$image = $row['image'];
}

?> 


        <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">User Management</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Update User Management</li>
                    </ol>
                </div>
            </div>
          
            <div class="container-fluid">
               
                <div class="row">
                    <div class="col-lg-8" style="    margin-left: 10%;">
                        <div class="card">
                            <div class="card-title">
                               
                            </div>
                            <div class="card-body">
                                <div class="input-states">
                                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" name="userform">

                                   <input type="hidden" name="currnt_date" class="form-control" value="<?php echo $currnt_date;?>">

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Full Name</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="fname" class="form-control" placeholder="First Name" id="event" required="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  placeholder="Email" value="<?php echo $email; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Contact</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="contact" class="form-control" placeholder="Contact Number" id="tbNumbers" minlength="10" maxlength="10" onkeypress="javascript:return isNumber(event)" required="" value="<?php echo $contact; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Group</label>
                                                <div class="col-sm-9">
                                                   <select name="group_id" id="group_id" class="form-control" required="">
                                                    <option value=" ">--Select Group--</option>
                                                     <?php  
                          $sql2 = "SELECT * FROM tbl_group where id!=1";
                          $result2 = $conn->query($sql2); 
                          while($row2= mysqli_fetch_array($result2)){
                        ?>
                        <option value ="<?php echo $row2['id'];?>"><?php echo $row2['name'];?> </option>
                      <?php } ?>
                                                   </select>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" name="btn_update" class="btn btn-primary btn-flat m-b-30 m-t-30">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
                
    
<?php include('footer.php');?>

