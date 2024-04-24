<?php
require_once("../config/authAdmin.php");
require_once("./adminNavbar.php");
$request = joinTable('request', [['student', 'student.student_ID', 'request.student_ID'], ['teacher', 'teacher.teacher_ID', 'request.teacher_ID']]);
?>
<div class="container-fluid py-4 mb-5">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex mb-3 justify-content-between mx-4">
                    <h6></h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0 px-3 pb-3">
                        <table class="table align-items-center mb-0" id="example">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Student</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">Research Title</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">Requested to:</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($request as $row) : ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="<?php echo !empty($row['student_Profile']) ? $row['student_Profile'] : "../public/assets/img/default.png" ?>" class="avatar avatar-sm me-3" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?= $row['student_Fname'] . ' ' . $row['student_Lname'] ?></h6>
                                                    <p class="text-xs text-secondary mb-0"><?= $row['student_Email'] ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0"><?= $row['research_Title'] ?></p>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="<?php echo !empty($row['teacher_Profile']) ? $row['teacher_Profile'] : "../public/assets/img/default.png" ?>" class="avatar avatar-sm me-3" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?= $row['teacher_Fname'] . ' ' . $row['teacher_Lname'] ?></h6>
                                                    <p class="text-xs text-secondary mb-0"><?= $row['teacher_Email'] ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0 <?php echo $row['request_Status'] == 0 ? "text-info" : ($row['request_Status'] == 1 ? "text-success" : ($row['request_Status'] == 2 ? "text-danger" : ($row['request_Status'] == 3 ? "text-warning" : ""))) ?>"><?php echo $row['request_Status'] == 0 ? "Pending" : ($row['request_Status'] == 1 ? "Accepted" : ($row['request_Status'] == 2 ? "Rejected" : ($row['request_Status'] == 3 ? "Cancelled" : ""))) ?></p>
                                        </td>
                                        <td class="align-middle">
                                            <a href="./requestDetails.php?request_id=<?= $row['request_ID'] ?>&pages=Request Details" class="text-secondary font-weight-bold text-xs">
                                                <i class="fa fa-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once("./footer.php"); ?>