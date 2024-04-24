<?php require_once('teacherNavbar.php'); ?>
<?php
$last = isset($_GET['from']) ? $_GET['from'] : $lastyear;
$this_now = isset($_GET['to']) ? $_GET['to'] : $thisyear;
?>
<div class="container-fluid py-4 mb-5">
    <div class="row mx-auto">
        <div class="d-flex justify-content-center mb-2">
            <!-- <i class="fa fa-download me-3 border p-3 rounded shadow cursor-pointer" onclick="CreatePDFfromHTML()"></i> -->
            <i class="fa fa-print border p-3 rounded shadow cursor-pointer" id="print-btn"> Print</i>
        </div>
    </div>
    <div class="row mx-auto mb-3">
        <div class="col-md-5 mx-auto">
            <form method="get">
                <div class="row mx-auto">
                    <div class="col-md-6">
                        <label>From:</label>
                        <input class="form-control" name="from" value="<?php echo $last; ?>" type="date" onchange="this.form.submit()">
                    </div>
                    <input name="pages" type="hidden" value="Generate Report">
                    <div class="col-md-6">
                        <label>To:</label>
                        <input class="form-control" name="to" value="<?php echo $this_now; ?>" type="date" onchange="this.form.submit()">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row mx-auto">
        <div class="bond-paper border mx-auto shadow" id="bond-paper">
            <div id="pdf">
                <div class="row mx-auto">
                    <h5><strong>Generate Report</strong></h5>
                    <p class="m-0 timestyle"><?php echo date('M. d, Y', strtotime($last)) ?> to <?php echo date('M. d, Y', strtotime($this_now)) ?></p>
                </div>
                <div class="row mx-auto mt-3">
                    <table class="table table-generate table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Research Title</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $teacher_id = $_SESSION['teacher_ID'];
                            $query = "SELECT * FROM student
                        JOIN request ON student.student_ID = request.student_ID
                        WHERE request.request_Status = 1 AND request.teacher_ID ='$teacher_id'
                        AND DATE(request.request_DateTime) >= '$last' AND DATE(request.request_DateTime) <='$this_now';
                        ";
                            $result = $conn->query($query);
                            $generate = $result->fetch_all(MYSQLI_ASSOC); ?>

                            <?php foreach ($generate as $row) : ?>
                                <tr>
                                    <td><?= $row['student_Fname'] . ' ' . $row['student_Lname'] ?></td>
                                    <td><?= $row['research_Title'] ?></td>
                                    <td>Accepted</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>