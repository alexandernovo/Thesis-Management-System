<?php
require_once("../config/authAdmin.php");
require_once("./adminNavbar.php"); ?>
<?php
$users = $_GET['users'];
?>
<div class="container-fluid py-4 mb-5">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 pb-5">
                <div class="card-header pb-0 d-flex mb-3 justify-content-between mx-4">
                    <h6>Register <?php echo $users == "students" ? "Student" : ($users == "teacher" ? "Teacher" : ($users == "admins" ? "Admin" : "")) ?></h6>
                </div>
                <form method="post" action="../actions/registerTeacher.php">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="row mx-auto">
                            <div class="col-md-11 mx-auto p-0">
                                <div class="row mx-auto p-0">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Firstname</label>
                                            <input class="form-control" name="firstname" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Lastname</label>
                                            <input class="form-control" name="lastname" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mx-auto p-0">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Colleges</label>
                                            <select class="form-select" name="college" id="college">
                                                <?php $colleges = findAll('college'); ?>
                                                <option disabled>Please Select a College</option>
                                                <?php foreach ($colleges as $row) : ?>
                                                    <option value="<?= $row['college_id'] ?>"><?= $row['college_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Department</label>
                                            <select class="form-select" id="department" name="department">

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mx-auto p-0">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <input class="form-control" name="email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Username</label>
                                            <input class="form-control" name="username" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mx-auto p-0">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Password</label>
                                            <input class="form-control" id="password" name="password" required type="password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Confirm Password</label>
                                            <input class="form-control" id="conf-password" name="confirmpassword" type="password" required>
                                            <span id="conf-password-error" class="text-danger m-0" style="font-size: 11px;"></span>
                                        </div>
                                    </div>
                                    <input type="hidden" name="pages" value="<?php echo $_GET['pages'] ?>">
                                    <input type="hidden" name="users" value="<?php echo $_GET['users'] ?>">
                                </div>
                                <div class="row mx-auto mx-auto p-0" id="row-cloned">
                                    <div id="row-of-form" class="col-md-3">
                                        <div class="form-group">
                                            <label>Specialization</label>
                                            <div class="d-flex align-items-center">
                                                <input class="form-control special me-1" id="special" name="special[]" placeholder="Specialization">
                                                <i class="fa fa-times remove text-danger cursor-pointer" style="display: none;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mx-auto p-0">
                                    <div class="col-md-12">
                                        <div class="form-group d-flex">
                                            <button class="btn btn-primary me-2 btn-sm" type="button" id="add"><i class="fa fa-plus-circle text-size"></i> Specialization</button>
                                            <button type="submit" name="register_teacher" class="btn btn-primary btn-sm"><i class="fa fa-user-plus me-1 text-size"></i> Register</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php require_once("./footer.php"); ?>