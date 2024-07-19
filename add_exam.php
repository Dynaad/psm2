<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>

<?php
include('connect.php');
date_default_timezone_set('Asia/Kolkata');
$current_date = date('Y-m-d');
?>

<div class="page-wrapper">
    <div class="row page-tines">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Exam Management</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Add Exam</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8" style="margin-left: 10%;">
                <div class="card">
                    <div class="card-body">
                        <div class="input-states">
                            <form class="form-horizontal" method="POST" action="pages/exam.php" name="userform" enctype="multipart/form-data">
                                <!-- Other form fields remain the same -->
                                <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Course Code</label>
                                                <div class="col-sm-9">
                                                    <select type="text" name="coursecode" class="form-control"   placeholder="Course Code" required="">
                                                        <option value="">--Select Course Code--</option>
                                                            <?php  
                                                            $c1 = "SELECT * FROM `tbl_subject`";
                                                            $result = $conn->query($c1);

                                                            if ($result->num_rows > 0) {
                                                                while ($row = mysqli_fetch_array($result)) {?>
                                                                    <option value="<?php echo $row["id"];?>">
                                                                        <?php echo $row['coursecode'];?>
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
                                                    <select type="text" name="subjectname" class="form-control"   placeholder="Subject" required="">
                                                        <option value="">--Select Subject--</option>
                                                            <?php  
                                                            $c1 = "SELECT * FROM `tbl_subject`";
                                                            $result = $conn->query($c1);

                                                            if ($result->num_rows > 0) {
                                                                while ($row = mysqli_fetch_array($result)) {?>
                                                                    <option value="<?php echo $row["id"];?>">
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
                                        <label class="col-sm-3 control-label">Exam Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" class="form-control" placeholder="Exam Name" id="event" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Date</label>
                                        <div class="col-sm-9">
                                            <input type="date" name="exam_date" id="exam_date" class="form-control" placeholder="Date" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Start Time</label>
                                        <div class="col-sm-9">
                                            <input type="time" name="start_time" id="start_time" class="form-control" placeholder="Start Time" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">End Time</label>
                                        <div class="col-sm-9">
                                            <input type="time" name="end_time" id="end_time" class="form-control" placeholder="End Time" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">No. of Students</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="student_total" class="form-control" placeholder="No. of Students" id="student_total" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Room</label>
                                        <div class="col-sm-9">
                                            <select name="id" id="id" class="form-control" placeholder="Room" required="">
                                                <option value="">--Select Room--</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Room Capacity</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="room_capacity" id="room_capacity" class="form-control" placeholder="Room Capacity" readonly>
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
    </div>

<?php include('footer.php');?>

<script type="text/javascript">
function fetchRooms() {
    var student_total = $('#student_total').val();
    var exam_date = $('#exam_date').val();
    var start_time = $('#start_time').val();
    var end_time = $('#end_time').val();

    if (student_total && exam_date && start_time && end_time) {
        $.ajax({
            type: 'POST',
            url: 'get_rooms.php',
            data: {
                student_total: student_total,
                exam_date: exam_date,
                start_time: start_time,
                end_time: end_time
            },
            success: function(data) {
                $('#id').html(data);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ', status, error);
            }
        });
    } else {
        $('#id').html('<option value="">--Select Room--</option>');
    }
}

$('#student_total, #exam_date, #start_time, #end_time').on('input change', function() {
    fetchRooms();
});

$('#id').change(function() {
    var room_capacity = $(this).find(':selected').data('capacity');
    $('#room_capacity').val(room_capacity);
});
</script>
