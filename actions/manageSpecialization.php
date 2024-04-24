<?php
require('../config/config.php');

if (isset($_POST['add_specialization'])) :

    $specialization = $_POST['specialization'];
    $save = save('specialization', ['Specialization_name' => $specialization]);

    if ($save) {
        setFlash('success', 'Specialization Added Successfully');
        redirect('specialization', ['pages' => 'Manage Specialization']);
    } else {
        setFlash('failed', 'Adding Failed');
        redirect('specialization', ['pages' => 'Manage Specialization']);
    }

endif;
