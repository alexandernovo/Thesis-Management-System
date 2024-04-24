<?php
require_once("../config/config.php");
require_once('../config/noauth.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <title>Login</title>
</head>

<body>
    <div class="col-md-7 m-auto mt-5 border shadow bg-light border-login">
        <div class="row m-auto g-0 ">
            <div class="col-md-6 border-login-start">
                <img src="../public/assets/img/background.jpg" alt="" class="img-fluid border-login-start background-jpg" />
            </div>
            <div class="col-md-6 pt-5 border-login-end">
                <div class="row m-auto mt-5">
                    <div class="row m-auto mt-5">
                        <div class="col-md-4 m-auto mb-2">
                            <img class="img-fluid" src="../public/assets/img/isatlogo.png" />
                        </div>
                    </div>
                    <h4 class="h5 text-center mt-1 mb-3">Sign in to your Account</h4>
                    <div class="row m-auto px-5">
                        <form action="../actions/loginAuth.php" method="post">
                            <div class="form-group mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-user position-absolute ms-3 border-end pe-1"></i>
                                    <input type="text" class="form-control border-radius text-indent" value="<?php echo getValue('username'); ?>" name="username" placeholder="Enter your username" />
                                </div>
                                <?php if (showError('username')) :
                                    echo showError('username');
                                endif; ?>
                            </div>
                            <div class="form-group mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-lock position-absolute ms-3 border-end pe-1"></i>
                                    <input type="password" name="password" class="form-control border-radius text-indent" placeholder="Enter your password" />
                                </div>
                                <?php if (showError('password')) :
                                    echo showError('password');
                                endif; ?>
                            </div>
                            <div class="form-group">
                                <div class="row m-auto">
                                    <button class="btn btn-primary border-radius" name="signin">Sign in</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>