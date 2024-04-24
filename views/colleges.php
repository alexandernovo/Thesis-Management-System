<?php
require_once("../config/authAdmin.php");
require_once("./adminNavbar.php"); ?>
<div class="container-fluid py-4 mb-5">
    <div class="row">
        <div class="col-6">
            <div class="card mb-4 pb-5">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Manage Colleges</h6>
                    <button class="btn btn-primary btn-sm mb-0 d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addCollege"><i class="fa fa-plus-circle me-1 text-size"></i> Add College</button>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0 px-3 pb-3 mt-3">
                        <table class="table align-items-center mb-0" id="example">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Colleges</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $colleges = findAll('college');
                                foreach ($colleges as $row) :
                                ?>
                                    <tr>
                                        <td class="align-middle">
                                            <p class="text-xs ms-3 font-weight-bold mb-0 "><?= $row['college_name'] ?></p>
                                        </td>
                                        <td>
                                            <a class="text-secondary font-weight-bold text-xs cursor-pointer edit-link" data-bs-toggle="modal" data-bs-target="#editcollege<?= $row['college_id'] ?>">
                                                <i class="fa fa-edit text-success edit"></i>
                                                <p class="text">Edit</p>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="../actions/manageCollegesDepartments.php?activationCollege&status=<?= $row['college_status'] ?>&college_id=<?= $row['college_id'] ?>" class="<?php echo $row['college_status'] == 1 ? 'text-danger' : 'text-success' ?> font-weight-bold text-xs ">
                                                <?php echo $row['college_status'] == 1 ? 'Deactivate' : 'Activate' ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- College Edit Modal -->
                                    <div class="modal fade" id="editcollege<?= $row['college_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa fa-edit"></i> Update College</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="post" action="../actions/manageCollegesDepartments.php">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>College</label>
                                                            <input class="form-control" required name="college" value="<?= $row['college_name'] ?>" placeholder="College">
                                                            <input type="hidden" name="college_id" value="<?= $row['college_id'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" name="updatecollege" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- College Edit Modal end-->
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card mb-4 pb-5">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Manage Departments</h6>
                    <button class="btn btn-primary btn-sm mb-0 d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addDepartment"><i class="fa fa-plus-circle me-1 text-size"></i> Add Department</button>

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0 px-3 pb-3 mt-3">
                        <table class="table align-items-center mb-0" id="example1">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Departments</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">College of:</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $department = joinTable('college', [['department', 'department.college_id', 'college.college_id']]);
                                foreach ($department as $row) :
                                ?>
                                    <tr>
                                        <td class="align-middle">
                                            <p class="text-xs ms-3 font-weight-bold mb-0"><?= $row['department_name'] ?></p>
                                        </td>
                                        <td class="align-middle">
                                            <p class="text-xs ms-3 font-weight-bold mb-0"><?= $row['college_name'] ?></p>

                                        </td>
                                        <td>
                                            <a class="text-secondary font-weight-bold text-xs cursor-pointer edit-link" data-bs-toggle="modal" data-bs-target="#editdepartment<?= $row['department_id'] ?>">
                                                <i class="fa fa-edit text-success edit"></i>
                                                <p class="text">Edit</p>
                                            </a>

                                        </td>
                                        <td>
                                            <a href="../actions/manageCollegesDepartments.php?activationDepartment&status=<?= $row['department_status'] ?>&department_id=<?= $row['department_id'] ?>" class="<?php echo $row['department_status'] == 1 ? 'text-danger' : 'text-success' ?> font-weight-bold text-xs">
                                                <?php echo $row['department_status'] == 1 ? 'Deactivate' : 'Activate' ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- Department Edit Modal -->
                                    <div class="modal fade" id="editdepartment<?= $row['department_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa fa-edit"></i> Update Department</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="post" action="../actions/manageCollegesDepartments.php">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>College</label>
                                                            <select class="form-select" name="college">
                                                                <?php $select = findAll('college');
                                                                foreach ($select as $row2) : ?>
                                                                    <option <?php $row2['college_id'] == $row['college_id'] ? "selected" : "" ?>value="<?= $row['college_id'] ?>"><?= $row['college_name'] ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <input type="hidden" name="department_id" value="<?= $row['department_id'] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Department Name</label>
                                                            <input class="form-control" value="<?= $row['department_name'] ?>" placeholder="Department name" name="department" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" name="updatedepartment" class="btn btn-primary">Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Department Edit Modal end-->
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card mb-4 pb-5">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Manage Courses</h6>
                    <button class="btn btn-primary btn-sm mb-0 d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addCourse"><i class="fa fa-plus-circle me-1 text-size"></i> Add Course</button>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0 px-3 pb-3 mt-3">
                        <table class="table align-items-center mb-0" id="example2">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Courses</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Department of</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">College of</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $course = joinTable('course', [['department', 'course.department_id', 'department.department_id'], ['college', 'college.college_id', 'department.college_id']]);
                                foreach ($course as $row) :
                                ?>
                                    <tr>
                                        <td class="align-middle">
                                            <p class="text-xs ms-3 font-weight-bold mb-0"><?= $row['course_name'] ?></p>
                                        </td>
                                        <td class="align-middle">
                                            <p class="text-xs ms-3 font-weight-bold mb-0"><?= $row['department_name'] ?></p>
                                        </td>
                                        <td class="align-middle">
                                            <p class="text-xs ms-3 font-weight-bold mb-0"><?= $row['college_name'] ?></p>
                                        </td>
                                        <td>
                                            <a class="text-secondary font-weight-bold text-xs cursor-pointer edit-link" data-bs-toggle="modal" data-bs-target="#editCourse<?= $row['course_id'] ?>">
                                                <i class="fa fa-edit text-success edit"></i>
                                                <p class="text">Edit</p>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="../actions/manageCollegesDepartments.php?activationCourse&status=<?= $row['course_status'] ?>&course_id=<?= $row['course_id'] ?>" class="<?php echo $row['course_status'] == 1 ? 'text-danger' : 'text-success' ?> font-weight-bold text-xs">
                                                <?php echo $row['course_status'] == 1 ? 'Deactivate' : 'Activate' ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editCourse<?= $row['course_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa fa-plus-circle"></i> Update Course</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="post" action="../actions/manageCollegesDepartments.php">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>College</label>
                                                            <input type="hidden" name="course_id" value="<?= $row['course_id'] ?>">
                                                            <select class="form-select college" name="college" id="colleges<?= $row['course_id'] ?>" course-id="<?= $row['course_id'] ?>">
                                                                <?php $select = findAll('college');
                                                                foreach ($select as $course) : ?>
                                                                    <option <?php echo $row['college_id'] == $course['college_id'] ? 'selected' : '' ?> value="<?= $course['college_id'] ?>"><?= $course['college_name'] ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Department Name</label>
                                                            <select class="form-select" name="department" id="departments<?= $row['course_id'] ?>">
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Course</label>
                                                            <input class="form-control" name="course" value="<?= $row['course_name'] ?>" placeholder="Course" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" name="updatecourse" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
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
        <div class="col-6">
            <div class="card mb-4 pb-5">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Manage Year</h6>
                    <button class="btn btn-primary btn-sm mb-0 d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addYear"><i class="fa fa-plus-circle me-1 text-size"></i> Add Year</button>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0 px-3 pb-3 mt-3">
                        <table class="table align-items-center mb-0" id="example3">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Year</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $year = findAll('year');
                                $no = 1;
                                foreach ($year as $row) :
                                ?>
                                    <tr>
                                        <td class="align-middle">
                                            <p class="text-xs ms-3 font-weight-bold mb-0"><?php echo $no;
                                                                                            $no++ ?></p>
                                        </td>
                                        <td class="align-middle">
                                            <p class="text-xs ms-3 font-weight-bold mb-0"><?= $row['year_num'] ?></p>
                                        </td>
                                        <td>
                                            <a class="text-secondary font-weight-bold text-xs cursor-pointer edit-link" data-bs-toggle="modal" data-bs-target="#edityear<?= $row['year_id'] ?>">
                                                <i class="fa fa-edit text-success edit"></i>
                                                <p class="text">Edit</p>
                                            </a>

                                        </td>
                                        <td>
                                            <a href="../actions/manageCollegesDepartments.php?activationYear&status=<?= $row['year_status'] ?>&year_id=<?= $row['year_id'] ?>" class="<?php echo $row['year_status'] == 1 ? 'text-danger' : 'text-success' ?> font-weight-bold text-xs">
                                                <?php echo $row['year_status'] == 1 ? 'Deactivate' : 'Activate' ?>
                                            </a>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="edityear<?= $row['year_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Year</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="post" action="../actions/manageCollegesDepartments.php">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Year</label>
                                                            <input class="form-control" name="year" value="<?= $row['year_num'] ?>" placeholder="Year">
                                                            <input type="hidden" value="<?= $row['year_id'] ?>" name="year_id">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" name="edityear" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
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
        <div class="row">
            <div class="col-6">
                <div class="card mb-4 pb-5">
                    <div class="card-header pb-0 d-flex justify-content-between">
                        <h6>Manage Section</h6>
                        <button class="btn btn-primary btn-sm mb-0 d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addSection"><i class="fa fa-plus-circle me-1 text-size"></i> Add Section</button>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0 px-3 pb-3 mt-3">
                            <table class="table align-items-center mb-0" id="example4">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Section</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $section = findAll('section');
                                    $no = 1;
                                    foreach ($section as $row) :
                                    ?>
                                        <tr>
                                            <td class="align-middle">
                                                <p class="text-xs ms-3 font-weight-bold mb-0"><?php echo $no;
                                                                                                $no++ ?></p>
                                            </td>
                                            <td class="align-middle">
                                                <p class="text-xs ms-3 font-weight-bold mb-0"><?= $row['section_name'] ?></p>
                                            </td>
                                            <td>
                                                <a class="text-secondary font-weight-bold text-xs cursor-pointer edit-link" data-bs-toggle="modal" data-bs-target="#editSection<?= $row['section_id'] ?>">
                                                    <i class="fa fa-edit text-success edit"></i>
                                                    <p class="text">Edit</p>
                                                </a>

                                            </td>
                                            <td>
                                                <a href="../actions/manageCollegesDepartments.php?activationSection&status=<?= $row['section_status'] ?>&section_id=<?= $row['section_id'] ?>" class="<?php echo $row['section_status'] == 1 ? 'text-danger' : 'text-success' ?> font-weight-bold text-xs">
                                                    <?php echo $row['section_status'] == 1 ? 'Deactivate' : 'Activate' ?>
                                                </a>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="editSection<?= $row['section_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Section</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" action="../actions/manageCollegesDepartments.php">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Year</label>
                                                                <input class="form-control" name="section" value="<?= $row['section_name'] ?>" placeholder="Year">
                                                                <input type="hidden" value="<?= $row['section_id'] ?>" name="section_id">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="editSection" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
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

    <!-- College Add Modal -->
    <div class="modal fade" id="addCollege" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa fa-plus-circle"></i> Add College</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="../actions/manageCollegesDepartments.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>College</label>
                            <input class="form-control" name="college" placeholder="College" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="addcollege" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Department Add Modal -->
    <div class="modal fade" id="addDepartment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa fa-plus-circle"></i> Add Department</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="../actions/manageCollegesDepartments.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>College</label>
                            <select class="form-select" name="college">
                                <?php $select = findAll('college');
                                foreach ($select as $row) : ?>
                                    <option value="<?= $row['college_id'] ?>"><?= $row['college_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Department Name</label>
                            <input class="form-control" placeholder="Department name" name="department" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="adddepartment" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Course Add Modal -->
    <div class="modal fade" id="addCourse" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa fa-plus-circle"></i> Add Course</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="../actions/manageCollegesDepartments.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>College</label>
                            <select class="form-select" name="college" id="colleges">
                                <?php $select = findAll('college');
                                foreach ($select as $row) : ?>
                                    <option value="<?= $row['college_id'] ?>"><?= $row['college_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Department Name</label>
                            <select class="form-select" name="department" id="departments">
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Course</label>
                            <input class="form-control" name="courses">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="addcourse" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Year Add Modal -->
    <div class="modal fade" id="addYear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa fa-plus-circle"></i> Add Year</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="../actions/manageCollegesDepartments.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Year</label>
                            <input class="form-control" name="year" placeholder="Year" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="addyear" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addSection" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa fa-plus-circle"></i> Add Section</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="../actions/manageCollegesDepartments.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Section</label>
                            <input class="form-control" name="section" placeholder="Section" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="addsection" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php require_once("./footer.php"); ?>