<?php
require('../config/config.php');


if (isset($_POST['updateAdmin'])) :
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if (!empty($password)) {
        $data = [
            'Admin_Fname' => $fname,
            'Admin_Lname' => $lname,
            'Admin_Username' => $username,
            'Admin_Password' => password_hash($password, PASSWORD_DEFAULT),
            'Admin_Email' => $email
        ];
    } else {
        $data = [
            'Admin_Fname' => $fname,
            'Admin_Lname' => $lname,
            'Admin_Username' => $username,
            'Admin_Email' => $email
        ];
    }

    $save = update('admin', ['Admin_ID' => $_SESSION['Admin_ID']], $data);
    if ($save) {
        setSession($data);
        setFlash('success', 'Profile Updated Successfully');
        redirect('Profile');
    }
endif;



if (isset($_POST['updateTeacher'])) :
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $department = $_POST['department'];

    if (!empty($password)) {
        $data = [
            'department_id' => $department,
            'teacher_Fname' => $fname,
            'teacher_Lname' => $lname,
            'teacher_Username' => $username,
            'teacher_Password' => password_hash($password, PASSWORD_DEFAULT),
            'teacher_Email' => $email
        ];
    } else {
        $data = [
            'department_id' => $department,
            'teacher_Fname' => $fname,
            'teacher_Lname' => $lname,
            'teacher_Username' => $username,
            'teacher_Email' => $email
        ];
    }

    $save = update('teacher', ['teacher_ID' => $_SESSION['teacher_ID']], $data);
    if ($save) {
        setSession($data);
        setFlash('success', 'Profile Updated Successfully');
        redirect('teacherProfile');
    }
endif;



if (isset($_POST['updateStudent'])) :
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if (!empty($password)) {
        $data = [
            'student_Fname' => $fname,
            'student_Lname' => $lname,
            'student_Username' => $username,
            'student_Password' => password_hash($password, PASSWORD_DEFAULT),
            'student_Email' => $email
        ];
    } else {
        $data = [
            'student_Fname' => $fname,
            'student_Lname' => $lname,
            'student_Username' => $username,
            'student_Email' => $email
        ];
    }

    $save = update('student', ['student_ID' => $_SESSION['student_ID']], $data);
    if ($save) {
        setSession($data);
        setFlash('success', 'Profile Updated Successfully');
        redirect('studentProfile');
    }
endif;
