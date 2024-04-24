<?php
require_once('../config/config.php');

if (isset($_GET['deleteSpecial'])) :
    $Specialization_ID = $_GET['specialization_ID'];

    $delete = delete('specialization', ['Specialization_ID' => $Specialization_ID]);
    if ($delete) {
        setFlash('success', 'Specialization Deleted');
        redirect('teacherSpecialization', ['pages' => 'Specialization']);
    }
    setFlash('failed', 'Specialization Deleting Failed');
    redirect('teacherSpecialization', ['pages' => 'Specialization']);

endif;


if (isset($_POST['updateSpecial'])) :
    $specialization = $_POST['specialization'];
    $specialization_id = $_POST['specialization_id'];

    $update = update('specialization', ['Specialization_ID' => $specialization_id], ['Specialization_name' => $specialization]);
    if ($update) {
        setFlash('success', 'Specialization Updated Successfully');
        redirect('teacherSpecialization', ['pages' => 'Specialization']);
    }
    setFlash('failed', 'Specialization Updating Failed');
    redirect('teacherSpecialization', ['pages' => 'Specialization']);
endif;


if (isset($_POST['addSpecial'])) :
    $specialization = $_POST['specialization'];
    $teacher_ID = $_POST['teacher_ID'];

    $save = save('specialization', ['teacher_ID' => $teacher_ID, 'Specialization_name' => $specialization]);
    if ($save) {
        setFlash('success', 'Specialization Added Successfully');
        redirect('teacherSpecialization', ['pages' => 'Specialization']);
    }
    setFlash('falied', 'Specialization Adding Failed');
    redirect('teacherSpecialization', ['pages' => 'Specialization']);
endif;
