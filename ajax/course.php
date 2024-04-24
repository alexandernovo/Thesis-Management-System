<?php
require_once('../config/config.php');

$colleges_id = $_GET['colleges_id'];

$department = find_where('department', ['college_id' => $colleges_id]);

foreach ($department as $row) : ?>
    <option value="<?= $row['department_id'] ?>"><?= $row['department_name'] ?></option>
<?php endforeach ?>