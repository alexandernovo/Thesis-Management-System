<?php
require_once("../config/authAdmin.php");
require_once("./adminNavbar.php");
?>
<?php
if (isset($_GET['users'])) {
    $users = $_GET['users'];
} else {
    $users = "students";
}
?>
<div class="container-fluid py-4 mb-5">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex mb-3 justify-content-between mx-4">
                    <h6><?php echo $users == "students" ? "Student" : ($users == "teacher" ? "Teacher" : ($users == "admins" ? "Admin" : "")) ?>'s Table</h6>
                    <a href="<?php echo ($users === 'teacher') ? 'adminRegisterTeacher.php?pages=Register%20User&users=' . $users : 'adminRegisterUser.php?pages=Register%20User&users=' . $users ?>" class="btn btn-primary btn-sm d-flex align-items-center"><i class="fa fa-plus-circle me-1 text-size"></i> Register User</a>

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0 px-3 pb-3">
                        <table class="table align-items-center mb-0" id="example">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Users</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>
                                    <?php if ($users == "students") : ?>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">College</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Department</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Course</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Year</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Section</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <?php endif; ?>
                                    <?php if ($users == "teacher") : ?>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Department</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Specialization</th>
                                    <?php endif; ?>

                                    <th class="text-secondary opacity-7"></th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $user = $users == "students" ? "student" : ($users == "admins" ? "admin" : ($users == "teacher" ? "teacher" : ""));
                                if ($user == "teacher") {
                                    $users_query = joinTable('teacher', [['department', 'department.department_id', 'teacher.department_id']]);
                                } else if ($user == "student") {
                                    $users_query = joinTable('student', [['course', 'course.course_id', 'student.course_id'], ['department', 'department.department_id', 'course.department_id'], ['college', 'college.college_id', 'department.college_id'], ['year', 'year.year_id', 'student.year_id'], ['section', 'section.section_id', 'student.section_id']]);
                                } else if ($user = "admins") {
                                    $users_query = findAll('admin');
                                }
                                foreach ($users_query as $row) :
                                    if ($users == "students") :
                                ?>
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
                                                <p class="text-xs ms-3 font-weight-bold mb-0"><?= $row['student_Username'] ?></p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0"><?php echo "Student" ?></p>
                                            </td>

                                            <td class="align-middle text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    <?= $row['college_name'] ?>
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    <?= $row['department_name'] ?>
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    <?= $row['course_name'] ?>
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    <?= $row['year_num'] ?>
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    <?= $row['section_name'] ?>
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $row['student_Status'] == 1 ? "Activated" : ($row['student_Status'] == 0 ? "Deactivated" : "") ?></span>
                                            </td>


                                            <td class="align-middle">
                                                <a href="./adminUpdateUser.php?pages=Update Users&users=<?php echo $users ?>&student_ID=<?= $row['student_ID'] ?>" class="text-secondary font-weight-bold text-xs edit-link">
                                                    <i class="fa fa-edit text-success edit"></i>
                                                    <p class="text">Edit</p>
                                                </a>

                                            </td>
                                            <td class="align-middle">
                                                <a href="../actions/Deactivation.php?deactivateStudent&student_ID=<?= $row['student_ID'] ?>&pages=<?php echo $_GET['pages'] ?>&users=<?php echo $_GET['users'] ?>&status=<?= $row['student_Status'] ?>" class="<?php echo $row['student_Status'] == 0 ? "text-success" : "text-danger"; ?> font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                    <?php echo $row['student_Status'] == 0 ? "Activate" : "Deactivate" ?>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endif; ?>

                                    <?php
                                    if ($users == "admins") : ?>

                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="<?php echo !empty($row['Admin_Profile']) ? $row['Admin_Profile'] : "../public/assets/img/default.png" ?>" class="avatar avatar-sm me-3" alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm"><?= $row['Admin_Fname'] . ' ' . $row['Admin_Lname'] ?></h6>
                                                        <p class="text-xs text-secondary mb-0"><?= $row['Admin_Email'] ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <p class="text-xs ms-3 font-weight-bold mb-0"><?= $row['Admin_Username'] ?></p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0"><?php echo "Admin" ?></p>
                                            </td>
                                            <td class="align-middle">
                                                <a href="./adminUpdateUser.php?pages=Update Users&users=<?php echo $users ?>&Admin_ID=<?= $row['Admin_ID'] ?>" class="text-secondary font-weight-bold text-xs edit-link">
                                                    <i class="fa fa-edit text-success edit"></i>
                                                    <p class="text">Edit</p>
                                                </a>
                                            </td>
                                            <td></td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php
                                    if ($users == "teacher") : ?>
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
                                            <td class="align-middle">
                                                <p class="text-xs ms-3 font-weight-bold mb-0"><?= $row['teacher_Username'] ?></p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0"><?php echo "teacher" ?></p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 text-center"><?= $row['department_name'] ?></p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $row['teacher_Status'] == 1 ? "Activated" : ($row['teacher_Status'] == 0 ? "Deactivated" : "") ?></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a class="text-secondary font-weight-bold text-xs" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#special<?= $row['teacher_ID'] ?>">
                                                    View
                                                </a>
                                            </td>
                                            <!-- Modal -->
                                            <div class="modal fade" id="special<?= $row['teacher_ID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Specialization</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php $special = find_where('specialization', ['teacher_ID' => $row['teacher_ID']]);
                                                            $no = 1;
                                                            foreach ($special as $specials) :
                                                            ?>
                                                                <div class="form-group">
                                                                    <label>Specialization <?php echo $no;
                                                                                            $no++; ?></label>
                                                                    <input class="form-control" value=" <?= $specials['Specialization_name'] ?>" readonly>
                                                                </div>
                                                            <?php endforeach; ?>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <td class="align-middle">
                                                <a href="./adminUpdateUser.php?pages=Update Users&users=<?php echo $users ?>&teacher_ID=<?= $row['teacher_ID'] ?>" class="text-secondary font-weight-bold text-xs edit-link">
                                                    <i class="fa fa-edit text-success edit"></i>
                                                    <p class="text">Edit</p>
                                                </a>
                                            </td>
                                            <td class="align-middle">
                                                <a href="../actions/Deactivation.php?deactivateTeacher&teacher_ID=<?= $row['teacher_ID'] ?>&pages=<?php echo $_GET['pages'] ?>&users=<?php echo $_GET['users'] ?>&status=<?= $row['teacher_Status'] ?>" class="<?php echo $row['teacher_Status'] == 0 ? "text-success" : "text-danger" ?> font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                    <?php echo $row['teacher_Status'] == 0 ? "Activate" : "Deactivate" ?>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endif; ?>

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