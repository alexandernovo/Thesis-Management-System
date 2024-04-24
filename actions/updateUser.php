<?php
require_once "../config/config.php";

if (isset($_POST['update'])) :
    if ($_SERVER['REQUEST_METHOD'] === 'POST') :

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];
        $users = $_POST['users'];
        if ($users == "teacher") {
            $department = $_POST['department'];
        }
        if (isset($_POST['emailCheck'])) {
            $emailCheck = $_POST['emailCheck'];
        } else {
            $emailCheck = 0;
        }
        if (isset($_POST['passwordCheck'])) {
            $passwordCheck = $_POST['passwordCheck'];
        } else {
            $passwordCheck = 0;
        }
        if (isset($_POST['usernameCheck'])) {
            $usernameCheck = $_POST['usernameCheck'];
        } else {
            $usernameCheck = 0;
        }

        $user_ID = $_POST['user_ID'];

        $fields = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'confirmpassword' => $confirmpassword,
        ];

        if ($emailCheck == 1 && $passwordCheck == 1 && $usernameCheck == 1) {
            echo "1 1 1";
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
                        ],
                        [
                            'fieldName' => 'teacher_Email',
                            'tableName' => 'teacher'
                        ]
                    ]
                ],
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
                        ]
                    ],
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
            if ($users == "students") {
                $data = [
                    'student_Fname' => $firstname,
                    'student_Lname' => $lastname,
                    'student_Username' => $username,
                    'student_Password' => password_hash($password, PASSWORD_DEFAULT),
                    'student_Email' => $email,
                    'year_id'       => $_POST['year'],
                    'course_id'     => $_POST['courses'],
                    'section_id'    => $_POST['section']
                ];
            } else if ($users == "admins") {
                $data = [
                    'Admin_Fname' => $firstname,
                    'Admin_Lname' => $lastname,
                    'Admin_Username' => $username,
                    'Admin_Password' => password_hash($password, PASSWORD_DEFAULT),
                    'Admin_Email' => $email,
                ];
            } else if ($users == "teacher") {
                $data = [
                    'teacher_Fname'     => $firstname,
                    'teacher_Lname'     => $lastname,
                    'department_id'     => $department,
                    'teacher_Username'  => $username,
                    'teacher_Password'  => password_hash($password, PASSWORD_DEFAULT),
                    'teacher_Email'     => $email,
                ];
            }
        } else if ($emailCheck == 1 && $passwordCheck == 1 && $usernameCheck == 0) {
            echo "1 1 0";

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
                    ],

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
            if ($users == "students") {
                $data = [
                    'student_Fname' => $firstname,
                    'student_Lname' => $lastname,
                    'student_Password' => password_hash($password, PASSWORD_DEFAULT),
                    'student_Email' => $email,
                    'year_id'       => $_POST['year'],
                    'course_id'     => $_POST['courses'],
                    'section_id'    => $_POST['section']
                ];
            } else if ($users == "admins") {
                $data = [
                    'Admin_Fname' => $firstname,
                    'Admin_Lname' => $lastname,
                    'Admin_Password' => password_hash($password, PASSWORD_DEFAULT),
                    'Admin_Email' => $email,
                ];
            } else if ($users == "teacher") {
                $data = [
                    'teacher_Fname' => $firstname,
                    'teacher_Lname' => $lastname,
                    'department_id'     => $department,
                    'teacher_Password' => password_hash($password, PASSWORD_DEFAULT),
                    'teacher_Email' => $email,
                ];
            }
        } else if ($emailCheck == 1 && $passwordCheck == 0 && $usernameCheck == 1) {
            // echo "1 0 1";
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
                    ],

                ],
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
                        ]
                    ],
                ],

            ];
            if ($users == "students") {
                $data = [
                    'student_Fname' => $firstname,
                    'student_Lname' => $lastname,
                    'student_Username' => $username,
                    'student_Email' => $email,
                    'year_id'       => $_POST['year'],
                    'course_id'     => $_POST['courses'],
                    'section_id'    => $_POST['section']
                ];
            } else if ($users == "admins") {
                $data = [
                    'Admin_Fname' => $firstname,
                    'Admin_Lname' => $lastname,
                    'Admin_Username' => $username,
                    'Admin_Email' => $email,
                ];
            } else if ($users == "teacher") {
                $data = [
                    'teacher_Fname' => $firstname,
                    'teacher_Lname' => $lastname,
                    'department_id'     => $department,
                    'teacher_Username' => $username,
                    'teacher_Email' => $email,
                ];
            }
        } else if ($emailCheck == 0 && $passwordCheck == 1 && $usernameCheck == 1) {
            echo "0 1 1";

            $validations = [
                'firstname' => [
                    'required' => true,
                ],
                'lastname' => [
                    'required' => true,
                ],
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
                        ]
                    ],
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
            if ($users == "students") {
                $data = [
                    'student_Fname' => $firstname,
                    'student_Lname' => $lastname,
                    'student_Username' => $username,
                    'student_Password' => password_hash($password, PASSWORD_DEFAULT),
                    'year_id'       => $_POST['year'],
                    'course_id'     => $_POST['courses'],
                    'section_id'    => $_POST['section']
                ];
            } else if ($users == "admins") {
                $data = [
                    'Admin_Fname' => $firstname,
                    'Admin_Lname' => $lastname,
                    'Admin_Username' => $username,
                    'Admin_Password' => password_hash($password, PASSWORD_DEFAULT),
                ];
            } else if ($users == "teacher") {
                $data = [
                    'teacher_Fname' => $firstname,
                    'teacher_Lname' => $lastname,
                    'department_id'     => $department,
                    'teacher_Username' => $username,
                    'teacher_Password' => password_hash($password, PASSWORD_DEFAULT),
                ];
            }
        } else if ($emailCheck == 1 && $passwordCheck == 0 && $usernameCheck == 0) {
            // echo "1 0 0";
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
                        ],
                        [
                            'fieldName' => 'teacher_Email',
                            'tableName' => 'teacher'
                        ]
                    ],

                ],
            ];
            if ($users == "students") {
                $data = [
                    'student_Fname' => $firstname,
                    'student_Lname' => $lastname,
                    'student_Email' => $email,
                    'year_id'       => $_POST['year'],
                    'course_id'     => $_POST['courses'],
                    'section_id'    => $_POST['section']
                ];
            } else if ($users == "admins") {
                $data = [
                    'Admin_Fname' => $firstname,
                    'Admin_Lname' => $lastname,
                    'Admin_Email' => $email,
                ];
            } else if ($users == "teacher") {
                $data = [
                    'teacher_Fname' => $firstname,
                    'teacher_Lname' => $lastname,
                    'department_id'     => $department,
                    'teacher_Email' => $email,
                ];
            }
        } else if ($emailCheck == 0 && $passwordCheck == 1 && $usernameCheck == 0) {
            echo "0 1 0";

            $validations = [
                'firstname' => [
                    'required' => true,
                ],
                'lastname' => [
                    'required' => true,
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
            if ($users == "students") {
                $data = [
                    'student_Fname' => $firstname,
                    'student_Lname' => $lastname,
                    'student_Password' => password_hash($password, PASSWORD_DEFAULT),
                    'student_Email' => $email,
                    'year_id'       => $_POST['year'],
                    'course_id'     => $_POST['courses'],
                    'section_id'    => $_POST['section']
                ];
            } else if ($users == "admins") {
                $data = [
                    'Admin_Fname' => $firstname,
                    'Admin_Lname' => $lastname,
                    'Admin_Username' => $username,
                    'Admin_Password' => password_hash($password, PASSWORD_DEFAULT),
                ];
            } else if ($users == "teacher") {
                $data = [
                    'teacher_Fname' => $firstname,
                    'teacher_Lname' => $lastname,
                    'department_id'     => $department,
                    'teacher_Username' => $username,
                    'teacher_Password' => password_hash($password, PASSWORD_DEFAULT),
                ];
            }
        } else if ($emailCheck == 0 && $passwordCheck == 0 && $usernameCheck == 1) {
            echo "0 0 1";
            $validations = [
                'firstname' => [
                    'required' => true,
                ],
                'lastname' => [
                    'required' => true,
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
                        ],
                        [
                            'fieldName' => 'teacher_Email',
                            'tableName' => 'teacher'
                        ]
                    ],
                ],
            ];
            if ($users == "students") {
                $data = [
                    'student_Fname' => $firstname,
                    'student_Lname' => $lastname,
                    'student_Username' => $username,
                    'year_id'       => $_POST['year'],
                    'course_id'     => $_POST['courses'],
                    'section_id'    => $_POST['section']
                ];
            } else if ($users == "admins") {
                $data = [
                    'Admin_Fname' => $firstname,
                    'Admin_Lname' => $lastname,
                    'Admin_Username' => $username,
                ];
            } else if ($users == "teacher") {
                $data = [
                    'teacher_Fname' => $firstname,
                    'teacher_Lname' => $lastname,
                    'department_id'     => $department,
                    'teacher_Username' => $username,
                ];
            }
        } else if ($emailCheck == 0 && $passwordCheck == 0 && $usernameCheck == 0) {
            echo "0 0 0 ";

            $validations = [
                'firstname' => [
                    'required' => true,
                ],
                'lastname' => [
                    'required' => true,
                ],
            ];

            if ($users == "students") {
                $data = [
                    'student_Fname' => $firstname,
                    'student_Lname' => $lastname,
                    'year_id'       => $_POST['year'],
                    'course_id'     => $_POST['courses'],
                    'section_id'    => $_POST['section']
                ];
            } else if ($users == "admins") {
                $data = [
                    'Admin_Fname' => $firstname,
                    'Admin_Lname' => $lastname,
                ];
            } else if ($users == "teacher") {
                $data = [
                    'teacher_Fname' => $firstname,
                    'teacher_Lname' => $lastname,
                    'department_id'     => $department,
                ];
            }
        }
        // var_dump($validations);

        $errors = validate($fields, $validations);
        if (empty($errors)) {
            if ($users == "students") {
                $links =
                    [
                        'pages' => $_POST['pages'],
                        'users' => $users,
                        'student_ID' => $user_ID
                    ];
                $save = update('student', ['student_ID'], $data);
                if ($save) {
                    removeValue();
                    setFlash('success', 'Updated Successfully');
                    redirect('adminUpdateUser', $links);
                } else {
                    retainValue();
                    setFlash('failed', 'Update Failed');
                    redirect('adminUpdateUser', $links);
                }
            } else if ($users == "admins") {
                $links =
                    [
                        'pages' => $_POST['pages'],
                        'users' => $users,
                        'Admin_ID' => $user_ID
                    ];
                $save = update('admin', ['Admin_ID' => $user_ID], $data);
                if ($save) {
                    removeValue();
                    setFlash('success', 'Updated Successfully');
                    redirect('adminUpdateUser', $links);
                }
            }
            // var_dump($users);
            else if ($users == "teacher") {
                $links =
                    [
                        'pages' => $_POST['pages'],
                        'users' => $users,
                        'teacher_ID' => $user_ID
                    ];
                $save = update('teacher', ['teacher_ID' => $user_ID], $data);
                if ($save) {
                    $special_name = $_POST['special'];
                    $special_id = $_POST['special_id'];
                    foreach ($special_id as $key => $value) {
                        $update2 = update('specialization', ['Specialization_ID' => $special_id[$key]], ['Specialization_name' => $special_name[$key]]);
                    }
                    if ($update2) {
                        removeValue();
                        setFlash('success', 'Updated Successfully');
                        redirect('adminUpdateUser', $links);
                    } else {
                        retainValue();
                        setFlash('failed', 'Update Failed');
                        redirect('adminUpdateUser', $links);
                    }
                }
            } else {
                retainValue();
                setFlash('failed', 'Update Failed');
                redirect('adminUpdateUser', $links);
            }
        } else {
            if ($users == "students") {
                $links =
                    [
                        'pages' => $_POST['pages'],
                        'users' => $users,
                        'student_ID' => $user_ID
                    ];
            } else if ($users == "admins") {
                $links =
                    [
                        'pages' => $_POST['pages'],
                        'users' => $users,
                        'Admin_ID' => $user_ID
                    ];
            } else if ($users == "teacher") {
                $links =
                    [
                        'pages' => $_POST['pages'],
                        'users' => $users,
                        'teacher_ID' => $user_ID
                    ];
            }
            retainValue();
            returnError($errors);
            redirect('adminUpdateUser', $links);
        }
    endif;
endif;

//add specialization in update
if (isset($_POST['add_special'])) :
    if ($_SERVER['REQUEST_METHOD'] === 'POST') :
        $links = [
            'pages' => $_POST['pages'],
            'users' => $_POST['users'],
            'teacher_ID' => $_POST['teacher_id']
        ];
        $special = $_POST['special'];
        $teacher_id = $_POST['teacher_id'];

        foreach ($special as $key => $value) {
            $data = [
                'teacher_ID' => $teacher_id,
                'Specialization_name' => $special[$key]
            ];
            $save = save('specialization', $data);
        }
        if ($save) {
            setFlash('success', 'Specialization Added Successfully');
            redirect('adminUpdateUser', $links);
        } else {
            setFlash('failed', 'Specialization Failed');
            redirect('adminUpdateUser', $links);
        }
    endif;
endif;


if (isset($_GET['deleteSpec'])) :
    $specialization_ID = $_GET['specialization_ID'];
    $delete = delete('specialization', ['Specialization_ID' => $specialization_ID]);

    if ($delete) {
        $links = [
            'pages' => $_GET['pages'],
            'users' => $_GET['users'],
            'teacher_ID' => $_GET['teacher_ID']
        ];
        setFlash('success', 'Specialization Deleted');
        redirect('adminUpdateUser', $links);
    }
endif;


if (isset($_POST['updatePictureTeacher'])) :
    $file_name = $_FILES['profile']['name'];
    $file_temp = $_FILES['profile']['tmp_name'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_new_name = uniqid() . '.' . $file_ext;
    $file_dest = '../public/assets/profile/' . $file_new_name;

    if (move_uploaded_file($file_temp, $file_dest)) {
        $teacher_id = $_POST['teacher_ID'];
        $update = update('teacher', ['teacher_ID' => $teacher_id], ['teacher_Profile' => $file_dest]);
        if ($update) {
            setSession(['teacher_Profile' => $file_dest]);
            setFlash('success', 'Profile Uploaded Successfully');
            redirect('teacherProfile', ['pages' => 'Profile']);
        } else {
            setFlash('failed', 'Profile Uploading Failed');
            redirect('teacherProfile', ['pages' => 'Profile']);
        }
    } else {
        setFlash('failed', 'Profile Uploading Failed');
        redirect('teacherProfile', ['pages' => 'Profile']);
    }
endif;

if (isset($_POST['updatePictureAdmin'])) :
    $file_name = $_FILES['profile']['name'];
    $file_temp = $_FILES['profile']['tmp_name'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_new_name = uniqid() . '.' . $file_ext;
    $file_dest = '../public/assets/profile/' . $file_new_name;

    if (move_uploaded_file($file_temp, $file_dest)) {
        $Admin_id = $_POST['Admin_ID'];
        $update = update('Admin', ['Admin_ID' => $Admin_id], ['Admin_Profile' => $file_dest]);
        if ($update) {
            setSession(['Admin_Profile' => $file_dest]);
            setFlash('success', 'Profile Uploaded Successfully');
            redirect('Profile', ['pages' => 'Profile']);
        } else {
            setFlash('failed', 'Profile Uploading Failed');
            redirect('Profile', ['pages' => 'Profile']);
        }
    } else {
        setFlash('failed', 'Profile Uploading Failed');
        redirect('Profile', ['pages' => 'Profile']);
    }
endif;



if (isset($_POST['updatePicturestudent'])) :
    $file_name = $_FILES['profile']['name'];
    $file_temp = $_FILES['profile']['tmp_name'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_new_name = uniqid() . '.' . $file_ext;
    $file_dest = '../public/assets/profile/' . $file_new_name;

    if (move_uploaded_file($file_temp, $file_dest)) {
        $student_id = $_POST['student_ID'];
        $update = update('student', ['student_ID' => $student_id], ['student_Profile' => $file_dest]);
        if ($update) {
            setSession(['student_Profile' => $file_dest]);
            setFlash('success', 'Profile Uploaded Successfully');
            redirect('studentProfile', ['pages' => 'Profile']);
        } else {
            setFlash('failed', 'Profile Uploading Failed');
            redirect('studentProfile', ['pages' => 'Profile']);
        }
    } else {
        setFlash('failed', 'Profile Uploading Failed');
        redirect('studentProfile', ['pages' => 'Profile']);
    }
endif;
