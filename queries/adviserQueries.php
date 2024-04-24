<?php
require_once('../config/config.php');

function advisers($search)
{
    global $conn;

    $search_string = "%" . $search . "%";

    $stmt = mysqli_prepare($conn, "
        SELECT teacher.teacher_ID,teacher.teacher_Fname,teacher.teacher_Lname,teacher.teacher_Profile,teacher.teacher_Username,teacher.teacher_Email, GROUP_CONCAT(DISTINCT specialization.specialization_name SEPARATOR ', ') AS specialization_names, department.department_id,college.college_id, department.department_name, college.college_name
        FROM teacher
        LEFT JOIN specialization ON teacher.teacher_ID = specialization.teacher_ID
        JOIN department ON teacher.department_id = department.department_id
        JOIN college ON college.college_id = department.college_id
        WHERE teacher.teacher_Fname LIKE ?
           OR teacher.teacher_Lname LIKE ?
           OR teacher.teacher_Username LIKE ?
           OR teacher.teacher_Email LIKE ?
           OR specialization.specialization_name LIKE ?
           OR department.department_name LIKE ?
           OR college.college_name LIKE ?
        GROUP BY teacher.teacher_ID
    ");
    mysqli_stmt_bind_param($stmt, "sssssss", $search_string, $search_string, $search_string, $search_string, $search_string, $search_string, $search_string);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    return $result;
}
