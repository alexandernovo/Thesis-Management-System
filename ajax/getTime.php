<?php
require_once('../config/config.php');


if (isset($_GET['getTeacher'])) :
    $find = find_where('teacher_availability', ['teacher_ID' => $_SESSION['teacher_ID']]);
    if ($find) {
        http_response_code(200);
        echo json_encode(["status" => "success", "data" => $find]);
    } else {
        http_response_code(404);
        echo json_encode(["status" => "error", "message" => "Data not found"]);
    }
endif;


if (isset($_GET['getStudent'])) :
    $find = find_where('teacher_availability', ['teacher_ID' => $_GET['teacher_ID']]);
    if ($find) {
        http_response_code(200);
        echo json_encode(["status" => "success", "data" => $find]);
    } else {
        http_response_code(404);
        echo json_encode(["status" => "error", "message" => "Data not found"]);
    }
endif;
