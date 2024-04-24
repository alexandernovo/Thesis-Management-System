<?php
require_once "../config/config.php";

if (isset($_POST['register'])) :
    if (isset($_POST['users'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') :

            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirmpassword = $_POST['confirmpassword'];
            $users = $_POST['users'];

            $links =
                [
                    'pages' => $_POST['pages'],
                    'users' => $users
                ];

            $fields = [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'username' => $username,
                'password' => $password,
                'confirmpassword' => $confirmpassword,
            ];
            $validations = [
                'firstname' => [
                    'required' => true,
                ],
                'lastname' => [
                    'required' => true,
                ],
                'email' => [
                    'required' => true,
                    'email' => true,
                    'unique' => [
                        [
                            'fieldName' => 'student_Email',
                            'tableName' => 'student'
                        ],
                        [
                            'fieldName' => 'Admin_Email',
                            'tableName' => 'admin'
                        ]
                    ]
                ],
                'username' => [
                    'required' => true,
                    'unique' => [
                        [
                            'fieldName' => 'student_Email',
                            'tableName' => 'student'
                        ],
                        [
                            'fieldName' => 'Admin_Email',
                            'tableName' => 'admin'
                        ]
                    ]
                ],
                'password' => [
                    'required' => true,
                    'min_length' => 8,
                    'max_length' => 100
                ],
                'confirmpassword' => [
                    'required' => true,
                    'match' => 'password'
                ]
            ];

            $errors = validate($fields, $validations);
            if (empty($errors)) {
                if ($users == "students") {
                    $data = [
                        'Admin_ID'          => $_SESSION['Admin_ID'],
                        'student_Fname'     => $firstname,
                        'student_Lname'     => $lastname,
                        'student_Username'  => $username,
                        'student_Email'     => $email,
                        'student_Password'  => password_hash($password, PASSWORD_DEFAULT),
                        'student_Status'    => 1,
                        'student_RegisteredDate' => date("Y-m-d H:i:s"),
                        'student_Profile'   => null,
                        'year_id'           => $_POST['year'],
                        'course_id'         => $_POST['courses'],
                        'section_id'           => $_POST['section']
                    ];
                    $save = save('student', $data);
                    if ($save) {
                        removeValue();
                        setFlash('success', 'Register Successfully');
                        redirect('adminRegisterUser', $links);
                    }
                }
                if ($users == "admins") {
                    $data = [
                        'Admin_Fname' => $firstname,
                        'Admin_Lname' => $lastname,
                        'Admin_Username' => $username,
                        'Admin_Email' => $email,
                        'Admin_Password' => password_hash($password, PASSWORD_DEFAULT),
                        'Admin_Profile' => null
                    ];
                    $save = save('admin', $data);
                    if ($save) {
                        removeValue();
                        setFlash('success', 'Register Successfully');
                        redirect('adminRegisterUser', $links);
                    }
                }
            } else {
                retainValue();
                returnError($errors);
                redirect('adminRegisterUser', $links);
            }

        endif;
    } else {
        redirect('adminDashboard');
    }
endif;
