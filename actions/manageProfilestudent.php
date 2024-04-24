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
            'student_Fname' => $firstname,
            'student_Lname' => $lastname
        ];
        $update = update('student', ['student_ID' => $_POST['student_ID']], $data);
        if ($update) {
            removeValue();
            setSession($data);
            setFlash('success', 'Updated Successfully');
            redirect('studentProfile', ['pages' => 'Profile']);
        }
    }
    returnError($errors);
    redirect('studentChangeName', ['pages' => 'Change Name']);

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
        $update = update('student', ['student_ID' => $_POST['student_ID']], ['student_Email' => $email]);
        if ($update) {
            removeValue();
            setSession(['student_Email' => $email]);
            setFlash('success', 'Updated Successfully');
            redirect('studentProfile', ['pages' => 'Profile']);
        }
    }
    returnError($errors);
    redirect('studentChangeEmail', ['pages' => 'Change Email']);

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
        $update = update('student', ['student_ID' => $_POST['student_ID']], ['student_Username' => $username]);
        if ($update) {
            removeValue();
            setSession(['student_Username' => $username]);
            setFlash('success', 'Updated Successfully');
            redirect('studentProfile', ['pages' => 'Profile']);
        }
    }
    returnError($errors);
    redirect('studentChangeUsername', ['pages' => 'Change Username']);
endif;


if (isset($_POST['updatePassword'])) :

    $currentpassword = $_POST['currentpassword'];
    $newpassword = $_POST['newpassword'];
    $confirmnewpassword = $_POST['confirmnewpassword'];

    $check = first('student', ['student_ID' => $_POST['student_ID']]);

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
        if (password_verify($currentpassword, $check['student_Password'])) {
            $update = update('student', ['student_ID' => $_POST['student_ID']], ['student_Password' => password_hash($newpassword, PASSWORD_DEFAULT)]);
            if ($update) {
                removeValue();
                setFlash('success', 'Updated Successfully');
                redirect('studentProfile', ['pages' => 'Profile']);
            }
        } else {
            retainValue();
            $errors['currentpassword'] = "Your current password is incorrect";
            returnError($errors);
            redirect('studentChangePassword', ['pages' => "Change Password"]);
        }
    } else {
        retainValue();
        returnError($errors);
        redirect('studentChangePassword', ['pages' => "Change Password"]);
    }

endif;
