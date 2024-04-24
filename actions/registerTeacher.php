<?php
require_once "../config/config.php";

if (isset($_POST['register_teacher'])) :
    if ($_SERVER['REQUEST_METHOD'] === 'POST') :
        $fname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $special = $_POST['special'];
        $department = $_POST['department'];
        $data = [
            'Admin_ID' => $_SESSION['Admin_ID'],
            'department_id' => $department,
            'teacher_Fname' => $fname,
            'teacher_Lname' => $lastname,
            'teacher_Username' => $username,
            'teacher_Email' => $email,
            'teacher_Password' => password_hash($password, PASSWORD_DEFAULT),
            'teacher_Status' => 1,
            'teacher_Profile' => null
        ];
        $save = save('teacher', $data);
        if ($save) {
            foreach ($special as $key => $value) {
                $data2 = [
                    'teacher_ID' => $save,
                    'Specialization_name' => $special[$key]
                ];
                $save2 = save('specialization', $data2);
            }
            if ($save2) {
                $link = [
                    'pages' => $_POST['pages'],
                    'users' => $_POST['users']
                ];
                setFlash('success', 'Register Successfully');
                redirect('adminRegisterTeacher', $link);
            } else {
                $link = [
                    'pages' => $_POST['pages'],
                    'users' => $_POST['users']
                ];
                setFlash('failed', 'Register Failed');
                redirect('adminRegisterTeacher', $link);
            }
        }
    endif;
endif;
