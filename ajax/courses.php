<?php
require_once('../config/config.php');

$department_id = $_GET['department_id'];

$course = find_where('course', ['department_id' => $department_id]);

foreach ($course as $row) : ?>
    <option value="<?= $row['course_id'] ?>"><?= $row['course_name'] ?></option>
<?php endforeach ?>