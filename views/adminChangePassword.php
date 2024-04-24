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
                        <input type="hidden" name="Admin_ID" value="<?php echo $_SESSION['Admin_ID'] ?>">
                        <div class="row mx-auto">
                            <h5><i class="fa fa-lock"></i> Update your Password</h5>
                            <div class="form-group mt-2">
                                <label>Current Password</label>
                                <input class="form-control" name="currentpassword" value="<?php echo getValue('currentpassword') ?>" placeholder="Enter your current password">
                                <?php if (showError('currentpassword')) :
                                    echo showError('currentpassword');
                                endif; ?>
                            </div>
                            <div class="form-group mb-4">
                                <label>New Password</label>
                                <input class="form-control" name="newpassword" value="<?php echo getValue('newpassword') ?>" placeholder="Enter your new password">
                                <?php if (showError('newpassword')) :
                                    echo showError('newpassword');
                                endif; ?>
                            </div>
                            <div class="form-group mb-4">
                                <label>Confirm New Password</label>
                                <input class="form-control" name="confirmnewpassword" value="<?php echo getValue('confirmnewpassword') ?>" placeholder="Confirm your new password">
                                <?php if (showError('confirmnewpassword')) :
                                    echo showError('confirmnewpassword');
                                endif; ?>
                            </div>
                            <div class="form-group">
                                <div class="row mx-auto">
                                    <button class="btn btn-primary" type="submit" name="updatePassword"><i class="fa fa-edit"></i> Update</button>
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