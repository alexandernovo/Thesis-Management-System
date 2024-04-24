<?php
require_once "../config/config.php";

if (isset($_POST['addcollege'])) :
    if ($_SERVER['REQUEST_METHOD'] === 'POST') :
        $college = $_POST['college'];
        $save = save('college', ['college_name' => $college, 'college_status' => 1]);
        if ($save) {
            setFlash('success', 'College added Successfully');
            redirect('colleges', ['pages' => 'Manage Colleges and Departments']);
        }
    endif;
endif;

if (isset($_POST['updatecollege'])) :
    if ($_SERVER['REQUEST_METHOD'] === 'POST') :

        $college_name = $_POST['college'];
        $college_id = $_POST['college_id'];

        $update = update('college', ['college_id' => $college_id], ['college_name' => $college_name]);

        if ($update) {
            setFlash('success', 'College Updated Successfully');
            redirect('colleges', ['pages' => 'Manage Colleges and Departments']);
        }
    endif;
endif;

if (isset($_GET['activationCollege'])) :

    if ($_GET['status'] == 1) {
        $status = 0;
        $message = "College Deactivated";
    } else {
        $status = 1;
        $message = "College Activated";
    }

    $update = update('college', ['college_id' => $_GET['college_id']], ['college_status' => $status]);
    if ($update) {
        setFlash('success', $message);
        redirect('colleges', ['pages' => 'Manage Colleges and Departments']);
    }

endif;

if (isset($_POST['adddepartment'])) :
    if ($_SERVER['REQUEST_METHOD'] === 'POST') :

        $college = $_POST['college'];
        $department = $_POST['department'];

        $save = save('department', ['college_id' => $college, 'department_name' => $department, 'department_status' => 1]);

        if ($save) {
            setFlash('success', 'Department added Successfully');
            redirect('colleges', ['pages' => 'Manage Colleges and Departments']);
        }
    endif;
endif;



if (isset($_POST['updatedepartment'])) :
    if ($_SERVER['REQUEST_METHOD'] === 'POST') :

        $department_id = $_POST['department_id'];
        $department_name = $_POST['department'];
        $college_id = $_POST['college'];

        $update = update('department', ['department_id' => $department_id], ['college_id' => $college_id, 'department_name' => $department_name]);

        if ($update) {
            setFlash('success', 'Department Updated Successfully');
            redirect('colleges', ['pages' => 'Manage Colleges and Departments']);
        }
    endif;
endif;

if (isset($_GET['activationDepartment'])) :

    if ($_GET['status'] == 1) {
        $status = 0;
        $message = "Department Deactivated";
    } else {
        $status = 1;
        $message = "Department Activated";
    }

    $update = update('department', ['department_id' => $_GET['department_id']], ['department_status' => $status]);
    if ($update) {
        setFlash('success', $message);
        redirect('colleges', ['pages' => 'Manage Colleges and Departments']);
    }

endif;

if (isset($_POST['addcourse'])) :
    if ($_SERVER['REQUEST_METHOD'] === 'POST') :

        $department = $_POST['department'];
        $course = $_POST['courses'];

        $save = save('course', ['department_id' => $department, 'course_name' => $course, 'course_status' => 1]);

        if ($save) {
            setFlash('success', 'Course added Successfully');
            redirect('colleges', ['pages' => 'Manage Colleges and Departments']);
        }
    endif;
endif;

if (isset($_POST['updatecourse'])) :
    if ($_SERVER['REQUEST_METHOD'] === 'POST') :

        $department = $_POST['department'];
        $course = $_POST['course'];
        $course_id = $_POST['course_id'];

        $save = update('course', ['course_id' => $course_id], ['department_id' => $department, 'course_name' => $course, 'course_status' => 1]);

        if ($save) {
            setFlash('success', 'Course added Successfully');
            redirect('colleges', ['pages' => 'Manage Colleges and Departments']);
        }
    endif;
endif;

if (isset($_GET['activationCourse'])) :

    if ($_GET['status'] == 1) {
        $status = 0;
        $message = "Course Deactivated";
    } else {
        $status = 1;
        $message = "Course Activated";
    }

    $update = update('course', ['course_id' => $_GET['course_id']], ['course_status' => $status]);
    if ($update) {
        setFlash('success', $message);
        redirect('colleges', ['pages' => 'Manage Colleges and Departments']);
    }

endif;
if (isset($_POST['addyear'])) :
    if ($_SERVER['REQUEST_METHOD'] === 'POST') :

        $year = $_POST['year'];

        $save = save('year', ['year_num' => $year]);

        if ($save) {
            setFlash('success', 'Year added Successfully');
            redirect('colleges', ['pages' => 'Manage Colleges and Departments']);
        }
    endif;
endif;

if (isset($_POST['edityear'])) :
    if ($_SERVER['REQUEST_METHOD'] === 'POST') :
        $year = $_POST['year'];
        $year_id = $_POST['year_id'];

        $update = update('year', ['year_id' => $year_id], ['year_num' => $year]);
        if ($update) {
            setFlash('success', 'Year Updated Successfully');
            redirect('colleges', ['pages' => 'Manage Colleges and Departments']);
        }
    endif;
endif;

if (isset($_GET['activationYear'])) :

    if ($_GET['status'] == 1) {
        $status = 0;
        $message = "Year Deactivated";
    } else {
        $status = 1;
        $message = "Year Activated";
    }

    $update = update('year', ['year_id' => $_GET['year_id']], ['year_status' => $status]);
    if ($update) {
        setFlash('success', $message);
        redirect('colleges', ['pages' => 'Manage Colleges and Departments']);
    }

endif;

if (isset($_POST['addsection'])) :
    if ($_SERVER['REQUEST_METHOD'] === 'POST') :

        $section = $_POST['section'];

        $save = save('section', ['section_name' => $section]);

        if ($save) {
            setFlash('success', 'Section added Successfully');
            redirect('colleges', ['pages' => 'Manage Colleges and Departments']);
        }
    endif;
endif;


if (isset($_POST['editSection'])) :
    if ($_SERVER['REQUEST_METHOD'] === 'POST') :
        $section = $_POST['section'];
        $section_id = $_POST['section_id'];

        $update = update('section', ['section_id' => $section_id], ['section_name' => $section]);
        if ($update) {
            setFlash('success', 'Section Updated Successfully');
            redirect('colleges', ['pages' => 'Manage Colleges and Departments']);
        }
    endif;
endif;

if (isset($_GET['activationSection'])) :

    if ($_GET['status'] == 1) {
        $status = 0;
        $message = "Section Deactivated";
    } else {
        $status = 1;
        $message = "Section Activated";
    }

    $update = update('section', ['section_id' => $_GET['section_id']], ['section_status' => $status]);
    if ($update) {
        setFlash('success', $message);
        redirect('colleges', ['pages' => 'Manage Colleges and Departments']);
    }

endif;
