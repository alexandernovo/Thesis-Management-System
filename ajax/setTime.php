<?php
require_once('../config/config.php');

$start = $_POST['start'];
$end = $_POST['end'];
$status = "Not Available";

$save = save('teacher_availability', ['teacher_ID' => $_SESSION['teacher_ID'], 'availability_Status' => $status, 'availability_startDatetime' => $start, 'availability_endDatetime' => $end]);

if ($save) {
    http_response_code(200);
    echo json_encode(array("status" => "success", "message" => "Set successfully."));
} else {
    http_response_code(400);
    echo json_encode(array("status" => "error", "message" => "Error setting time."));
}
