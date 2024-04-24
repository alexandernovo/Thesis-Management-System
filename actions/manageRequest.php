<?php
require('../config/config.php');

if (isset($_POST['accept'])) :
    $request_id = $_POST['request_id'];
    $remarks = $_POST['remarks'];
    $update = update('request', ['request_ID' => $request_id], ['request_Status' => 1, 'remarks' => $remarks]);
    $request = first('request', ['request_ID' => $request_id]);
    $student = first('student', ['student_ID' => $request['student_ID']]);
    $student_name = $student['student_Fname'] . ' ' . $student['student_Lname'];
    $teacher_name = $_SESSION['teacher_Fname'] . ' ' . $_SESSION['teacher_Lname'];

    if ($update) {
        $email_message = "<html><body>" .
            "<h3>Request Accepted! 🎉</h3>" .
            "<p>Dear $student_name ,</p>" .
            "<p>I am delighted to inform you that your request has been accepted! I appreciate your interest and I am ready to assist you with your thesis. To proceed further, please see my available schedule in the system, so we can arrange a meeting to discuss your research proposal.</p>" .
            "<p>Looking forward to our meeting and supporting you in your thesis journey!</p>" .
            "<p>Best regards,</p>" .
            "<p>$teacher_name</p>" .
            "<p>--</p>" .
            "<p>This email was generated automatically. Please do not reply.</p>" .
            "</body></html>";

        $mail->ClearAddresses();
        $mail->AddAddress($student['student_Email']);
        $mail->Subject = "Thesis Advisory System";
        $content = $email_message;
        $mail->MsgHTML($content);

        if ($mail->send()) {
            setFlash('success', 'Accepted Successfully');
            redirect('teacherRequest');
        }
    } else {
        setFlash('failed', 'Accepting Failed');
        redirect('teacherRequest');
    }
endif;


if (isset($_POST['reject'])) :
    $request_id = $_POST['request_id'];
    $remarks = $_POST['remarks'];
    $update = update('request', ['request_ID' => $request_id], ['request_Status' => 2, 'remarks' => $remarks]);
    $request = first('request', ['request_ID' => $request_id]);
    $student = first('student', ['student_ID' => $request['student_ID']]);
    $student_name = $student['student_Fname'] . ' ' . $student['student_Lname'];
    $teacher_name = $_SESSION['teacher_Fname'] . ' ' . $_SESSION['teacher_Lname'];

    if ($update) {
        $email_message = "<html><body>" .
            "<h3>Request Rejected</h3>" .
            "<p>Dear $student_name,</p>" .
            "<p>I regret to inform you that your request has been rejected. I appreciate your interest, but unfortunately, I am unable to accommodate your request at this time. I encourage you to explore other proffesor or reach out to alternative resources for assistance with your thesis.</p>" .
            "<p>Thank you for your understanding.</p>" .
            "<p>Best regards,</p>" .
            "<p>$teacher_name</p>" .
            "<p>--</p>" .
            "<p>This email was generated automatically. Please do not reply.</p>" .
            "</body></html>";

        $mail->ClearAddresses();
        $mail->AddAddress($student['student_Email']);
        $mail->Subject = "Thesis Advisory System";
        $content = $email_message;
        $mail->MsgHTML($content);

        if ($mail->send()) {
            setFlash('success', 'Rejected Successfully');
            redirect('teacherRequest');
        }
    } else {
        setFlash('failed', 'Rejecting Failed');
        redirect('teacherRequest');
    }
endif;



if (isset($_GET['rejectFinal'])) :
    $request_id = $_GET['request_id'];
    $update = update('request', ['request_ID' => $request_id], ['request_Status' => 2]);
    $request = first('request', ['request_ID' => $request_id]);
    $student = first('student', ['student_ID' => $request['student_ID']]);
    $student_name = $student['student_Fname'] . ' ' . $student['student_Lname'];
    $teacher_name = $_SESSION['teacher_Fname'] . ' ' . $_SESSION['teacher_Lname'];

    if ($update) {
        $email_message = "<html><body>" .
            "<h3>Request Rejected</h3>" .
            "<p>Dear $student_name,</p>" .
            "<p>I regret to inform you that your request has been rejected. I appreciate your interest, but unfortunately, I am unable to accommodate your request at this time. I encourage you to explore other proffesor or reach out to alternative resources for assistance with your thesis.</p>" .
            "<p>Thank you for your understanding.</p>" .
            "<p>Best regards,</p>" .
            "<p>$teacher_name</p>" .
            "<p>--</p>" .
            "<p>This email was generated automatically. Please do not reply.</p>" .
            "</body></html>";

        $mail->ClearAddresses();
        $mail->AddAddress($student['student_Email']);
        $mail->Subject = "Thesis Advisory System";
        $content = $email_message;
        $mail->MsgHTML($content);

        if ($mail->send()) {
            setFlash('success', 'Rejected Successfully');
            redirect('teacherAcceptedRequest', ['pages' => "Accepted Request"]);
        }
    } else {
        setFlash('failed', 'Rejecting Failed');
        redirect('teacherAcceptedRequest', ['pages' => "Accepted Request"]);
    }
endif;





if (isset($_GET['completed'])) :
    $request_id = $_GET['request_id'];
    $update = update('request', ['request_ID' => $request_id], ['request_Status' => 4]);
    $request = first('request', ['request_ID' => $request_id]);
    $student = first('student', ['student_ID' => $request['student_ID']]);
    $student_name = $student['student_Fname'] . ' ' . $student['student_Lname'];
    $teacher_name = $_SESSION['teacher_Fname'] . ' ' . $_SESSION['teacher_Lname'];

    if ($update) {
        $email_message = "<html><body>" .
            "<h3>Thesis Completed</h3>" .
            "<p>Dear $student_name,</p>" .
            "<p>I hope this message finds you well. I am writing to officially congratulate you on the successful completion of your thesis. Your hard work, dedication, and intellectual rigor throughout this process have truly paid off, and I am pleased to inform you that your thesis has been approved.</p>" .
            "<p>Your accomplishment is a testament to your academic prowess and the effort you invested in your research. It has been a pleasure to serve as your advisor, and I am confident that the knowledge and skills you have gained during this journey will serve you well in your future endeavors.</p>" .
            "<p>As we move forward, please be aware that I am here to support you in any way needed. Whether you have questions about potential publication, further research opportunities, or general career advice, do not hesitate to reach out.</p>" .
            "<p>Congratulations on this significant achievement!</p>" .
            "<p>Best regards,</p>" .
            "<p>$teacher_name</p>" .
            "<p>--</p>" .
            "<p>This email was generated automatically. Please do not reply.</p>" .
            "</body></html>";

        $mail->ClearAddresses();
        $mail->AddAddress($student['student_Email']);
        $mail->Subject = "Thesis Advisory System";
        $content = $email_message;
        $mail->MsgHTML($content);

        if ($mail->send()) {
            setFlash('success', 'Completed Successfully');
            redirect('teacherAcceptedRequest', ['pages' => "Accepted Request"]);
        }
    } else {
        setFlash('failed', 'Rejecting Failed');
        redirect('teacherAcceptedRequest', ['pages' => "Accepted Request"]);
    }
endif;
