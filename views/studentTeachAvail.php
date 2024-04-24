<?php
require_once("./studentNavbar.php");
?>
<?php $teacher = first('teacher', ['teacher_ID' => $_GET['teacher_ID']]); ?>
<div class="container-fluid py-4">
    <div class="row mx-auto">
        <div class="d-flex align-items-center mb-4">
            <img src="../public/assets/img/default.png" class="avatar avatar-sm me-3" alt="user1">
            <h4 class="m-0"><?= $teacher['teacher_Fname'] . ' ' . $teacher['teacher_Lname'] ?>`s Availability</h4>
        </div>
    </div>
    <div class="row mx-auto pb-5">
        <div class="col-md-11 mx-auto pb-5">
            <div id="calendarStudent" teacher-ID="<?php echo isset($_GET['teacher_ID']) ? $_GET['teacher_ID'] : "" ?>" style="width: 100%; height:500px" class="mb-4"></div>
        </div>
    </div>
</div>

<?php require_once("./footerCalendar.php"); ?>