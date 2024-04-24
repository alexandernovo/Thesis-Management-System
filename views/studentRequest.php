<?php
require_once("./studentNavbar.php");
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Teacher</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">College</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">Department</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">Remark</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">Specialization</th>
                                    <th></th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $request = joinTable('request', [['teacher', 'teacher.teacher_ID', 'request.teacher_ID'], ['department', 'department.department_id', 'teacher.department_ID'], ['college', 'college.college_id', 'department.college_id']], ['request.student_ID' => $_SESSION['student_ID']]);
                                foreach ($request as $row) :
                                ?>
                                    <tr>
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
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 "><?= $row['college_name'] ?></p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 "><?= $row['department_name'] ?></p>
                                        </td>

                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 <?php echo $row['request_Status'] == 0 ? "text-secondary" : ($row['request_Status'] == 1 || $row['request_Status'] == 4 ? "text-success" : ($row['request_Status'] == 2 ? "text-danger" : "text-warning")); ?>"><?php echo $row['request_Status'] == 0 ? "Pending" : ($row['request_Status'] == 1 ? "Accepted" : ($row['request_Status'] == 2 ? "Rejected" : ($row['request_Status'] == 4 ? "Completed" : "Cancelled"))); ?></p>
                                        </td>
                                        <td>
                                            <?php if ($row['request_Status'] == 1 || $row['request_Status'] == 2) { ?>
                                                <p class="text-xs font-weight-bold mb-0 cursor-pointer" data-bs-toggle="modal" data-bs-target="#remark"><i class="fa fa-eye"></i> Remark</p>
                                            <?php } else { ?>
                                                <p class="text-xs font-weight-bold mb-0 text-center"> N/A</p>
                                            <?php }  ?>


                                            <div class="modal fade" id="remark" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Remarks</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Remarks</label>
                                                                <textarea class="form-control" style="height: 150px;" placeholder="Remarks" readonly><?php echo $row['remarks'] != null ? $row['remarks'] : '' ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="ps-3">
                                            <a class="text-secondary font-weight-bold text-xs text-center cursor-pointer" data-bs-toggle="modal" data-bs-target="#specialization<?= $row['request_ID'] ?>">
                                                <i class="fa fa-eye"></i>
                                                Specialization
                                            </a>

                                        </td>
                                        <td>
                                            <?php if ($row['request_Status'] == 0) { ?>
                                                <a class="text-success font-weight-bold text-xs text-center cursor-pointer edit-link" data-bs-toggle="modal" data-bs-target="#request<?= $row['request_ID'] ?>">
                                                    <i class="fa fa-edit text-success edit"></i>
                                                    <p class="text">Edit</p>
                                                </a>
                                            <?php } else { ?>
                                                <a class="text-secondary font-weight-bold text-xs text-center text-center">N/A</a>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="./studentViewRequest.php?request_ID=<?= $row['request_ID'] ?>&pages=View Request" class="text-secondary font-weight-bold text-xs text-center cursor-pointer">
                                                <i class="fa fa-eye"></i>
                                                View Request
                                            </a>
                                        </td>
                                    </tr>


                                    <!-- specialization -->
                                    <div class="modal fade" id="specialization<?= $row['request_ID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Specialization</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php $findAll = find_where('specialization', ['teacher_ID' => $row['teacher_ID']]); ?>
                                                    <?php
                                                    $indexing = 1;
                                                    foreach ($findAll as $result) : ?>
                                                        <div class="d-flex justify-content-start align-items-center mb-3">
                                                            <p class="text-size m-0 me-2"><?php echo $indexing . '. ';
                                                                                            $indexing++; ?></p>
                                                            <i class="fa fa-tools"></i>
                                                            <p class="text-size m-0 px-2 bg-secondary ms-2 rounded text-light"><?= $result['Specialization_name'] ?></p>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="fa fa-times text-size"></i> Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="request<?= $row['request_ID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Request to <?= $row['teacher_Fname'] . ' ' . $row['teacher_Lname'] ?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="post" action="../actions/updateRequest.php">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="request_ID" value="<?= $row['request_ID'] ?>">
                                                        <div class="row mx-auto py-3">
                                                            <div class="form-floating mb-3">
                                                                <textarea class="form-control" name="research_Title" placeholder="Leave a comment here" required><?= $row['research_Title'] ?></textarea>
                                                                <label for="floatingTextarea">Research Title</label>
                                                            </div>
                                                            <div class="form-floating mb-3">
                                                                <textarea class="form-control" style="height: 100px" name="research_Problem" placeholder="Leave a comment here" required><?= $row['research_Problem'] ?></textarea>
                                                                <label for="floatingTextarea">Problem</label>
                                                            </div>
                                                            <div class="form-floating mb-3">
                                                                <textarea class="form-control" style="height: 100px" name="research_Solution" placeholder="Leave a comment here" required><?= $row['research_Solution'] ?></textarea>
                                                                <label for="floatingTextarea">Solution</label>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>File (PDF <i>Optional</i>)</label>
                                                                <input class="form-control" name="research_File" accept="application/pdf" type="file">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="fa fa-times text-size"></i> Cancel</button>
                                                        <button type="submit" class="btn btn-primary btn-sm request" name="updateRequest"><i class="fa fa-edit text-size"></i> Update</button>
                                                    </div>
                                                </form>
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