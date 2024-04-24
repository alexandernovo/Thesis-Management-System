<?php
require_once('../config/config.php');
$check_adviser = first('request', ['student_ID' => $_SESSION['student_ID'], 'request_Status' => 1]);
if (isset($_GET['normal'])) :
    if (!empty($check_adviser)) {
        $teacher = find_where('teacher', ['teacher_ID' => $check_adviser['teacher_ID']]);
    } else {
        $teacher = findAll('teacher');
    }
endif;

if (isset($_GET['search'])) :
    $search = $_GET['adviserSearch'];
    if (!empty($check_adviser)) {
        $teacher = find_where('teacher', ['teacher_ID' => $check_adviser['teacher_ID']]);
    } else {
        $teacher = advisers($search);
    }
endif;

foreach ($teacher as $row) :

    $department = first('department', ['department_id' => $row['department_id']]);
    $college = first('college', ['college_id' => $department['college_id']]); ?>

    <div class="col-md-3 mb-3">
        <div class="card" style="height:450px !important">
            <div class="card-body">
                <div class="row">
                    <img class="image-style p-0 border rounded-circle mx-auto" src="<?php echo !empty($row['teacher_Profile']) ? $row['teacher_Profile'] : "../public/assets/img/default.png" ?>">
                    <h6 class="h6 text-center m-0 mt-2"><?= $row['teacher_Fname'] . ' ' . $row['teacher_Lname'] ?></h6>
                    <p class="text-size m-0 text-center mt-1"><?= $college['college_name'] ?></p>
                    <p class="text-size m-0 text-center mt-1 mb-4"><?= $department['department_name'] ?></p>
                    <div class="row mx-auto my-3">
                        <?php
                        $check_first = last('request', ['student_ID' => $_SESSION['student_ID']], "request_ID");
                        if ($check_first && ($check_first['request_Status'] != 2 && $check_first['request_Status'] != 3 && $check_first['request_Status'] != 4)) {
                            $check = last('request', ['teacher_ID' => $row['teacher_ID'], 'student_ID' => $_SESSION['student_ID']], "request_ID");
                            if (empty($check)) { ?>
                                <button class="btn btn-secondary btn-sm m-0 text-white" disabled data-bs-toggle="modal" data-bs-target="#request<?= $row['teacher_ID'] ?>"><i class="fa fa-ban text-size me-1"></i>Cannot Request</button>
                                <?php
                            } else if ($check['request_Status'] == 0 || $check['request_Status'] == 1) {
                                if ($check['request_Status'] == 0) : ?>
                                    <button class="btn btn-secondary btn-sm m-0 cancelRequest" request-ID="<?= $check['request_ID'] ?>"><i class="fa fa-times text-size"></i> Cancel Request</button>
                                <?php endif;
                                if ($check['request_Status'] == 1) : ?>
                                    <button class="btn btn-success btn-sm m-0"><i class="fa fa-user-circle text-size"></i> Your Adviser</button>
                                <?php endif;
                            } else { ?>
                                <button class="btn btn-primary btn-sm m-0" data-bs-toggle="modal" data-bs-target="#request<?= $row['teacher_ID'] ?>"><i class="fa fa-paper-plane text-size"></i> Request</button>
                            <?php }
                        } else { ?>
                            <?php $max_adviser = countResutlt('request', ['teacher_ID' => $row['teacher_ID'], 'request_Status' => 1]);
                            if ($max_adviser == 5) {
                            ?>
                                <button class="btn btn-secondary text-white btn-sm m-0" disabled><i class="fa fa-ban text-size"></i> Max Advisory</button>

                            <?php } else { ?>
                                <button class="btn btn-primary btn-sm m-0" data-bs-toggle="modal" data-bs-target="#request<?= $row['teacher_ID'] ?>"><i class="fa fa-paper-plane text-size"></i> Request</button>
                            <?php } ?>
                        <?php }
                        ?>
                        <a href="./studentTeachAvail.php?teacher_ID=<?= $row['teacher_ID'] ?>&pages=Availability" class="btn btn-info btn-sm m-0 mt-2"><i class="text-size fa fa-calendar"></i> Availability</a>

                    </div>
                    <p class="text-size m-0 text-start my-1">Specialization: </p>
                    <div class="d-flex justify-content-start flex-wrap">
                        <?php $find = find_where('specialization', ['teacher_ID' => $row['teacher_ID']], 3);
                        foreach ($find as $result) :
                        ?>
                            <p class="text-size border px-1 rounded bg-secondary text-light m-0 mb-1" style="padding-top:1px;padding-bottom:1px;"><?= $result['Specialization_name'] ?></p>
                        <?php endforeach; ?>
                        <p class="text-size border px-1 rounded bg-secondary text-light m-0 mb-1 cursor-pointer" data-bs-toggle="modal" data-bs-target="#specialization<?= $row['teacher_ID'] ?>"><i class="fa fa-ellipsis-h"></i></p>
                        <div class="modal fade" id="specialization<?= $row['teacher_ID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $row['teacher_Fname'] . ' ' . $row['teacher_Lname'] ?> Specialization</h1>
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

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="request<?= $row['teacher_ID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Request Advisory to <?= $row['teacher_Fname'] . ' ' . $row['teacher_Lname'] ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <div class="row mx-auto py-3">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="research_Title<?= $row['teacher_ID'] ?>" placeholder="Leave a comment here" required></textarea>
                                <label for="floatingTextarea">Research Title</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" style="height: 100px" id="research_Problem<?= $row['teacher_ID'] ?>" placeholder="Leave a comment here" required></textarea>
                                <label for="floatingTextarea">Problem</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" style="height: 100px" id="research_Solution<?= $row['teacher_ID'] ?>" placeholder="Leave a comment here" required></textarea>
                                <label for="floatingTextarea">Solution</label>
                            </div>
                            <div class="form-group">
                                <label>File (PDF)</label>
                                <input class="form-control" id="research_File<?= $row['teacher_ID'] ?>" accept="application/pdf" type="file" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="fa fa-times text-size"></i> Cancel</button>
                    <button type="button" class="btn btn-primary btn-sm request" teacher-ID="<?= $row['teacher_ID'] ?>" student-ID="<?php echo $_SESSION['student_ID'] ?>"><i class="fa fa-paper-plane text-size"></i> Request</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach;
