<?php
require_once("./teacherNavbar.php");
// $request = joinTable('request', [['student', 'student.student_ID', 'request.student_ID']], ['request.teacher_ID' => $_SESSION['teacher_ID'], 'request.request_Status' => 1]);
$teacher_ID = $_SESSION['teacher_ID'];
$query = mysqli_query($conn, "
    SELECT * FROM student as s 
    INNER JOIN request as r ON r.student_ID = s.student_ID 
    INNER JOIN teacher as t ON t.teacher_ID = r.teacher_ID 
    WHERE t.teacher_ID = '$teacher_ID'
    AND r.request_STATUS IN (1, 4)
");
if ($query) {
    $request = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $request[] = $row;
    }
}

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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">Status</th>
                                    <th></th>
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
                                        <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0 <?php echo $row['request_Status'] == 0 ? "text-info" : ($row['request_Status'] == 1 || $row['request_Status'] == 4 ? "text-success" : ($row['request_Status'] == 2 ? "text-danger" : ($row['request_Status'] == 3 ? "text-warning" : ""))) ?>"><?php echo $row['request_Status'] == 0 ? "Pending" : ($row['request_Status'] == 1 ? "Accepted" : ($row['request_Status'] == 2 ? "Rejected" : ($row['request_Status'] == 3 ? "Cancelled" : ($row['request_Status'] == 4 ? "Completed" : "")))) ?></p>
                                        </td>
                                        <td class="align-middle">
                                            <a href="./teacherRequestDetails.php?request_id=<?= $row['request_ID'] ?>&pages=Request Details" class="text-secondary font-weight-bold text-xs">
                                                <i class="fa fa-eye"></i> View
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <?php if ($row['request_Status'] != 4) : ?>
                                                <button data-bs-toggle="modal" data-bs-target="#options<?= $row['request_ID'] ?>" class="btn btn-primary btn-sm d-flex align-items-center mb-0 px-3 py-1 rounded">
                                                    <i class="fa fa-cog me-1" style="font-size: 13px;"></i>
                                                    Options
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="options<?= $row['request_ID'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5 d-flex align-items-center" id="staticBackdropLabel">
                                                        <i class="fa fa-cog me-1" style="font-size: 13px;"></i>
                                                        Options
                                                    </h1>
                                                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="fa fa-times me-1"></i>
                                                    </button>
                                                </div>

                                                <div class="modal-footer d-flex">
                                                    <div class="col-12">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="col-6 me-1">
                                                                <div class="row mx-auto">
                                                                    <a href="../actions/manageRequest.php?rejectFinal&request_id=<?= $row['request_ID'] ?>" class="reject_button btn btn-danger d-flex align-items-center justify-content-center">
                                                                        <i class="fa fa-times me-1"></i>
                                                                        Reject
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 ms-1">
                                                                <div class="row mx-auto">
                                                                    <a href="../actions/manageRequest.php?completed&request_id=<?= $row['request_ID'] ?>" class="accept_button btn btn-success d-flex align-items-center justify-content-center">
                                                                        <i class="fa fa-check me-1"></i>
                                                                        Completed
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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