<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>

<?php
include('connect.php');
?>

<?php if(isset($_GET['id'])) { ?>
    <div class="popup popup--icon -question js_question-popup popup--visible">
        <div class="popup__background"></div>
        <div class="popup__content">
            <h3 class="popup__content__title">
                Sure
            </h3>
            <p>Are You Sure To Delete This Record?</p>
            <p>
                <a href="del_exam.php?id=<?php echo $_GET['id']; ?>" class="button button--success" data-for="js_success-popup">Yes</a>
                <a href="view_exam.php" class="button button--error">No</a>
            </p>
        </div>
    </div>
<?php } ?>

<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">View Exam</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">View Exam</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="add_exam.php"><button class="btn btn-primary">Add Exam</button></a>
                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Exam Name</th>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>No. Of Students</th>
                                <th>Room</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        include 'connect.php';

                        // First query to get all exams
                        $sql = "SELECT * FROM exam";
                        $result = $conn->query($sql);

                        // Error handling for SQL query
                        if ($result === false) {
                            echo "<tr><td colspan='6'>Error: " . $conn->error . "</td></tr>";
                        } else {
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    // Second query to get the room name based on id in the exam table  
                                    $sql1 = "SELECT roomname FROM room_type WHERE id = $id";
                                    $result1 = $conn->query($sql1);
                                    $roomname = ($result1 && $result1->num_rows > 0) ? $result1->fetch_assoc()['roomname'] : 'Room not found';

                        ?>
                                    <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['exam_date']; ?></td>
                                        <td><?php echo $row['start_time']; ?></td>
                                        <td><?php echo $row['student_total']; ?></td>
                                        <td><?php echo $roomname; ?></td>
                                        <td>
                                            <a title="Update Exam" href="view_allotment.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></button></a>
                                            <a href="view_exam.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></a>
                                        </td>
                                    </tr>
                        <?php
                                }
                            } else {
                                echo "<tr><td colspan='6'>No exams found</td></tr>";
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php');?>

<link rel="stylesheet" href="popup_style.css">
<?php if(!empty($_SESSION['success'])) { ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
        <h3 class="popup__content__title">
            Success
        </h3>
        <p><?php echo $_SESSION['success']; ?></p>
        <p>
            <button class="button button--success" data-for="js_success-popup">Close</button>
        </p>
    </div>
</div>
<?php unset($_SESSION["success"]); } ?>

<?php if(!empty($_SESSION['error'])) { ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
        <h3 class="popup__content__title">
            Error
        </h3>
        <p><?php echo $_SESSION['error']; ?></p>
        <p>
            <button class="button button--error" data-for="js_error-popup">Close</button>
        </p>
    </div>
</div>
<?php unset($_SESSION["error"]); } ?>

<script>
var addButtonTrigger = function addButtonTrigger(el) {
    el.addEventListener('click', function () {
        var popupEl = document.querySelector('.' + el.dataset.for);
        popupEl.classList.toggle('popup--visible');
    });
};

Array.from(document.querySelectorAll('button[data-for]')).forEach(addButtonTrigger);
</script>
