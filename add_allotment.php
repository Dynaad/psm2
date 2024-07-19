<?php include('head.php');?>

<?php include('header.php');?>
<?php include('sidebar.php');?>

 <?php
 include('connect.php');
 date_default_timezone_set('Asia/Kolkata');
 $current_date = date('Y-m-d');

?>

        <div class="page-wrapper">
           
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Exam Management</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Exam Management</li>
                    </ol>
                </div>
            </div>
            
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-lg-8" style="margin-left: 10%;">
                        <div class="card">
                            <div class="card-body">
                                <div class="input-states">
                                    <form class="form-horizontal" method="POST" action="pages/allot.php" name="userform" enctype="multipart/form-data">
                                    <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Exam Type</label>
                                                <div class="col-sm-9">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="exam_type" id="test" value="Test" required>
                                                        <label class="form-check-label" for="test">
                                                            Test
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="exam_type" id="final_exam" value="Final Exam" required>
                                                        <label class="form-check-label" for="final_exam">
                                                            Final Exam
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
            <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Course Code</label>
                        <div class="col-sm-9">
                            <select type="text" name="class_id" id="class_id" class="form-control"   placeholder="Class" required="">
                                <option value="">--Select Course Code--</option>
                                    <?php  
                                    $c1 = "SELECT * FROM `tbl_class`";
                                    $result = $conn->query($c1);
                                    while ($row = mysqli_fetch_array($result)) {
                                        $s1 = "SELECT count(*) as qty FROM `tbl_student` WHERE classname='".$row["id"]."'";
                                        $sr = $conn->query($s1);
                                        if ($sr->num_rows > 0) {
                                            $sres = mysqli_fetch_array($sr);
                                            $qty=$sres['qty'];
                                        }
                                        else
                                        {
                                            $qty=0;
                                        }
                                     ?>
                                            <option value="<?php echo $row["id"];?>" data-capacity="<?php echo $qty; ?>">
                                                <?php echo $row['classname'];?>
                                            </option>
                                            <?php
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
                                        while ($row = mysqli_fetch_array($result)) {?>
                                            <option value="<?php echo $row["id"];?>" style="display: none;" data-id="<?php echo $row["class_id"];?>">
                                                <?php echo $row['subjectname'];?>
                                            </option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                             <div class="row">
                                                <label class="col-sm-3 control-label">Exam Name</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="name" class="form-control" placeholder="Exam Name" id="event" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label"> Date</label>
                                                <div class="col-sm-9">
                                                  <input type="date" name="exam_date" class="form-control" placeholder=" Date" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Start Time</label>
                                                <div class="col-sm-9">
                                                  <input type="time" name="start_time" class="form-control" placeholder=" Start Time" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">End Time</label>
                                                <div class="col-sm-9">
                                                  <input type="time" name="end_time" class="form-control" placeholder=" End Time" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="row">
                                                <label class="col-sm-3 control-label">No. of Student</label>
                                                <div class="col-sm-9">
                                                  <input type="number" name="studenttotal" class="form-control" placeholder="No. of Student" id="event" required="">
                                                </div>
                                            </div>
                                            </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Room</label>
                        <div class="col-sm-9">
                            <select type="text" name="room_type_id" id="room_type_id" class="form-control"   placeholder="Room" required="">
                                <option value="">--Select Room--</option>
                                    <?php  
                                    $c1 = "SELECT * FROM `room_type`";
                                    $result = $conn->query($c1);
                                    while ($row = mysqli_fetch_array($result)) {
                                        $s1 = "SELECT SUM(strenght) as qty FROM `room` WHERE type_id='".$row["id"]."'";
                                        $sr = $conn->query($s1);
                                        if ($sr->num_rows > 0) {
                                            $sres = mysqli_fetch_array($sr);
                                            $qty=$sres['qty'];
                                        }
                                        else
                                        {
                                            $qty=0;
                                        }
                                     ?>
                                            <option value="<?php echo $row["id"];?>" data-capacity="<?php echo $qty; ?>">
                                                <?php echo $row['roomname'];?>
                                            </option>
                                            <?php
                                        }
                                    ?>
                            </select>
                        </div>
                    </div>
                </div>
                                         <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Room Capacity</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="room_capacity" id="room_capacity" class="form-control" placeholder="Room Type Capacity" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="btn_save" id="btn_save" class="btn btn-primary btn-flat m-b-30 m-t-30">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
                
        
<?php include('footer.php');?>

<script type="text/javascript">
 $('#class_id').change(function(){
    var class_capacity=$('#class_id').find(':selected').attr('data-capacity');
    $('#class_capacity').val(class_capacity);
    $("#subject_id").val('');
    $("#subject_id").children('option').hide();
    var class_id=$(this).val();
    $("#subject_id").children("option[data-id="+class_id+ "]").show();
    
  });
</script>
<script type="text/javascript">
 $('#subject_id').change(function(){
    $("#exam_id").val('');
    $("#exam_id").children('option').hide();
    var subject_id=$(this).val();
    $("#exam_id").children("option[data-id="+subject_id+ "]").show();

    $("#teacher_id").val('');
    $("#teacher_id").children('option').hide();
    $("#teacher_id").children("option[data-id="+subject_id+ "]").show();
    
  });
 $('#room_type_id').change(function(){
    var room_capacity=$('#room_type_id').find(':selected').attr('data-capacity');
    $('#room_capacity').val(room_capacity);
    
  });
  $('#btn_save').click(function(){
    var room_capacity=$('#room_capacity').val();
    var class_capacity=$('#class_capacity').val();
    if(parseInt(class_capacity) > parseInt(room_capacity))
    {
        alert('Students quantity are greater than available room');
        return false;
    }
    else
    {
        return true;
    }

    
  });
</script>