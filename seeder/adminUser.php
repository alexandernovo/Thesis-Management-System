<?php require_once "../config/config.php";

//localhost/Research Management System/seeder/adminUser.php?run=go

if (isset($_GET['run']) == "go") :
    $admin = [
        "Admin_Fname"   => "Mark",
        "Admin_Lname"   => "Zuckerberg",
        "Admin_Username"   => "Admin",
        "Admin_Password"   => password_hash("Admin", PASSWORD_DEFAULT),
        "Admin_Email"   => "admin@gmail.com"
    ];
    save("admin", $admin);
endif;
