<?php
require_once("./teacherNavbar.php");
$request = first('request', ['request_ID' => $_GET['request_id']]);
$teacher = first('student', ['student_ID' => $request['student_ID']]);
?>
<div class="container-fluid py-4 mb-5">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header mx-3 mb-1">
                    <h3 class="text-center mt-4">
                        <?= $request['research_Title'] ?>
                    </h3>
                    <h6>Requested by: <?= $teacher['student_Fname'] . ' ' . $teacher['student_Lname'] ?></h6>
                    <label>Research Problem</label>
                    <textarea class="form-control" readonly><?= $request['research_Problem'] ?></textarea>
                    <label class="mt-3">Research Solution</label>
                    <textarea class="form-control" readonly><?= $request['research_Solution'] ?></textarea>
                </div>
                <div class="card-body px-0 pt-0 pb-2 px-3 mx-4">
                    <iframe class="border" style="width:100%; height:1000px; border-radius:15px" src="<?= $request['research_File'] ?>"></iframe>
                    <?php
                    $countAccepted = countResutlt('request', ['teacher_ID' => $_SESSION['teacher_ID'], 'request_Status' => 1]);
                    if ($request['request_Status'] != 1 && $request['request_Status'] != 4) {
                        if ($countAccepted <= 5) {
                            if ($countAccepted == 5) {
                    ?>
                                <a class="btn btn-secondary btn-sm me-2 float-end" disable><i class="fa fa-times text-size"></i> Already 5 Advisories</a>
                            <?php
                            } else { ?>
                                <?php if ($request['request_Status'] == 0) : ?>
                                    <div class="row mx-auto">
                                        <div class="d-flex justify-content-end align-items-center">
                                            <a class="btn btn-danger btn-sm me-2" data-bs-toggle="modal" data-bs-target="#reject"><i class="fa fa-times text-size"></i> Reject</a>
                                            <a class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#accept"><i class="fa fa-check text-size"></i> Accept</a>
                                        </div>
                                    </div>
                                <?php
                                endif;
                                ?>
                            <?php }
                        } else { ?>
                            <div class="row mx-auto">
                                <a class="btn btn-secondary btn-sm me-2" disable><i class="fa fa-times text-size"></i> Already 5 Advisories</a>
                            </div>
                    <?php }
                    }
                    ?>
                </div>
                <!-- #toolbar=0 -->
            </div>

        </div>
    </div>
</div>
<!-- Reject Modal -->
<div class="modal fade" id="reject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa fa-trash"></i> Reject</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="../actions/manageRequest.php">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Remarks</label>
                        <input name="request_id" type="hidden" value="<?php echo $_GET['request_id'] ?>">
                        <textarea class="form-control" style="height: 150px;" placeholder="Remarks" name="remarks"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" name="reject" class="btn btn-primary"><i class="fa fa-trash"></i> Reject</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Accept Modal -->
<div class="modal fade" id="accept" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa fa-check"></i> Accept</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="../actions/manageRequest.php">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Remarks</label>
                        <input name="request_id" type="hidden" value="<?php echo $_GET['request_id'] ?>">
                        <textarea class="form-control" style="height: 150px;" placeholder="Remarks" name="remarks"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" name="accept" class="btn btn-primary"><i class="fa fa-check"></i> Accept</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once("./footer.php"); ?>