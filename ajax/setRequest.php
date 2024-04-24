<?php
require_once('../config/config.php');

if (isset($_POST['requestAdvisory'])) {

    $file_name = $_FILES['research_File']['name'];
    $file_temp = $_FILES['research_File']['tmp_name'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_new_name = uniqid() . '.' . $file_ext;
    $file_dest = '../public/assets/requestFile/' . $file_new_name;

    if (move_uploaded_file($file_temp, $file_dest)) {

        $data = [
            'teacher_ID'        => $_POST['teacherID'],
            'student_ID'        => $_POST['studentID'],
            'research_Title'    => $_POST['research_Title'],
            'research_Problem'  => $_POST['research_Problem'],
            'research_Solution' => $_POST['research_Solution'],
            'research_File'     => $file_dest,
            'request_Status'    => 0,
            'request_DateTime'  => date('Y-m-d h:i:s')
        ];

        $save = save('request', $data);
        if ($save) {
            $teacher = first('teacher', ['teacher_ID' => $_POST['teacherID']]);
            $student = first('student', ['student_ID' => $_POST['studentID']]);
            $teacher_name = $teacher['teacher_Fname'] . ' ' . $teacher['teacher_Lname'];
            $your_name = $student['student_Fname'] . ' ' . $student['student_Lname'];

            $email_message = "<html><body>" .
                "<h3>Thesis Advisory Request</h3>" .
                "<p>Dear Professor $teacher_name,</p>" .
                "<p>I kindly request your advisory for my thesis. Your expertise and knowledge in the field will be greatly appreciated. Please let me know your availability for a meeting to discuss my research proposal.</p>" .
                "<p>Thank you,</p>" .
                "<p>$your_name</p>" .
                "<p>--</p>" .
                "<p>This email was generated automatically. Please do not reply.</p>" .
                "</body></html>";

            $mail->ClearAddresses();
            $mail->AddAddress($teacher['teacher_Email']);
            $mail->Subject = "Thesis Advisory System";
            $content = $email_message;
            $mail->MsgHTML($content);
            $mail->send();

            http_response_code(200);
            echo json_encode(array("status" => "success", "message" => "Request successfully."));
        } else {
            http_response_code(400);
            echo json_encode(array("status" => "error", "message" => "Request Failed."));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("status" => "error", "message" => "Error Uploading File."));
    }
}
