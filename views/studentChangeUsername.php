<?php
require_once("./studentNavbar.php");
?>
<div class="container-fluid py-4 mb-5">
    <div class="row mx-auto">
        <div class="col-md-6 mx-auto">
            <div class="card mb-4 pb-5 px-4">
                <div class="card-header pb-0 d-flex mb-2 justify-content-between">
                </div>
                <div class="card-body">
                    <form method="post" action="../actions/manageProfilestudent.php">
                        <div class="row mx-auto">
                            <h5><i class="fa fa-user"></i> Update your Username</h5>
                            <div class="form-group mt-2">
                                <label>Username</label>
                                <input class="form-control" name="username" value="<?php echo $_SESSION['student_Username'] ?>" placeholder="Enter your new username">
                                <?php if (showError('username')) :
                                    echo showError('username');
                                endif; ?>
                            </div>
                            <input type="hidden" name="student_ID" value="<?php echo $_SESSION['student_ID'] ?>">
                            <div class="form-group">
                                <div class="row mx-auto">
                                    <button class="btn btn-primary" type="submit" name="updateUsername"><i class="fa fa-edit"></i> Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once("./footer.php"); ?>