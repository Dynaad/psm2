
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
    $q1="UPDATE `tbl_class` SET `classname`='$classname' WHERE `id`='".$_GET['id']."'";
   
    if ($conn->query($q1) === TRUE) {
      $_SESSION['success']=' Record Successfully Updated';
     ?>
<script type="text/javascript">
window.location="view_class.php";
</script>
<?php
} else {
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="view_class.php";
</script>
<?php
}

}
?>

<?php
$que="SELECT * from `tbl_class` WHERE id='".$_GET["id"]."'";
$query=$conn->query($que);
while($row=mysqli_fetch_array($query))
{
 
    extract($row);
$classname = $row['classname'];

}

?> 

        <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Class Management</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Add Class Management</li>
                    </ol>
                </div>
            </div>
          
            <div class="container-fluid">
               
            <div class="row">
                    <div class="col-lg-8" style="    margin-left: 10%;">
                        <div class="card">
                            
                            <div class="card-body">
                                <div class="input-states">
                                    <form class="form-horizontal" method="POST" action="pages/save_class.php" name="classform" enctype="multipart/form-data">

                                   <input type="hidden" name="currnt_date" class="form-control" value="<?php echo $currnt_date;?>">

                                   <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Course Code</label>
                                                <div class="col-sm-9">
                                                    <select type="text" name="class_id" id="class_id" class="form-control"   placeholder="Course Code" required="">
                                                        <option value="">--Select Course Code--</option>
                                                            <?php  
                                                            $c1 = "SELECT * FROM `tbl_class`";
                                                            $result = $conn->query($c1);

                                                            if ($result->num_rows > 0) {
                                                                while ($row = mysqli_fetch_array($result)) {?>
                                                                    <option value="<?php echo $row["id"];?>">
                                                                        <?php echo $row['classname'];?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            } else {
                                                            echo "0 results";
                                                                }
                                                            ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                  <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Subject</label>
                        <div class="col-sm-9">
                            <select type="text" name="subject_id" id="subject_id" class="form-control"   placeholder="Subject" required="">
                                <option value="">--Select Subject--</option>
                                    <?php  
                                    $c1 = "SELECT * FROM `tbl_subject`";
                                    $result = $conn->query($c1);

                                    if ($result->num_rows > 0) {
                                        while ($row = mysqli_fetch_array($result)) {?>
                                            <option value="<?php echo $row["id"];?>" style="display: none;" data-id="<?php echo $row["class_id"];?>">
                                                <?php echo $row['subjectname'];?>
                                            </option>
                                            <?php
                                        }
                                    } else {
                                    echo "0 results";
                                        }
                                    ?>
                            </select>
                        </div>
                    </div>
                </div>
                                   <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Section</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="classname" class="form-control" placeholder="Section" id="event" required="">
                                        </div>
                                    </div>
                                </div> <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Assign Lecturer</label>
                                                <div class="col-sm-9">
                                                    <select type="text" name="tfname" id="event" class="form-control"   placeholder="Lecturer" required="">
                                                        <option value="">--Select Lecturer--</option>
                                                            <?php  
                                                            $c1 = "SELECT * FROM `tbl_teacher`";
                                                            $result = $conn->query($c1);

                                                            if ($result->num_rows > 0) {
                                                                while ($row = mysqli_fetch_array($result)) {?>
                                                                    <option value="<?php echo $row["id"];?>">
                                                                        <?php echo $row['tfname'];?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            } else {
                                                            echo "0 results";
                                                                }
                                                            ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                
                                        <button type="submit" name="btn_save" class="btn btn-primary btn-flat m-b-30 m-t-30">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
              
<?php include('footer.php');?> 