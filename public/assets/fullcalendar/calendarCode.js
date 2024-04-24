$(document).ready(function () {
    var calendar = $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            // right: 'agendaWeek'
        },
        defaultView: 'agendaWeek',
        selectable: true,
        selectHelper: true,
        slotLabelInterval: '00:30:00',
        minTime: '07:30:00',
        maxTime: '17:00:00',
        slotDuration: '00:30:00',
        contentHeight: 'auto',
        eventColor: 'red',
        allDaySlot: false,
        select: function (start, end) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to set this time as not available?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'http://localhost/TMS/ajax/setTime.php',
                        data: {
                            start: start.format('YYYY-MM-DD HH:mm:ss'),
                            end: end.format('YYYY-MM-DD HH:mm:ss')
                        },
                        type: "POST",
                        success: function (response) {
                            response = JSON.parse(response);
                            if (response.status == "success") {
                                // success(response.message);
                                console.log(response.message);
                                calendar.fullCalendar('refetchEvents'); // Refresh events after successful setting
                            } else {
                                failed('Error setting time.');
                                calendar.fullCalendar('unselect');
                            }
                        },
                        error: function (xhr, status, error) {
                            // Handle the error
                            failed('Error setting time.');
                            calendar.fullCalendar('unselect');
                        }
                    });
                } else {
                    calendar.fullCalendar('unselect');
                }
            });
        },
        events: function (start, end, timezone, callback) {
            $.ajax({
                url: 'http://localhost/TMS/ajax/getTime.php?getTeacher',
                type: "GET",
                success: function (response) {
                    response = JSON.parse(response);
                    if (response.status == "success") {
                        var events = [];
                        $.each(response.data, function (i, item) {
                            events.push({
                                id: item.availability_ID,
                                title: item.availability_Status,
                                start: item.availability_startDatetime,
                                end: item.availability_endDatetime,
                                allDay: false
                            });
                        });
                        callback(events);
                    } else {
                        // failed('Error getting availability.');
                        console.log('No Avail Sched');
                    }
                },
                error: function (xhr, status, error) {
                    // Handle the error
                    // failed('Error getting availability.');
                    console.log('No Avail Sched');
                }
            });
        },
        eventClick: function (event, jsEvent, view) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to delete this?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'http://localhost/TMS/ajax/deleteTime.php',
                        data: {
                            delete_Teacher: true,
                            availability_ID: event.id,
                        },
                        type: "POST",
                        success: function (response) {
                            response = JSON.parse(response);
                            if (response.status == "success") {
                                // success(response.message);
                                console.log(response.message);
                                calendar.fullCalendar('refetchEvents'); // Refresh events after successful setting
                            } else {
                                failed('Error setting time.');
                                calendar.fullCalendar('unselect');
                            }
                        },
                        error: function (xhr, status, error) {
                            // Handle the error
                            failed('Error setting time.');
                            calendar.fullCalendar('unselect');
                        }
                    });
                }
            });
        }
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
            confirmButtonText: 'Yes',
            cancelButtonText: false
        })
    }
});






$(document).ready(function () {
    var teacher_ID = $('#calendarStudent').attr('teacher-ID');
    console.log(teacher_ID);
    var calendar = $('#calendarStudent').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            // right: 'agendaWeek'
        },
        defaultView: 'agendaWeek',
        selectable: false,
        selectHelper: false,
        slotLabelInterval: '00:30:00',
        minTime: '07:30:00',
        maxTime: '17:00:00',
        slotDuration: '00:30:00',
        contentHeight: 'auto',
        eventColor: 'red',
        editable: false,
        events: function (start, end, timezone, callback) {
            $.ajax({
                url: `http://localhost/TMS/ajax/getTime.php?getStudent&teacher_ID=${teacher_ID}`,
                type: "GET",
                success: function (response) {
                    response = JSON.parse(response);
                    if (response.status == "success") {
                        var events = [];
                        $.each(response.data, function (i, item) {
                            events.push({
                                id: item.availability_ID,
                                title: item.availability_Status,
                                start: item.availability_startDatetime,
                                end: item.availability_endDatetime,
                                allDay: false
                            });
                        });
                        callback(events);
                    } else {
                        // failed('Do not have available Schedules.');
                        console.log('No Avail Sched');
                    }
                },
                error: function (xhr, status, error) {
                    // Handle the error
                    // failed('Do not have available Schedules.');
                    console.log('No Avail Sched');
                }
            });
        },
        slotLabelFormat: ['h:mm'],
        timeFormat: 'h:mm',
        slotEventOverlap: false,
        businessHours: {
            start: '07:30',
            end: '17:00',
            dow: [1, 2, 3, 4, 5]
        },
        allDaySlot: false,
    });
    function failed(message) {
        Swal.fire({
            title: 'Not Available',
            text: message,
            icon: 'warning',
            confirmButtonText: 'Yes',
            cancelButtonText: false
        })
    }
});
