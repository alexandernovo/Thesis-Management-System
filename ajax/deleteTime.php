<?php
require_once('../config/config.php');

if (isset($_POST['delete_Teacher'])) :
    $availability_ID = $_POST['availability_ID'];
    $delete = delete('teacher_availability', ['availability_ID' => $availability_ID]);
    if ($delete) {
        http_response_code(200);
        echo json_encode(array("status" => "success", "message" => "Deleted Successfully."));
    } else {
        http_response_code(400);
        echo json_encode(array("status" => "error", "message" => "Error setting time."));
    }
endif;
