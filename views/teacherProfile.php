<?php
require_once("./teacherNavbar.php");
?>
<div class="container-fluid py-4 mb-5">
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card mb-4 pb-5 px-4">
                <div class="card-header pb-0 d-flex mb-2 justify-content-between">
                </div>
                <div class="card-body">
                    <div class="row mx-auto">
                        <div class="col-md-2 position-relative">
                            <img class="img-fluid rounded-circle h-100 border" src="<?php echo !empty($_SESSION['teacher_Profile']) ? $_SESSION['teacher_Profile'] : "../public/assets/img/default.png" ?>">
                            <i class="fa fa-camera rounded-circle border p-2 camera-icon" data-bs-toggle="modal" data-bs-target="#profile"></i>
                        </div>
                        <div class="px-0">
                            <div class="col-md-2 position-relative">
                                <h6 class="text-center"><?php echo $_SESSION['teacher_Fname'] . ' ' . $_SESSION['teacher_Lname'] ?></h6>
                                <p class="sub-text text-center m-0 mb-4"><?php echo $_SESSION['teacher_Email'] ?></p>
                            </div>
                        </div>
                        <form method="post" action="../actions/updateProfile.php">
                            <div class="row mx-auto">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Firstname</label>
                                        <input class="form-control" value="<?php echo $_SESSION['teacher_Fname'] ?>" name="fname">
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input class="form-control" value="<?php echo $_SESSION['teacher_Username'] ?>" name="username">
                                    </div>
                                    <div class="form-group">
                                        <label>College</label>
                                        <select class="form-select" name="college" id="colleges">
                                            <?php
                                            $college = first('department', ['department_id' => $_SESSION['department_id']]);
                                            $select = findAll('college');
                                            foreach ($select as $row) : ?>
                                                <option <?php echo $row['college_id'] == $college['college_id'] ? 'selected' : '' ?> value="<?= $row['college_id'] ?>"><?= $row['college_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Password <i>(Leave Blank if do not want to update password)</i></label>
                                        <input class="form-control" placeholder="Password" name="password">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" name="updateTeacher" type="submit"><i class="fa fa-edit"></i> Update Profile</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Lastname</label>
                                        <input class="form-control" value="<?php echo $_SESSION['teacher_Lname'] ?>" name="lname">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" value="<?php echo $_SESSION['teacher_Email'] ?>" name="email">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Department Name</label>
                                            <select class="form-select" name="department" id="departments">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../actions/updateUser.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="teacher_ID" value="<?php echo $_SESSION['teacher_ID'] ?>">
                <div class="modal-body">
                    <div class="profile-circle mx-auto border my-3" id="image-container">
                        <img id="preview-image" src="<?php echo !empty($_SESSION['teacher_Profile']) ? $_SESSION['teacher_Profile'] : "../public/assets/img/default.png" ?>" alt="Preview Image">
                    </div>
                    <div class="col-md-8 mx-auto">
                        <div class="form-group">
                            <input type="file" id="image-upload" name="profile" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button type="submit" class="btn btn-primary" name="updatePictureTeacher"><i class="fa fa-upload"></i> Upload Photo</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once("./footer.php"); ?>