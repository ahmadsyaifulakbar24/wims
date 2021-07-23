if (localStorage.getItem('token') != null) {
    $.ajaxSetup({
        beforeSend: function(xhr) {
            xhr.setRequestHeader('Authorization', `Bearer ${token}`)
        }
    })
}
if (localStorage.getItem('name')) $('.name').html(localStorage.getItem('name'))
if (localStorage.getItem('photo')) $('.avatar').attr('src', localStorage.getItem('photo'))
const token = localStorage.getItem('token')
const user = localStorage.getItem('user')
const role = localStorage.getItem('role')

$(document).on('keydown', 'input', function() {
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
    if ($('.customAlert').hasClass('active')) {
        $('.customAlert').removeClass('active')
        $('.customAlert').animate({ bottom: "-=120px" }, 150)
    }
    $('.customAlert').html(icon + param)
    $('.customAlert').addClass('active')
    $('.customAlert').animate({ bottom: "+=120px" }, 150)
    // if (status != 'warning') {
    delay(function() {
        $('.customAlert').removeClass('active')
        $('.customAlert').animate({ bottom: "-=120px" }, 150)
    }, 2500)
    // }
}

function date_now() {
    let date = new Date()
    let a = date.getDay()
    let d = date.getDate()
    let m = date.getMonth()
    let y = date.getFullYear()
    return `${day_format(a)}, ${d} ${month_format(m)} ${y}`
}

function date_format(param) {
    let d = param.substr(8, 2)
    let m = param.substr(5, 2)
    let y = param.substr(0, 4)
    if (d.toString().length < 2) d = '0' + d
    if (m.toString().length < 2) m = '0' + m
    return `${d}/${m}/${y}`
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
    switch (param + 1) {
        case 1:
            month = "January"
            break;
        case 2:
            month = "February"
            break;
        case 3:
            month = "March"
            break;
        case 4:
            month = "April"
            break;
        case 5:
            month = "May"
            break;
        case 6:
            month = "June"
            break;
        case 7:
            month = "Jule"
            break;
        case 8:
            month = "August"
            break;
        case 9:
            month = "September"
            break;
        case 10:
            month = "October"
            break;
        case 11:
            month = "November"
            break;
        case 12:
            month = "December"
            break;
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