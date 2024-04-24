<?php
require_once('../config/config.php');

if (isset($_SESSION['Admin_ID'])) :

    $starting_date = date('Y-m-d', strtotime('monday this week'));
    $end_date = date('Y-m-d', strtotime('+6 days', strtotime('monday this week')));
    $next_week_start = strtotime('next monday');
    $next_week_end = strtotime('+6 days', $next_week_start);
    $starting_date_nxt = date('Y-m-d', $next_week_start);
    $end_date_nxt  = date('Y-m-d', $next_week_end);

    $today_admin = countResutlt('request', ['request_DateTime' => date('Y-m-d')]);
    $students = countResutlt('student', ['student_Status' => 1]);

    $accepted = countResutlt('request', ['request_Status' => 1,]);

    $pending = countResutlt('request', ['request_Status' => 0,]);


endif;


if (isset($_SESSION['teacher_ID'])) {
    $today_teacher = countResutlt('request', ['DATE(request_DateTime)' => date('Y-m-d'), 'teacher_ID' => $_SESSION['teacher_ID']]);

    $this_week_teacher = countResultBetween(
        'request',
        [
            'teacher_ID' => $_SESSION['teacher_ID'],
            ['request_DateTime', '>=', $starting_date],
            ['request_DateTime', '<=', $end_date]
        ]
    );
    $accepted_teacher = countResutlt('request', ['request_Status' => 1, 'teacher_ID' => $_SESSION['teacher_ID']]);
    $pending_teacher = countResutlt('request', ['request_Status' => 0, 'teacher_ID' => $_SESSION['teacher_ID']]);
}


if (isset($_SESSION['student_ID'])) {
    $today_student = countResutlt('request', ['DATE(request_DateTime)' => date('Y-m-d'), 'student_ID' => $_SESSION['student_ID']]);

    $this_week_student = countResultBetween(
        'request',
        [
            'student_ID' => $_SESSION['student_ID'],
            ['request_DateTime', '>=', $starting_date],
            ['request_DateTime', '<=', $end_date]
        ]
    );
    $accepted_student = countResutlt('request', ['request_Status' => 1, 'student_ID' => $_SESSION['student_ID']]);
    $pending_student = countResutlt('request', ['request_Status' => 0, 'student_ID' => $_SESSION['student_ID']]);
}
