<?php
require_once("../config/authAdmin.php");
require_once("./adminNavbar.php");
?>

<div class="container-fluid py-4 mb-5">
    <div class="row mx-auto">
        <div class="col-md-6 mx-auto">
            <div class="card mb-4 pb-5 px-4">
                <div class="card-header pb-0 d-flex mb-2 justify-content-between">
                </div>
                <div class="card-body">
                    <form method="post" action="../actions/manageProfileAdmin.php">
                        <div class="row mx-auto">
                            <h5><i class="fa fa-user"></i> Update your Email</h5>
                            <div class="form-group mt-2">
                                <label>Email</label>
                                <input class="form-control" placeholder="Enter your new email" name="email" value="<?php echo $_SESSION['Admin_Email'] ?>">
                                <?php if (showError('email')) :
                                    echo showError('email');
                                endif; ?>
                            </div>
                            <input type="hidden" name="admin_ID" value="<?php echo $_SESSION['Admin_ID'] ?>">
                            <div class="form-group">
                                <div class="row mx-auto">
                                    <button class="btn btn-primary" type="submit" name="updateEmail"><i class="fa fa-edit"></i> Update</button>
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