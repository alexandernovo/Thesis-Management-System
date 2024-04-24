<?php
require_once("./studentNavbar.php");
$request = first('request', ['request_ID' => $_GET['request_ID']]);
$teacher = first('teacher', ['teacher_ID' => $request['teacher_ID']]);
?>
<div class="container-fluid py-4 mb-5">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header mx-3 mb-1">
                    <h3 class="text-center mt-4">
                        <?= $request['research_Title'] ?>
                    </h3>
                    <h6>Requested to: <?= $teacher['teacher_Fname'] . ' ' . $teacher['teacher_Lname'] ?></h6>
                    <label>Research Problem</label>
                    <textarea class="form-control" readonly><?= $request['research_Problem'] ?></textarea>
                    <label class="mt-3">Research Solution</label>
                    <textarea class="form-control" readonly><?= $request['research_Solution'] ?></textarea>
                </div>
                <div class="card-body px-0 pt-0 pb-2 px-3 mx-4">
                    <iframe style="width:100%; height:1000px; border-radius:15px" src="<?= $request['research_File'] ?>#toolbar=0"></iframe>
                </div>
                <!-- #toolbar=0 -->
            </div>

        </div>
    </div>
</div>

<?php require_once("./footer.php"); ?>