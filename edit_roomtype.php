<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>

<?php
include('connect.php');
date_default_timezone_set('Asia/Kolkata');
$current_date = date('Y-m-d');

if(isset($_POST["btn_update"])) {
    extract($_POST);
    $id = intval($_GET['id']);
    $roomname = mysqli_real_escape_string($conn, $_POST['roomname']);
    $roomtype = mysqli_real_escape_string($conn, $_POST['roomtype']);
    $strength = intval($_POST['strength']);

    $q1 = "UPDATE `room_type` SET `roomname`='$roomname', `roomtype`='$roomtype', `strength`='$strength' WHERE `id`='$id'";
   
    if ($conn->query($q1) === TRUE) {
        $_SESSION['success'] = 'Record Successfully Updated';
        ?>
        <script type="text/javascript">
            window.location = "view_roomtype.php";
        </script>
        <?php
    } else {
        $_SESSION['error'] = 'Something Went Wrong';
        ?>
        <script type="text/javascript">
            window.location = "view_roomtype.php";
        </script>
        <?php
    }
}

$id = intval($_GET["id"]);
$que = "SELECT * FROM `room_type` WHERE id='$id'";
$query = $conn->query($que);
$room = $query->fetch_assoc();

$roomname = $room['roomname'];
$roomtype = $room['roomtype'];
$strength = $room['strength'];
?>

<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Update Room Management</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Update Room Management</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8" style="margin-left: 10%;">
                <div class="card">
                    <div class="card-body">
                        <div class="input-states">
                            <form class="form-horizontal" method="POST" enctype="multipart/form-data" name="classform">
                                <input type="hidden" name="currnt_date" class="form-control" value="<?php echo $current_date;?>">
                                <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Room Type</label>
                                                <div class="col-sm-9">
                                                    <select type="text" name="roomtype" class="form-control"   placeholder="Room Type" required="">
                                                        <option value="">--Select Room Type--</option>
                                                            <?php  
                                                            $c1 = "SELECT * FROM `room_type`";
                                                            $result = $conn->query($c1);

                                                            if ($result->num_rows > 0) {
                                                                while ($row = mysqli_fetch_array($result)) {?>
                                                                    <option value="<?php echo $row["id"];?>">
                                                                        <?php echo $row['roomtype'];?>
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
                                        <label class="col-sm-3 control-label">Room Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="roomname" class="form-control" placeholder="Room Type Name" value="<?php echo $roomname; ?>" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Room Capacity</label>
                                        <div class="col-sm-9">
                                            <input type="number" min="0" name="strength" class="form-control" placeholder="Capacity" value="<?php echo $strength; ?>" required="">
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
    </div>
<?php include('footer.php');?>
