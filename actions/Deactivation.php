<?php
require_once "../config/config.php";

if (isset($_GET['deactivateTeacher'])) :
    $links = [
        'pages' => $_GET['pages'],
        'users' => $_GET['users'],
    ];
    if ($_GET['status'] == 0) {
        $message = "Activated";
        $status = 1;
    }
    if ($_GET['status'] == 1) {
        $message = "Deactivated";
        $status = 0;
    }

    $update = update('teacher', ['teacher_ID' => $_GET['teacher_ID']], ['teacher_Status' => $status]);
    if ($update) {
        setFlash('success', $message);
        redirect('adminManageUsers', $links);
    }
endif;

if (isset($_GET['deactivateStudent'])) :
    $links = [
        'pages' => $_GET['pages'],
        'users' => $_GET['users'],
    ];
    if ($_GET['status'] == 0) {
        $message = "Activated";
        $status = 1;
    }
    if ($_GET['status'] == 1) {
        $message = "Deactivated";
        $status = 0;
    }

    $update = update('student', ['student_ID' => $_GET['student_ID']], ['student_Status' => $status]);
    if ($update) {
        setFlash('success', $message);
        redirect('adminManageUsers', $links);
    }
endif;
