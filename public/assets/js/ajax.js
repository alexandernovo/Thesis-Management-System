//get department in registration of teacher in admin UI
$(document).ready(function () {
    var college_id = $("#college").val();
    function department(college_id) {
        $.ajax({
            url: "http://localhost/TMS/ajax/getDepartment.php?college_id=" + college_id,
            success: function (result) {
                $("#department").html(result);
            }
        });
    }
    $("#college").on("change", function () {
        var college_new = $(this).val();
        department(college_new);
    });

    department(college_id);
});



//get list of probable adviser
$(document).ready(function () {

    function getAdvisers(url) {
        $.ajax({
            url: url,
            success: function (result) {
                $("#adviser").html(result);
            }
        });
    }

    // Call getAdvisers() initially to populate the adviser list
    getAdvisers("http://localhost/TMS/ajax/getAdviser.php?normal");

    // Use debounce to reduce the number of requests made while typing
    $("#searchadviser").on("input", function () {
        var searchadviser = $(this).val();
        if (searchadviser.length > 0) {
            var timeoutId = setTimeout(function () {
                getAdvisers("http://localhost/TMS/ajax/getAdviser.php?search&adviserSearch=" + searchadviser);
            }, 500);
        } else {
            // Call getAdvisers() with no search query when input is cleared
            getAdvisers("http://localhost/TMS/ajax/getAdviser.php?normal");
        }
    });


    //when click request
    $('#adviser').on("click", ".request", function () {
        var button = $(this);
        button.prop('disabled', true).html("<i class='fas fa-spinner fa-spin'></i> Loading...");
        var teacherID = $(this).attr('teacher-ID');
        var studentID = $(this).attr('student-ID');
        var research_Title = $(`#research_Title${teacherID}`).val();
        var research_Problem = $(`#research_Problem${teacherID}`).val();
        var research_Solution = $(`#research_Solution${teacherID}`).val();
        var research_File = $(`#research_File${teacherID}`)[0].files[0];

        if (research_Title === '' || research_Problem === '' || research_Solution === '' || research_File === undefined) {
            failed('Please fill in all fields');
            button.prop('disabled', false).html("<i class='fa fa-paper-plane text-size'></i> Request");
            return;
        }
        var formData = new FormData();
        formData.append('requestAdvisory', true);
        formData.append('teacherID', teacherID);
        formData.append('studentID', studentID);
        formData.append('research_Title', research_Title);
        formData.append('research_Problem', research_Problem);
        formData.append('research_Solution', research_Solution);
        formData.append('research_File', research_File);
        console.log(formData)
        $.ajax({
            url: 'http://localhost/TMS/ajax/setRequest.php',
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (response) {
                response = JSON.parse(response);
                if (response.status == 'success') {
                    $(`#request${teacherID}`).modal('hide');
                    var searchadviser = $("#searchadviser").val();
                    if (searchadviser != "") {
                        getAdvisers("http://localhost/TMS/ajax/getAdviser.php?search&adviserSearch=" + searchadviser);
                    } else {
                        getAdvisers("http://localhost/TMS/ajax/getAdviser.php?normal");
                    }
                    success(response.message);
                } else {
                    failed(response.message);
                }
            },
            error: function (xhr, status, error) {
                failed('Error.');
            },
        });
    });

    //cancel Request
    $('#adviser').on("click", ".cancelRequest", function () {
        var requestID = $(this).attr('request-ID');
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to cancel this Request?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'http://localhost/TMS/ajax/cancelRequest.php',
                    data: {
                        cancelAdvisory: true,
                        requestID: requestID,
                    },
                    type: "POST",
                    success: function (response) {
                        response = JSON.parse(response);
                        if (response.status == "success") {
                            var searchadviser = $("#searchadviser").val();
                            if (searchadviser != "") {
                                getAdvisers("http://localhost/TMS/ajax/getAdviser.php?search&adviserSearch=" + searchadviser);
                            } else {
                                getAdvisers("http://localhost/TMS/ajax/getAdviser.php?normal");
                            }
                            success(response.message);
                        } else {
                            failed(response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        failed('Error.');
                    }
                });
            }
        });

    });


    function success(message) {
        Swal.fire({
            title: 'Success',
            text: message,
            icon: 'success',
            confirmButtonText: 'Yes',
            cancelButtonText: false
        })
    }

    function failed(message) {
        Swal.fire({
            title: 'Failed',
            text: message,
            icon: 'warning',
            confirmButtonText: 'Okay',
            cancelButtonText: false
        })
    }

});





$(document).ready(function () {

    var $course_id = $('.college').attr('course-id');
    var $colleges_id = $(`#colleges${$course_id}`).val();

    console.log($colleges_id);

    const getDepartment = ($colleges_id) => {
        $.ajax({
            url: "http://localhost/TMS/ajax/course.php",
            method: "GET",
            data: {
                colleges_id: $colleges_id,
            },
            success: function (response) {
                $(`#departments${$course_id}`).html(response);
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: " + status + " - " + error);
            }
        });
    }

    $(`#colleges${$course_id}`).on('change', function () {
        var $colleges_id = $(this).val();
        getDepartment($colleges_id);
    });

    getDepartment($colleges_id);
});
$(document).ready(function () {
    var $colleges_id = $('#colleges').val();
    console.log($colleges_id);

    const getDepartment = ($colleges_id) => {
        $.ajax({
            url: "http://localhost/TMS/ajax/course.php",
            method: "GET",
            data: {
                colleges_id: $colleges_id,
            },
            success: function (response) {
                $("#departments").html(response);
                getCourse($('#departments').val()); // Call getCourse to load initial course content
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: " + status + " - " + error);
            }
        });
    }

    const getCourse = ($department_id) => {
        $.ajax({
            url: "http://localhost/TMS/ajax/courses.php",
            method: "GET",
            data: {
                department_id: $department_id,
            },
            success: function (response) {
                $("#courses").html(response);
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: " + status + " - " + error);
            }
        });
    }

    // Event delegation for dynamically added element
    $(document).on('change', '#departments', function () {
        var $department_id = $(this).val();
        console.log($department_id);
        getCourse($department_id);
    });

    $('#colleges').on('change', function () {
        var $colleges_id = $(this).val();
        getDepartment($colleges_id);
    });

    getDepartment($colleges_id); // Load initial department content
});
