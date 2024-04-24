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
                    <div class="row mx-auto">
                        <h5><i class="fa fa-user"></i> Update your Name</h5>
                        <form method="post" action="../actions/manageProfilestudent.php">
                            <div class="form-group mt-2">
                                <label>Firstname</label>
                                <input class="form-control" name="firstname" value="<?php echo $_SESSION['student_Fname'] ?>" placeholder="Enter your new firstname">
                                <?php if (showError('firstname')) :
                                    echo showError('firstname');
                                endif; ?>
                            </div>
                            <div class="form-group mb-4">
                                <label>Lastname</label>
                                <input class="form-control" name="lastname" value="<?php echo $_SESSION['student_Lname'] ?>" placeholder="Enter your new lastname">
                                <?php if (showError('lastname')) :
                                    echo showError('lastname');
                                endif; ?>
                            </div>
                            <input type="hidden" name="student_ID" value="<?php echo $_SESSION['student_ID'] ?>">
                            <div class="form-group">
                                <div class="row mx-auto">
                                    <button class="btn btn-primary" name="updateName"><i class="fa fa-edit"></i> Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once("./footer.php"); ?>