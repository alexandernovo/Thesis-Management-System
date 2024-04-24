<?php
require_once("../config/authAdmin.php");
require_once("./adminNavbar.php");

$users = $_GET['users'];
if ($users == "students") {
    $student_id = $_GET['student_ID'];
    // $user = first('student', ['student_ID' => $student_id]);
    $user = firstJoin('student', [['course', 'course.course_id', 'student.course_id'], ['department', 'department.department_id', 'course.department_id'], ['college', 'college.college_id', 'department.college_id'], ['year', 'year.year_id', 'student.year_id'], ['section', 'section.section_id', 'student.section_id']], ['student_ID' => $student_id]);
} else if ($users == "admins") {
    $admin_id = $_GET['Admin_ID'];
    $user = first('admin', ['Admin_ID' => $admin_id]);
} else if ($users == "teacher") {
    $teacher_id = $_GET['teacher_ID'];
    $user = first('teacher', ['teacher_ID' => $teacher_id]);
}
?>
<div class="container-fluid py-4 mb-5">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 pb-5">
                <div class="card-header pb-0 d-flex mb- 3 justify-content-between mx-4">
                    <h6>Update <?php echo $users == "students" ? "Student" : ($users == "teacher" ? "Teacher" : ($users == "admins" ? "Admin" : "")); ?></h6>
                </div>
                <form method="post" action="../actions/updateUser.php">
                    <input type="hidden" name="users" value="<?php echo $users; ?>">
                    <input type="hidden" name="pages" value="<?php echo $pages; ?>">
                    <input type="hidden" name="user_ID" value="<?php echo $users == "students" ? $user['student_ID'] : ($users == "admins" ? $user['Admin_ID'] : ($users == "teacher" ? $user['teacher_ID'] : "")) ?>">

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="row mx-auto">
                            <div class="col-md-11 mx-auto p-0">
                                <div class="row mx-auto p-0">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Firstname</label>
                                            <input class="form-control" name="firstname" value="<?php echo $users == "students" ? $user['student_Fname'] : ($users == "admins" ? $user['Admin_Fname'] : ($users == "teacher" ? $user['teacher_Fname'] : "")) ?>">
                                            <?php if (showError('firstname')) :
                                                echo showError('firstname');
                                            endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Lastname</label>
                                            <input class="form-control" name="lastname" value="<?php echo $users == "students" ? $user['student_Lname'] : ($users == "admins" ? $user['Admin_Lname'] : ($users == "teacher" ? $user['teacher_Lname'] : "")) ?>">
                                            <?php if (showError('lastname')) :
                                                echo showError('lastname');
                                            endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($users == "teacher") : ?>
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
                                <?php endif; ?>
                                <?php if ($users == "students") : ?>
                                    <div class="row mx-auto p-0">
                                        <div class="col-md-6">
                                            <label>College</label>
                                            <select class="form-select" name="college" id="colleges">
                                                <?php $select = findAll('college');
                                                foreach ($select as $row) : ?>
                                                    <option <?php echo  $user['college_id'] == $row['college_id'] ? 'selected' : '' ?> value="<?= $row['college_id'] ?>"><?= $row['college_name'] ?></option>
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

                                <div class="row mx-auto p-0">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="emailCheck" value="1" id="emailCheck">
                                            <label class="form-check-label">
                                                Check to update email
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <input class="form-control" name="email" value="<?php echo $users == "students" ? $user['student_Email'] : ($users == "admins" ? $user['Admin_Email'] : ($users == "teacher" ? $user['teacher_Email'] : "")) ?>">
                                            <?php if (showError('email')) :
                                                echo showError('email');
                                            endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="usernameCheck" value="1" id="usernameCheck">
                                            <label class="form-check-label">
                                                Check to update username
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Username</label>
                                            <input class="form-control" name="username" value="<?php echo $users == "students" ? $user['student_Username'] : ($users == "admins" ? $user['Admin_Username'] : ($users == "teacher" ? $user['teacher_Username'] : "")) ?>">
                                            <?php if (showError('username')) :
                                                echo showError('username');
                                            endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mx-auto p-0">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="passwordCheck" value="1" id="passwordCheck">

                                            <label class="form-check-label">
                                                Check to update password
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mx-auto p-0">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Password</label>
                                            <input class="form-control" name="password" value="<?php echo getValue('password'); ?>">
                                            <?php if (showError('password')) :
                                                echo showError('password');
                                            endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Confirm Password</label>
                                            <input class="form-control" name="confirmpassword" value="<?php echo getValue('confirmpassword'); ?>">
                                            <?php if (showError('confirmpassword')) :
                                                echo showError('confirmpassword');
                                            endif; ?>
                                        </div>
                                    </div>
                                    <input type="hidden" name="pages" value="<?php echo $_GET['pages'] ?>">
                                    <input type="hidden" name="users" value="<?php echo $_GET['users'] ?>">
                                </div>
                                <?php if ($users == "teacher") : ?>
                                    <div class="row mx-auto p-0">
                                        <?php $specials = find_where('specialization', ['teacher_ID' => $teacher_id]);
                                        $no = 1;
                                        foreach ($specials as $special) :
                                        ?>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Specialization <?php echo $no;
                                                                            $no++ ?></label>
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-control" value="<?= $special['Specialization_name'] ?>" name="special[]">
                                                        <a class="text-decoration-none" style="cursor: pointer;" href="../actions/updateUser.php?deleteSpec&specialization_ID=<?= $special['Specialization_ID'] ?>&pages=<?php echo $_GET['pages'] ?>&users=<?php echo $users ?>&teacher_ID=<?php echo $teacher_id ?>"><i class="fa fa-trash ms-1 text-danger"></i></a>
                                                    </div>
                                                    <input type="hidden" name="special_id[]" value="<?= $special['Specialization_ID'] ?>">
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                <?php endif; ?>
                                <div class="row mx-auto p-0 mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <?php if ($users == "teacher") : ?>
                                                <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addSpec"><i class="fa fa-plus-circle text-size"></i> Specialization</button>
                                            <?php endif; ?>
                                            <button type="submit" name="update" class="btn btn-primary btn-sm"><i class="fa fa-user-edit me-1 text-size"></i> Update</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <?php if ($users == "teacher") : ?>
                    <div class="modal fade" id="addSpec" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Specialization</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="../actions/updateUser.php">
                                    <div class="modal-body">
                                        <input type="hidden" value="<?php echo $teacher_id ?>" name="teacher_id">
                                        <input type="hidden" name="users" value="<?php echo $users; ?>">
                                        <input type="hidden" name="pages" value="<?php echo $_GET['pages']; ?>">

                                        <div id="row-cloned">
                                            <div id="row-of-form" class="form-group">
                                                <label>Specialization</label>
                                                <div class="d-flex align-items-center">
                                                    <input class="form-control special me-1" id="special" name="special[]" placeholder="Specialization">
                                                    <i class="fa fa-times remove text-danger" style="display: none; cursor:pointer"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary me-2 btn-sm px-3" type="button" id="add"><i class="fa fa-plus-circle text-size"></i> Add</button>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="add_special" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php require_once("./footer.php"); ?>