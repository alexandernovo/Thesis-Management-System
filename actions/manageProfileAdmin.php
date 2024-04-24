<?php
require('../config/config.php');

//Update name
if (isset($_POST['updateName'])) :

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    $fields = [
        'firstname' => $firstname,
        'lastname' => $lastname,
    ];
    $validations = [
        'firstname' => [
            'required' => true,
        ],
        'lastname' => [
            'required' => true,
        ],
    ];

    $errors = validate($fields, $validations);
    if (empty($errors)) {
        $data = [
            'Admin_Fname' => $firstname,
            'Admin_Lname' => $lastname
        ];
        $update = update('admin', ['Admin_ID' => $_POST['admin_ID']], $data);
        if ($update) {
            removeValue();
            setSession($data);
            setFlash('success', 'Updated Successfully');
            redirect('Profile', ['pages' => 'Profile']);
        }
    }
    returnError($errors);
    redirect('adminChangeName', ['pages' => 'Change Name']);

endif;

//update Email
if (isset($_POST['updateEmail'])) :
    $email = $_POST['email'];

    $fields = [
        'email' => $email,
    ];

    $validations = [
        'email' => [
            'email' => true,
            'required' => true,
            'unique' => [
                [
                    'fieldName' => 'student_Email',
                    'tableName' => 'student'
                ],
                [
                    'fieldName' => 'Admin_Email',
                    'tableName' => 'admin'
                ],
                [
                    'fieldName' => 'teacher_Email',
                    'tableName' => 'teacher'
                ]
            ]
        ],
    ];
    $errors = validate($fields, $validations);
    if (empty($errors)) {
        $update = update('admin', ['Admin_ID' => $_POST['admin_ID']], ['Admin_Email' => $email]);
        if ($update) {
            removeValue();
            setSession(['Admin_Email' => $email]);
            setFlash('success', 'Updated Successfully');
            redirect('Profile', ['pages' => 'Profile']);
        }
    }
    returnError($errors);
    redirect('adminChangeEmail', ['pages' => 'Change Email']);

endif;

//Update Username
if (isset($_POST['updateUsername'])) :
    $username = $_POST['username'];

    $fields = [
        'username' => $username
    ];
    $validations = [
        'username' => [
            'required' => true,
            'unique' => [
                [
                    'fieldName' => 'student_Username',
                    'tableName' => 'student'
                ],
                [
                    'fieldName' => 'Admin_Username',
                    'tableName' => 'admin'
                ],
                [
                    'fieldName' => 'teacher_Username',
                    'tableName' => 'teacher'
                ]
            ]
        ],
    ];
    $errors = validate($fields, $validations);
    if (empty($errors)) {
        $update = update('admin', ['Admin_ID' => $_POST['admin_ID']], ['Admin_Username' => $username]);
        if ($update) {
            removeValue();
            setSession(['Admin_Username' => $username]);
            setFlash('success', 'Updated Successfully');
            redirect('Profile', ['pages' => 'Profile']);
        }
    }
    returnError($errors);
    redirect('adminChangeUsername', ['pages' => 'Change Username']);
endif;


if (isset($_POST['updatePassword'])) :

    $currentpassword = $_POST['currentpassword'];
    $newpassword = $_POST['newpassword'];
    $confirmnewpassword = $_POST['confirmnewpassword'];

    $check = first('admin', ['Admin_ID' => $_POST['Admin_ID']]);

    $fields = [
        'currentpassword' => $currentpassword,
        'newpassword' =>   $newpassword,
        'confirmnewpassword' =>  $confirmnewpassword,
    ];
    $validations = [
        'currentpassword' => [
            'required' => true,
        ],
        'newpassword' => [
            'required' => true,
        ],
        'confirmnewpassword' => [
            'required' => true,
            'match' => 'newpassword'
        ]
    ];
    $errors = validate($fields, $validations);
    if (empty($errors)) {
        if (password_verify($currentpassword, $check['Admin_Password'])) {
            $update = update('admin', ['Admin_ID' => $_POST['Admin_ID']], ['Admin_Password' => password_hash($newpassword, PASSWORD_DEFAULT)]);
            if ($update) {
                removeValue();
                setFlash('success', 'Updated Successfully');
                redirect('Profile', ['pages' => 'Profile']);
            }
        } else {
            retainValue();
            $errors['currentpassword'] = "Your current password is incorrect";
            returnError($errors);
            redirect('adminChangePassword');
        }
    } else {
        retainValue();
        returnError($errors);
        redirect('adminChangePassword');
    }

endif;
