<?php
include('connect.php');

if (isset($_POST['student_total']) && isset($_POST['exam_date']) && isset($_POST['start_time']) && isset($_POST['end_time'])) {
    $student_total = intval($_POST['student_total']);
    $exam_date = $_POST['exam_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // Debugging output
    error_log("Received parameters: student_total=$student_total, exam_date=$exam_date, start_time=$start_time, end_time=$end_time");

    // Query to find rooms that can accommodate the number of students
    $query = "
        SELECT id, roomname, strength 
        FROM room_type 
        WHERE strength >= $student_total
        ORDER BY strength ASC";

    // Debugging output
    error_log("Query: $query");

    $result = $conn->query($query);

    if ($result === false) {
        error_log("Query Error: " . $conn->error);
        echo '<option value="">Error in query</option>';
    } else if ($result->num_rows > 0) {
        $rooms_found = false;
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            // Check if the room is available for the given date and time
            $availability_query = "
                SELECT id 
                FROM exam 
                WHERE id = $id 
                AND exam_date = '$exam_date' 
                AND (
                    (start_time <= '$start_time' AND end_time > '$start_time') 
                    OR (start_time < '$end_time' AND end_time >= '$end_time')
                    OR (start_time >= '$start_time' AND end_time <= '$end_time')
                )";

            $availability_result = $conn->query($availability_query);

            if ($availability_result === false || $availability_result->num_rows == 0) {
                echo '<option value="' . $row['id'] . '" data-capacity="' . $row['strength'] . '">' . $row['roomname'] . ' (Capacity: ' . $row['strength'] . ')</option>';
                $rooms_found = true;
            }
        }
        if (!$rooms_found) {
            echo '<option value="">No suitable rooms found</option>';
        }
    } else {
        echo '<option value="">No suitable rooms found</option>';
    }
} else {
    error_log('Missing parameters.');
    echo '<option value="">Invalid request</option>';
}
?>
