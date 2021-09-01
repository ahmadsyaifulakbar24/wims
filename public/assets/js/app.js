const token = localStorage.getItem('token')
const user_id = localStorage.getItem('user_id')
const name = localStorage.getItem('name')
const username = localStorage.getItem('username')
const role = localStorage.getItem('role')

if (localStorage.getItem('token') != null) {
    $.ajaxSetup({
        beforeSend: function(xhr) {
            xhr.setRequestHeader('Authorization', `Bearer ${token}`)
        }
    })
	$('.name').html(name)
	$('.username').append(username)
	$('.avatar').attr('src', localStorage.getItem('photo'))
}

$(document).on('keydown', 'input', function() {
    $(this).removeClass('is-invalid')
})
$(document).on('keydown', 'textarea', function() {
    $(this).removeClass('is-invalid')
})
$(document).on('change', 'select', function() {
    $(this).removeClass('is-invalid')
})
$(document).on('click', 'input[name="gender"]', function() {
    $('#gender').removeClass('is-invalid')
})
$(document).on('change', 'input[type="date"]', function() {
    $(this).removeClass('is-invalid')
})
$(document).on('click', '.dropdown .dropdown-menu', function(e) {
    e.stopPropagation()
})

$('#menu').click(function() {
    if (!$('.sidebar').hasClass('show')) {
        $('.sidebar').addClass('show')
        $('.sidebar').css('left', '0px')
        $('.overlay').show()
    } else {
        $('.sidebar').removeClass('show')
        $('.sidebar').css('left', '-230px')
        $('.overlay').hide()
    }
})

$('.overlay').click(function() {
    $('.sidebar').removeClass('show')
    $('.sidebar').css('left', '-230px')
    $(this).hide()
})

$('.password').click(function() {
    if ($(this).hasClass('mdi-eye')) {
        $(this).removeClass('mdi-eye')
        $(this).addClass('mdi-eye-off')
        if ($(this).data('id') == 'password') {
            $('#password').attr('type', 'password')
        } else if ($(this).data('id') == 'npassword') {
            $('#npassword').attr('type', 'password')
        } else {
            $('#cpassword').attr('type', 'password')
        }
    } else {
        $(this).addClass('mdi-eye')
        $(this).removeClass('mdi-eye-off')
        if ($(this).data('id') == 'password') {
            $('#password').attr('type', 'text')
        } else if ($(this).data('id') == 'npassword') {
            $('#npassword').attr('type', 'text')
        } else {
            $('#cpassword').attr('type', 'text')
        }
    }
})

function logout() {
    $.ajax({
        url: `${api_url}/logout`,
        type: 'POST',
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + token)
        },
        success: function() {
            localStorage.clear()
            $.ajax({
                url: `${root}/session/logout`,
                type: 'GET',
                success: function() {
                    location.href = root
                }
            })
        }
    })
}

function customAlert(status, param) {
    let icon = ''
    switch (status) {
        case 'success':
            icon = '<i class="mdi mdi-18px mdi-check-circle text-success"></i>'
            break;
        case 'warning':
            icon = '<i class="mdi mdi-18px mdi-alert text-warning"></i>'
            break;
        case 'danger':
            icon = '<i class="mdi mdi-18px mdi-alert-circle text-danger"></i>'
            break;
        case 'trash':
            icon = '<i class="mdi mdi-18px mdi-trash-can-outline"></i>'
    }

    let timeout = setTimeout(function() {
        $('.customAlert').removeClass('active')
        $('.customAlert').animate({ bottom: "-=120px" }, 150)
    }, 2000)

    if ($('.customAlert').hasClass('active')) {
        clearTimeout(timeout)
        $('.customAlert').removeClass('active')
        $('.customAlert').animate({ bottom: "-=120px" }, 150)
    }
    timeout
    $('.customAlert').html(icon + param)
    $('.customAlert').addClass('active')
    $('.customAlert').animate({ bottom: "+=120px" }, 150)
}

function date_now() {
    let date = new Date()
    let a = date.getDay()
    let d = date.getDate()
    let m = date.getMonth() + 1
    if (m.toString().length < 2) m = '0' + m
    let y = date.getFullYear()
    return `${day_format(a)}, ${d} ${month_format(m)} ${y}`
}

function date_format(param) {
    let d = param.substr(8, 2)
    let m = param.substr(5, 2)
    let y = param.substr(0, 4)
    return `${d} ${month_format(m)} ${y}`
}

function day_format(param) {
    let day
    switch (param) {
        case 0:
            day = "Sunday"
            break;
        case 1:
            day = "Monday"
            break;
        case 2:
            day = "Teusday"
            break;
        case 3:
            day = "Wednesday"
            break;
        case 4:
            day = "Thursday"
            break;
        case 5:
            day = "Friday"
            break;
        case 6:
            day = "Saturday"
    }
    return day
}

function month_format(param) {
    let month
    switch (param) {
        case "01":
            month = "Jan"
            break;
        case "02":
            month = "Feb"
            break;
        case "03":
            month = "Mar"
            break;
        case "04":
            month = "Apr"
            break;
        case "05":
            month = "May"
            break;
        case "06":
            month = "Jun"
            break;
        case "07":
            month = "Jul"
            break;
        case "08":
            month = "Aug"
            break;
        case "09":
            month = "Sep"
            break;
        case "10":
            month = "Oct"
            break;
        case "11":
            month = "Nov"
            break;
        case "12":
            month = "Dec"
    }
    return month
}

function addLoading(attr, param) {
    let path
    param == undefined ? path = 'path' : path = 'path-' + param
    let append = `<div class="d-inline-block loader loader-sm btn-loading">
		<svg class="circular" viewBox="25 25 50 50">
			<circle class="${path}" cx="50" cy="50" r="20" fill="none" stroke-width="6" stroke-miterlimit="1"/>
		</svg>
	</div>
	<div class="d-inline-block pl-2">Loading...</div>`
    if (attr == undefined) {
        $('#submit').html(append)
        $('#submit').attr('disabled', true)
    } else {
        $(attr).html(append)
        $(attr).attr('disabled', true)
    }
}

function removeLoading(html, attr) {
    if (attr == undefined) {
        $('#submit').attr('disabled', false)
        $('#submit').html(html)
    } else {
        $(attr).attr('disabled', false)
        $(attr).html(html)
    }
}

function pagination(links, meta, path) {
    let current = meta.current_page
    let replace = path + '?page='

    let first = links.first.replace(replace, '')
    if (first != current) {
        $('#first').removeClass('disabled')
        $('#first').data('id', first)
    } else {
        $('#first').addClass('disabled')
    }

    if (links.prev != null) {
        $('#prev').removeClass('disabled')
        let prev = links.prev.replace(replace, '')
        $('#prev').data('id', prev)

        $('#prevCurrent').show()
        $('#prevCurrent span').html(prev)
        $('#prevCurrent').data('id', prev)

        let prevCurrentDouble = prev - 1
        if (prevCurrentDouble > 0) {
            $('#prevCurrentDouble').show()
            $('#prevCurrentDouble span').html(prevCurrentDouble)
            $('#prevCurrentDouble').data('id', prevCurrentDouble)
        } else {
            $('#prevCurrentDouble').hide()
        }
    } else {
        $('#prev').addClass('disabled')
        $('#prevCurrent').hide()
        $('#prevCurrentDouble').hide()
    }

    $('#current').addClass('active')
    $('#current span').html(current)

    if (links.next != null) {
        $('#next').removeClass('disabled')
        let next = links.next.replace(replace, '')
        $('#next').data('id', next)

        $('#nextCurrent').show()
        $('#nextCurrent span').html(next)
        $('#nextCurrent').data('id', next)

        let nextCurrentDouble = ++next
        if (nextCurrentDouble <= meta.last_page) {
            $('#nextCurrentDouble').show()
            $('#nextCurrentDouble span').html(nextCurrentDouble)
            $('#nextCurrentDouble').data('id', nextCurrentDouble)
        } else {
            $('#nextCurrentDouble').hide()
        }
    } else {
        $('#next').addClass('disabled')
        $('#nextCurrent').hide()
        $('#nextCurrentDouble').hide()
    }

    let last = links.last.replace(replace, '')
    if (last != current) {
        $('#last').removeClass('disabled')
        $('#last').data('id', last)
    } else {
        $('#last').addClass('disabled')
    }

    $('#pagination').removeClass('hide')
    $('#pagination-label').html(`Showing ${meta.from} to ${meta.to} of ${meta.total} entries`)
}

$('.page').click(function() {
    if (!$(this).is('.active, .disabled')) {
        let page = $(this).data('id')
        $('#pagination').addClass('hide')
        $('#loading_table').removeClass('hide')
        get_data(page)
    }
})

function delay(fn, ms) {
    let timer = 0
    return function(...args) {
        clearTimeout(timer)
        timer = setTimeout(fn.bind(this, ...args), ms || 0)
    }
}

function icon(param) {
    let icon
    if (param == 'jpg' || param == 'jpeg' || param == 'png') {
        icon = 'mdi-image-outline'
    } else if (param == 'xls' || param == 'xlsx' || param == 'csv') {
        icon = 'mdi-file-excel-box-outline'
    } else if (param == 'doc' || param == 'docx') {
        icon = 'mdi-file-word-box-outline'
    } else if (param == 'pdf') {
        icon = 'mdi-file-pdf-box-outline'
    }
    return icon
}

function status_format(param) {
    let status
    if (param == 'pending') {
        status = `<span class="text-capitalize text-warning">${param}</span>`
    } else if (param == 'approve') {
        status = `<span class="text-capitalize text-success">${param}</span>`
    } else if (param == 'reject') {
        status = `<span class="text-capitalize text-danger">${param}</span>`
    }
    return status
}

function DataURIToBlob(dataURI) {
    const splitDataURI = dataURI.split(',')
    const byteString = splitDataURI[0].indexOf('base64') >= 0 ? atob(splitDataURI[1]) : decodeURI(splitDataURI[1])
    const mimeString = splitDataURI[0].split(':')[1].split(';')[0]

    const ia = new Uint8Array(byteString.length)
    for (let i = 0; i < byteString.length; i++)
        ia[i] = byteString.charCodeAt(i)

    return new Blob([ia], { type: mimeString })
}

