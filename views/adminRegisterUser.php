<?php
require_once("../config/authAdmin.php");
require_once("./adminNavbar.php");
?>
<?php
$users = $_GET['users'];
?>
<div class="container-fluid py-4 mb-5">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 pb-5">
                <div class="card-header pb-0 d-flex mb-3 justify-content-between mx-4">
                    <h6>Register <?php echo $users == "students" ? "Student" : ($users == "teachers" ? "Teacher" : ($users == "admins" ? "Admin" : "")) ?></h6>
                </div>
                <form method="post" action="../actions/registerUser.php">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="row mx-auto">
                            <div class="col-md-11 mx-auto p-0">
                                <div class="row mx-auto p-0">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Firstname</label>
                                            <input class="form-control" name="firstname" value="<?php echo getValue('firstname'); ?>">
                                            <?php if (showError('firstname')) :
                                                echo showError('firstname');
                                            endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Lastname</label>
                                            <input class="form-control" name="lastname" value="<?php echo getValue('lastname'); ?>">
                                            <?php if (showError('lastname')) :
                                                echo showError('lastname');
                                            endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mx-auto p-0">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <input class="form-control" name="email" value="<?php echo getValue('email'); ?>">
                                            <?php if (showError('email')) :
                                                echo showError('email');
                                            endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Username</label>
                                            <input class="form-control" name="username" value="<?php echo getValue('username'); ?>">
                                            <?php if (showError('username')) :
                                                echo showError('username');
                                            endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mx-auto p-0">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Password</label>
                                            <input class="form-control" type="password" name="password" value="<?php echo getValue('password'); ?>">
                                            <?php if (showError('password')) :
                                                echo showError('password');
                                            endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Confirm Password</label>
                                            <input class="form-control" type="password" name="confirmpassword" value="<?php echo getValue('confirmpassword'); ?>">
                                            <?php if (showError('confirmpassword')) :
                                                echo showError('confirmpassword');
                                            endif; ?>
                                        </div>
                                    </div>
                                    <input type="hidden" name="pages" value="<?php echo $_GET['pages'] ?>">
                                    <input type="hidden" name="users" value="<?php echo $_GET['users'] ?>">
                                </div>
                                <?php if ($users == 'students') : ?>
                                    <div class="row mx-auto p-0">
                                        <div class="col-md-6">
                                            <label>College</label>
                                            <select class="form-select" name="college" id="colleges">
                                                <?php $select = findAll('college');
                                                foreach ($select as $row) : ?>
                                                    <option value="<?= $row['college_id'] ?>"><?= $row['college_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Department Name</label>
                                                <select class="form-select" name="department" id="departments">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto p-0">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Course</label>
                                                <select class="form-select" name="courses" id="courses">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Year</label>
                                                <select class="form-select" name="year">
                                                    <?php $year = findAll('year');
                                                    foreach ($year as $row) :
                                                    ?>
                                                        <option value="<?= $row['year_id'] ?>"><?= $row['year_num'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Section</label>
                                                <select class="form-select" name="section">
                                                    <?php $section = findAll('section');
                                                    foreach ($section as $row) :
                                                    ?>
                                                        <option value="<?= $row['section_id'] ?>"><?= $row['section_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="row mx-auto p-0 mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" name="register" class="btn btn-primary btn-sm"><i class="fa fa-user-plus me-1 text-size"></i> Register</button>
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