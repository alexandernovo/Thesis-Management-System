<?php
require_once "../config/config.php";
if (isset($_POST['signin'])) :

    if ($_SERVER['REQUEST_METHOD'] === 'POST') :

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if ($admin = first('admin', ['Admin_Username' => $username])) {
            if (password_verify($password, $admin['Admin_Password'])) {
                $admin['isLogin'] = true;
                setSession($admin);
                // setFlash('success', 'Welcome, Login as Admin'); 
                redirect('adminDashboard', ['pages' => "Dashboard"]);
            } else {
                retainValue();
                returnError(['password' => 'Incorrect password']);
                redirect('login');
            }
        } else if ($teacher = first('teacher', ['teacher_Username' => $username])) {
            if (password_verify($password, $teacher['teacher_Password'])) {
                if ($teacher['teacher_Status'] == 1) {
                    $teacher['isLogin'] = true;
                    setSession($teacher);
                    // setFlash('success', 'Welcome, Login as Teacher'); 
                    redirect('teacherDashboard', ['pages' => "Dashboard"]);
                } else {
                    retainValue();
                    returnError(['password' => 'Your account is not activated']);
                    redirect('login');
                }
            } else {
                retainValue();
                returnError(['password' => 'Incorrect password']);
                redirect('login');
            }
        } else if ($student = first('student', ['student_Username' => $username])) {
            if (password_verify($password, $student['student_Password'])) {
                if ($student['student_Status'] == 1) {
                    $student['isLogin'] = true;
                    setSession($student);
                    // setFlash('success', 'Welcome, Login as Student'); 
                    redirect('studentDashboard', ['pages' => "Dashboard"]);
                } else {
                    retainValue();
                    returnError(['password' => 'Your account is not activated']);
                    redirect('login');
                }
            } else {
                retainValue();
                returnError(['password' => 'Incorrect password']);
                redirect('login');
            }
        } else {
            returnError(['username' => 'Username do not exist']);
            redirect('login');
        }
    endif;
endif;
