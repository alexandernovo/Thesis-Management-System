<?php
require_once('../config/config.php');
$college_ID = $_GET['college_id'];

$find = find_where('department', ['college_id' => $college_ID]);

foreach ($find as $row) : ?>
    <option value="<?= $row['department_id'] ?>"><?= $row['department_name'] ?></option>
<?php endforeach; ?>