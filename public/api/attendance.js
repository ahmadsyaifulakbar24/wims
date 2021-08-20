// Date & Time
let date = moment().format().substr(0, 10)
let time = null
$(document).ready(function() {
    get_attendance()
    var interval = setInterval(function() {
        var momentNow = moment()
        $('#date-part').html(momentNow.format('dddd') + ', ' + momentNow.format('DD MMMM YYYY'))
        $('#time-part').html(momentNow.format('HH:mm'))
        time = `${moment().format().substr(0,10)} ${moment().format().substr(11,8)}`
    }, 500)
    setTimeout(function() {
        $('#card').show()
        $('#loading').remove()
    }, 1000)
})

// Latitude & Longitude
let latitude = null
let longitude = null
navigator.geolocation.getCurrentPosition(showPosition)

function showPosition(position) {
    latitude = position.coords.latitude
    longitude = position.coords.longitude
}

// Employee
let employee_id = null
$.ajax({
    url: `${api_url}/employee/fetch/${user_id}`,
    type: 'GET',
    success: function(result) {
        // console.log(result.data)
        employee_id = result.data.id
    }
})

// Check Attendance
let attendance_id = null
check_attendance()

function check_attendance() {
    $('#image').parent('div').addClass('none')
    $('.custom-file').removeClass('none')
    $('#description').val('')
    photo = null
    $.ajax({
        url: `${api_url}/attendance/fetch`,
        type: 'GET',
        data: {
            login_time: date
        },
        success: function(result) {
            // console.log(result.data)
            $.each(result.data, function(index, value) {
                if (value.login_time != null) {
                    $('#in').attr('disabled', true)
                    $('#out').attr('disabled', false)
                    attendance_id = value.id
                }
                if (value.home_time != null) {
                    $('#out').attr('disabled', true)
                }
            })
        }
    })
}

// Attendance Log
function get_attendance(date) {
    $('#table').empty()
    $.ajax({
        url: `${api_url}/attendance/fetch`,
        type: 'GET',
        data: {
            login_time: date
        },
        success: function(result) {
            // console.log(result.data)
            if (result.data.length != 0) {
                $.each(result.data, function(index, value) {
                    append = ''
                    if (value.home_time != null) {
                        append += `<tr onclick="return location.href='${root}/attendance/out/${value.home_time.substr(0,10)}'">
				            <td>${date_format(value.home_time.substr(0,10))}</td>
				            <td>Clock Out</td>
				            <td>${value.home_time.substr(10,6)}</td>
				            <td class="text-right"><i class="mdi mdi-18px mdi-chevron-right pr-0"></i></td>
				        </tr>`
                    }
                    append += `<tr onclick="return location.href='${root}/attendance/in/${value.login_time.substr(0,10)}'">
			            <td>${date_format(value.login_time.substr(0,10))}</td>
			            <td>Clock In</td>
			            <td>${value.login_time.substr(10,6)}</td>
			            <td class="text-right"><i class="mdi mdi-18px mdi-chevron-right pr-0"></i></td>
			        </tr>`
                    $('#table').append(append)
                })
            } else {
                let append = `<td class="text-center">
	            	<div class="font-weight-bold pt-3">No attendance</div>
	            	<div class="text-secondary">${date != undefined ? date_format(date) : 'Clock In for attendance'}</div>
	            </td>`
                $('#table').append(append)
            }
        }
    })
}

$('#in').click(function() {
    $('input[type=file]').click()
    $('#apply').html('Clock In')
    $('#apply').attr('data-type', 'in')
})

$('#out').click(function() {
    $('input[type=file]').click()
    $('#apply').html('Clock Out')
    $('#apply').attr('data-type', 'out')
})

// Clock In & Clock Out
$('#apply').click(function() {
    $('.is-invalid').removeClass('is-invalid')
    let type = $(this).attr('data-type')
    let formData = new FormData()
    setTimeout(function() {
        if (type == 'in') {
        	$('#in').attr('disabled', true)
            formData.append('employee_id', employee_id)
            formData.append('login_time', time)
            latitude != null ? formData.append('login_latitude', latitude) : ''
            longitude != null ? formData.append('login_longitude', longitude) : ''
            photo != null ? formData.append('login_image', photo, photoname) : ''
            formData.append('login_description', $('#description').val())
            $.ajax({
                url: `${api_url}/attendance/attendance_login`,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {
                    customAlert('success', 'Clock In success')
                    check_attendance()
                    get_attendance()
                },
                error: function(xhr) {
                    let err = xhr.responseJSON.errors
                    // console.log(err)
                    if (err.login_image) {
                        customAlert('danger', 'Take a photo first')
                    }
                    if (err.login_latitude) {
                        customAlert('warning', 'Please allow location permission')
                    }
                }
            })
        } else {
        	$('#out').attr('disabled', true)
            formData.append('home_time', time)
            latitude != null ? formData.append('home_latitude', latitude) : ''
            longitude != null ? formData.append('home_longitude', longitude) : ''
            photo != null ? formData.append('home_image', photo, photoname) : ''
            formData.append('home_description', $('#description').val())
            $.ajax({
                url: `${api_url}/attendance/${attendance_id}/attendance_home`,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {
                    customAlert('success', 'Clock Out success')
                    check_attendance()
                    get_attendance()
                },
                error: function(xhr) {
                    let err = xhr.responseJSON.errors
                    // console.log(err)
                    if (err.home_image) {
                        customAlert('danger', 'Take a photo first')
                    }
                    if (err.home_latitude) {
                        customAlert('warning', 'Please allow location permission')
                    }
                }
            })
        }
    }, 500)
})

$('#filter').click(function() {
    let date = $('#date').val()
    get_attendance(date)
    $('#modal-filter').modal('hide')
})
