<?php
require_once('../config/config.php');

if (isset($_POST['cancelAdvisory'])) {

    $requestID = $_POST['requestID'];

    $update = update('request', ['request_ID' => $requestID], ['request_Status' => 3]);
    if ($update) {
        http_response_code(200);
        echo json_encode(array("status" => "success", "message" => "Request Cancelled."));
    } else {
        http_response_code(400);
        echo json_encode(array("status" => "error", "message" => "Cancel Failed."));
    }
}
