<?php
require('../config/config.php');
if (isset($_POST['updateRequest'])) :
    $research_Title = $_POST['research_Title'];
    $research_Problem = $_POST['research_Problem'];
    $research_Solution = $_POST['research_Solution'];
    $request_ID = $_POST['request_ID'];

    if ($_FILES['research_File']['size'] == 0) {
        $data = [
            'research_Title' => $research_Title,
            'research_Problem' => $research_Problem,
            'research_Solution' => $research_Solution
        ];
        $update = update('request', ['request_ID' => $request_ID], $data);
    } else {
        $file_name = $_FILES['research_File']['name'];
        $file_temp = $_FILES['research_File']['tmp_name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_new_name = uniqid() . '.' . $file_ext;
        $file_dest = '../public/assets/requestFile/' . $file_new_name;

        if (move_uploaded_file($file_temp, $file_dest)) {
            $data = [
                'research_Title' => $research_Title,
                'research_Problem' => $research_Problem,
                'research_Solution' => $research_Solution,
                'research_File' => $file_dest
            ];
            $update = update('request', ['request_ID' => $request_ID], $data);
        }
    }

    if ($update) {
        setFlash('success', 'Updated Successfully');
        redirect('studentRequest', ['pages' => 'Request']);
    } else {
        setFlash('failed', 'Update Failed');
        redirect('studentRequest', ['pages' => 'Request']);
    }
endif;
