<?php
require_once('../config/config.php');

$teacher = first('teacher', ['teacher_ID' => 5]);
$student = first('student', ['student_ID' => 2]);

$teacher_name = $teacher['teacher_Fname'];
$your_name = $student['student_Fname'] . ' ' . $student['student_Lname'];

$email_message = "<html><body>" .
    "<h3>Thesis Advisory Request</h3>" .
    "<p>Dear $teacher_name,</p>" .
    "<p>I kindly request your advisory for my thesis. Your expertise and knowledge in the field will be greatly appreciated. Please let me know your availability for a meeting to discuss my research proposal.</p>" .
    "<p>Thank you,</p>" .
    "<p>$your_name</p>" .
    "<p>--</p>" .
    "<p>This email was generated automatically. Please do not reply.</p>" .
    "</body></html>";

$send = sendMail($teacher['teacher_Email'], $email_message);

if ($send == true) {
    echo "true";
}
